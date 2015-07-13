<?php namespace app;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * app\User
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $permissions
 * @property boolean $verified
 * @property string $verification_code
 * @property boolean $active
 * @property string $last_active_time
 * @property \Carbon\Carbon $last_login
 * @property boolean $activated
 * @property string $first_name
 * @property string $last_name
 * @property string $genre
 * @property string $bio
 * @property string $profile_details
 * @property string $privacy_info
 * @property integer $organisation_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\config('credentials.revision[] $revisions
 * @property-read mixed $photo
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Article[] $articles
 * @property-read \app\Organisation $organisation
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$groupModel[] $groups
 * @method static \Illuminate\Database\Query\Builder|\app\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereVerificationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereLastActiveTime($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereActivated($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereGenre($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereBio($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereProfileDetails($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User wherePrivacyInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\User whereDeletedAt($value)
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Traits\UserTrait,
        //Traits\Revisionable,
        Authenticatable,
        CanResetPassword,
        SoftDeletes;

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'user';


    protected static $groupModel = 'app\Group';


    protected static $userGroupsPivot = "users_groups";

    protected $dates = [
        'last_login',
        'deleted_at',
        'activated_at'
    ];


    /**
     * The revisionable columns.
     *
     * @var array
     */
    protected $keepRevisionOf = ['email', 'password', 'activated', 'last_login', 'first_name', 'last_name'];

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = ['id', 'email', 'first_name', 'last_name'];

    /**
     * Access caches.
     *
     * @var array
     */
    protected $access = [];

    /**
     * Get the recent action history for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions()
    {
        return $this->hasMany(config('credentials.revision'));
    }

    /**
     * Get the user's action history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->revisions()
            ->where(function ($q) {
                $q->where('revisionable_type', '<>', get_class($this))
                    ->where('user_id', '=', $this->id);
            })
            ->orWhere(function ($q) {
                $q->where('revisionable_type', '=', get_class($this))
                    ->where('revisionable_id', '<>', $this->id)
                    ->where('user_id', '=', $this->id);
            })
            ->orderBy('id', 'desc')->take(20);
    }

    /**
     * Get the user's security history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function security()
    {
        return $this->revisionHistory()->orderBy('id', 'desc')->take(20);
    }

    /**
     * Activated at accessor.
     *
     * @param string $value
     *
     * @return \Carbon\Carbon|false
     */
    public function getActivatedAtAccessor($value)
    {
        if ($value) {
            return new Carbon($value);
        }

        if ($this->getAttribute('activated')) {
            return $this->getAttribute('created_at');
        }

        return false;
    }


    public function avatar()
    {
        return $this->morphOne('app\File', 'attachable');
    }

    public function getPhotoAttribute()
    {
        if ($this->avatar)
            return $this->avatar->path;
        else {
            $avatar = strtolower(substr($this->name, 0, 1));
            return asset('assets/img/avatar/' . $avatar . '/50.png');
        }
        return asset('assets/img/nophoto_user_thumb_icon.png');
    }

    public function getAvatar($size = 50)
    {
        $char = strtolower(substr($this->name, 0, 1));
        if ($this->avatar)
            return $this->avatar->getThumb($size, $size);
        else
            return asset('assets/img/avatar/' . $char . '/' . $size . '.png');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function articles()
    {
        return $this->hasMany('app\Article');
    }

    public function organisation()
    {
        return $this->belongsTo('app\Organisation');
    }

}