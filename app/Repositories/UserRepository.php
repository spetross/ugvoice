<?php namespace app\Repositories;

use app\Exceptions\UserNotFoundException;
use app\Exceptions\WrongPasswordException;
use app\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use InvalidArgumentException;
use RuntimeException;

class UserRepository
{
    protected $model;

    protected $mailer;

    protected $event;

    public function __construct(
        User $user,
        Mailer $mailer,
        Dispatcher $dispatcher
    )
    {
        $this->model = $user;
        $this->mailer = $mailer;
        $this->event = $dispatcher;
    }

    public function findByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Find user by there username
     *
     * @param string $username
     * @return \app\User
     */
    public function findByUsername($username)
    {
        return $this->model->query()->where('username', '=', $username)->first();
    }

    /**
     * Find user by its email
     *
     * @param string $email
     * @return boolean
     */
    public function findByEmail($email)
    {
        return $this->model->query()->where('email_address', '=', $email)->first();
    }

    /**
     * Find user by both id and username
     *
     * @param mixed $id
     * @return mixed
     */
    public function findByIdUsername($id)
    {
        return $this->model->query()->where('id', '=', $id)
            ->orWhere('username', '=', $id)
            ->orWhere('email', '=', $id)->first();
    }

    /**
     * Finds a user by the login value.
     *
     * @param string $login
     *
     * @throws UserNotFoundException
     *
     * @return \app\User
     */
    public function findByLogin($login)
    {
        $model = $this->model;

        if (!$user = $model->query()->where($model->getLoginName(), '=', $login)->first()) {
            throw new UserNotFoundException("A user could not be found with a login value of [$login].");
        }

        return $user;
    }

    /**
     * Finds a user by the given credentials.
     *
     * @param array $credentials
     * @return \app\User
     * @throws WrongPasswordException
     */
    public function findByCredentials(array $credentials)
    {
        $model = $this->model;
        $loginName = $model->getLoginName();

        if (!array_key_exists($loginName, $credentials)) {
            throw new \InvalidArgumentException("Login attribute [$loginName] was not provided.");
        }

        $passwordName = $model->getPasswordName();

        $query = $model->newQuery();
        $hashableAttributes = $model->getHashableAttributes();
        $hashedCredentials = [];

        // build query from given credentials
        foreach ($credentials as $credential => $value) {
            // Remove hashed attributes to check later as we need to check these
            // values after we retrieved them because of salts
            if (in_array($credential, $hashableAttributes)) {
                $hashedCredentials = array_merge($hashedCredentials, [$credential => $value]);
            } else {
                $query = $query->where($credential, '=', $value);
            }
        }

        if (!$user = $query->first()) {
            throw new UserNotFoundException("A user was not found with the given credentials.");
        }

        // Now check the hashed credentials match ours
        foreach ($hashedCredentials as $credential => $value) {
            if (!\Hash::check($value, $user->{$credential})) {
                $message = "A user was found to match all plain text credentials however hashed credential [$credential] did not match.";

                if ($credential == $passwordName) {
                    throw new WrongPasswordException($message);
                }

                throw new UserNotFoundException($message);
            }
        }

        return $user;
    }

    /**
     * Finds a user by the given activation code.
     *
     * @param string $code
     *
     * @throws UserNotFoundException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     *
     * @return UserInterface
     */
    public function findByActivationCode($code)
    {
        if (!$code) {
            throw new \InvalidArgumentException("No activation code passed.");
        }

        $model = $this->createModel();

        $result = $model->newQuery()->where('verification_code', '=', $code)->get();

        if (($count = $result->count()) > 1) {
            throw new \RuntimeException("Found [$count] users with the same activation code.");
        }

        if (!$user = $result->first()) {
            throw new UserNotFoundException("A user was not found with the given activation code.");
        }

        return $user;
    }

    /**
     * Attempts to activate the given user by checking the activate code.
     * If the user is activated already, an Exception is thrown.
     *
     * @param string $activationCode
     * @return bool
     * @throws \Exception
     */
    public function attemptVerification($user, $activationCode)
    {
        if ($user->verified)
            throw new \Exception('User is already active!');

        if ($activationCode == $user->verification_code) {
            $this->verification_code = null;
            $this->verified = true;
            $user->activated = true;
            $this->activated_at = $user->freshTimestamp();
            $this->save();
            return true;
        }

        return false;
    }

    /**
     * Returns all users who belong to
     * a group.
     *
     * @param GroupInterface $group
     *
     * @return array
     */
    public function findAllInGroup(GroupInterface $group)
    {
        return $group->users()->get();
    }

    /**
     * Returns all users with access to
     * a permission(s).
     *
     * @param string|array $permissions
     *
     * @return array
     */
    public function findAllWithAccess($permissions)
    {
        return array_filter($this->findAll(), function ($user) use ($permissions) {
            return $user->hasAccess($permissions);
        });
    }

    /**
     * Returns all users with access to
     * any given permission(s).
     *
     * @param array $permissions
     *
     * @return array
     */
    public function findAllWithAnyAccess(array $permissions)
    {
        return array_filter($this->findAll(), function ($user) use ($permissions) {
            return $user->hasAnyAccess($permissions);
        });
    }

    public function findAllPaginated($per_page = 15)
    {
        return $this->model->query()->paginate($per_page);
    }

    /**
     * Search users with a term
     *
     * @param string $term
     * @param int $limit
     * @return array
     */
    public function search($term = '', $limit = null)
    {
        $limit = (empty($limit)) ? $this->config->get('user-listing') : $limit;
        $term = str_replace('@', '', $term);
        $users = $this->model
            ->where(function ($users) use ($term) {
                $users->where('username', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', '=', $term);
            });

        return $users = $users->paginate($limit);
    }

    public function searchByIds($term, $userIds, $limit = 5)
    {
        $users = $this->model
            ->whereIn('id', $userIds)
            ->where(function ($users) use ($term) {
                $users->where('username', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', '=', $term);
            });

        return $users = $users->paginate($limit);
    }

    public function listByIds($onlyIds = ['0'], $skipIds = [0], $limit = 10, $offset = 0, $term = '')
    {
        $users = $this->model
            ->whereIn('id', $onlyIds)
            ->whereNotIn('id', $skipIds);

        if (!empty($term)) {
            $users->where(function ($users) use ($term) {
                $users->where('username', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', '=', $term);
            });
        }

        return $users->skip($offset)
            ->take($limit)
            ->get();
    }

    /**
     * Search users base on on there username
     *
     * @param $term
     * @param null $limit
     * @return array
     */
    public function searchByUsername($term, $limit = null)
    {
        $limit = (empty($limit)) ? $this->config->get('user-listing') : $limit;
        $users = $this->model
            ->where(function ($users) use ($term) {
                $users->where('username', 'LIKE', '%' . $term . '%');
            });

        return $users = $users->paginate($limit);
    }

    /**
     * Register new member
     *
     * @param array $val
     * @param boolean $active
     * @return boolean
     */
    public function signup($val, $active = false)
    {
        $credential = [
            'username' => '',
            'password' => '',
            'email_address' => '',
            'fullname' => '',
            'genre' => '',
            'country' => '',
            'birth_day' => 0,
            'birth_month' => 0,
            'birth_year' => 0
        ];

        /**
         * @var $username
         * @var $password
         * @var $email_address
         * @var $fullname
         * @var $genre
         * @var $country
         * @var $birth_day
         * @var $birth_month
         * @var $birth_year
         */
        extract($credential = array_merge($credential, $val));

        $user = $this->model->newInstance();
        $user->username = sanitizeText($username, 100);
        $user->email_address = $email_address;
        $user->fullname = sanitizeText($fullname, 100);
        $user->genre = sanitizeText($genre);
        $user->country = sanitizeText($country);
        $user->password = \Hash::make($password);
        $user->online_status = 1;
        $user->last_active_time = time();
        $user->birth_day = sanitizeText($birth_day);
        $user->birth_month = sanitizeText($birth_month);
        $user->birth_year = sanitizeText($birth_year);

        if ($active or !\Config::get('user-activation')) {
            $user->active = 1;
            $user->activated = 1;
        }

        if (!\Config::get('user-getstarted')) {
            $user->fully_started = 1;
        }


        $user->save();

        /***
         * Send a welcome email to our new user
         */
        try {
            $this->mailer->queue('emails.auth.welcome', [
                'username' => $user->username,
                'fullname' => $user->fullname,
                'email_address' => $user->email_address,
                'profileUrl' => $user->present()->url(),
                'site_name' => \Config::get('site_title')
            ], function ($mail) use ($user) {
                $mail->to($user->email_address, $user->fullname)
                    ->subject(trans('mail.welcome-mail-subject'));
            });
        } catch (\Exception $e) {

        }


        $this->event->fire('user.register', [$user, $val]);
        return $user;
    }

    /**
     * Send Activation code
     *
     * @param \app\Models\User $user
     * @return boolean
     */
    public function sendActivation($user)
    {
        $hash = $this->model->getActivationCode();
        try {
            \Mail::queue('emails.auth.activation', [
                'hash' => $hash,
                'site_name' => \Config::get('site_title'),
                'username' => $user->username,
                'fullname' => $user->fullname,
                'email_address' => $user->email_address,
                'profileUrl' => $user->present()->url(),
            ], function ($mail) use ($user) {
                $mail->to($user->email_address, $user->fullname)
                    ->subject(trans('mail.activation-mail-subject', [
                        'name' => $user->username,
                        'site_title' => \Config::get('site_title')
                    ]));
            });
        } catch (\Exception $e) {

        }

        return true;
    }

    /**
     * Change password
     *
     * @param array $val
     * @param \app\Models\User $user
     * @return boolean
     */
    public function changePassword($val, $user = null)
    {
        $user = (empty($user)) ? \Auth::user() : $user;

        /*
         * @var $password
         */
        extract($val);

        $user->password = bcrypt($password);

        /**
         * Once user can use his/her email to retrieve password means the email is verified
         * to check if account is activated or not
         */
        $user->activated = true;

        $user->save();

        $this->event->fire('retrieve-password', [$user]);

        return true;
    }

    /**
     * Save user bio
     *
     * @param string $bio
     * @param \app\User $user
     * @return boolean
     */
    public function saveBio($bio, $user = null, $city = null)
    {
        $user = (empty($user)) ? \Auth::user() : $user;
        $user->bio = sanitizeText($bio);
        $user->save();

        return $user;
    }

    /**
     * save user privacy info
     *
     * @param array $val
     * @param \app\Models\User $user
     * @return boolean
     */
    public function savePrivacy($val, $user = null)
    {
        $user = (empty($user)) ? \Auth::user() : $user;

        $privacy = (empty($user->privacy_info)) ? [] : perfectUnserialize($user->privacy_info);
        $privacy = array_merge($privacy, $val);

        $user->privacy_info = perfectSerialize(sanitizeUserInfo($privacy));
        $user->save();

        $this->event->fire('user.save.privacy', [$user]);

        return true;
    }

    /**
     * @param $userid
     * @param $details
     * @return User
     * @throws \Exception
     */
    public function updateDetails($userid, array $details)
    {
        $user = $this->findById($userid);
        $user->update($details);
        return $user;
    }

    /**
     * @param int $id
     * @param array $column
     * @return User
     */
    public function findById($id, $column = ['*'])
    {
        return $this->model->find($id, $column);
    }

    /**
     * Returns an empty user object.
     *
     * @return \app\User
     */
    public function getEmptyUser()
    {
        return $this->model;
    }
}