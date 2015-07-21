<?php namespace App\Handlers\Events;

use App\Exceptions\LoginRequiredException;
use App\Exceptions\PasswordRequiredException;
use App\Exceptions\UserNotActivatedException;
use App\Exceptions\UserNotFoundException;
use App\Repositories\GroupRepository as GroupProvider;
use App\Repositories\ThrottleRepository as ThrottleProvider;
use App\Repositories\UserRepository as UserProvider;

class Throttler
{

    protected $throttle = [];

    protected $useThrottle = true;

    protected $userProvider;

    protected $groupProvider;

    protected $throttleProvider;

    /**
     * Create the event handler.
     * @param UserProvider $userProvider
     * @param GroupProvider $groupProvider
     * @param ThrottleProvider $throttleProvider
     */
    public function __construct(
        UserProvider $userProvider,
        GroupProvider $groupProvider,
        ThrottleProvider $throttleProvider
    )
    {
        $this->userProvider = $userProvider;
        $this->groupProvider = $groupProvider;
        $this->throttleProvider = $throttleProvider;
        $this->ipAddress = \Request::ip();
    }

    /**
     * Handle the event.
     *
     * @param $credentials
     * @throws UserNotActivatedException
     * @throws UserNotFoundException
     * @throws \Exception
     */
    public function handle($credentials)
    {
        // We'll default to the login name field, but fallback to a hard-coded
        // 'login' key in the array that was passed.
        $loginName = $this->userProvider->getEmptyUser()->getLoginName();
        $loginCredentialKey = (isset($credentials[$loginName])) ? $loginName : 'username';

        if (empty($credentials[$loginCredentialKey])) {
            throw new LoginRequiredException("The [$loginCredentialKey] attribute is required.");
        }

        if (empty($credentials['password'])) {
            throw new PasswordRequiredException('The password attribute is required.');
        }

        // If the user did the fallback 'login' key for the login code which
        // did not match the actual login name, we'll adjust the array so the
        // actual login name is provided.
        if ($loginCredentialKey !== $loginName) {
            $credentials[$loginName] = $credentials[$loginCredentialKey];
            unset($credentials[$loginCredentialKey]);
        }

        // If throttling is enabled, we'll firstly check the throttle.
        // This will tell us if the user is banned before we even attempt
        // to authenticate them
        if ($throttlingEnabled = $this->throttleProvider->isEnabled()) {
            if ($throttle = $this->throttleProvider->findByUserLogin($credentials[$loginName], $this->ipAddress)) {
                $throttle->check();
            }
        }

        try {
            $user = $this->userProvider->findByCredentials($credentials);
        } catch (UserNotFoundException $e) {
            if ($throttlingEnabled and isset($throttle)) {
                $throttle->addLoginAttempt();
            }
            throw $e;
        }

        if ($throttlingEnabled and isset($throttle)) {
            $throttle->clearLoginAttempts();
        }

        if (!$user->isActivated()) {
            $login = $user->getLogin();
            throw new UserNotActivatedException("Cannot login user [$login] as they are not activated.");
        }
    }

}
