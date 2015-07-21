<?php namespace App\Traits;


/**
 * Trait AccessControl
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Models\Traits
 */
trait UserTrait
{


    /**
     *
     * @var array The user groups.
     */
    protected $userGroups;


    /**
     *
     * @var array The user merged permissions.
     */
    protected $mergedPermissions;


    /**
     * The login attribute.
     *
     * @var string
     */
    protected static $loginAttribute = 'email';


    protected static $hashableAttributes = [
        'password'
    ];


    /**
     *
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['permissions'];

    /**
     * Allowed permissions values.
     *
     * Possible options:
     *   -1 => Deny (adds to array, but denies regardless of user's group).
     *    0 => Remove.
     *    1 => Add.
     *
     * @var array
     */
    protected $allowedPermissionsValues = [-1, 0, 1];


    /**
     * Returns the user's ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * Returns the name for the user's login.
     *
     * @return string
     */
    public function getLoginName()
    {
        return static::$loginAttribute;
    }

    /**
     * Returns the user's login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->{$this->getLoginName()};
    }


    public function getHashableAttributes()
    {
        return static::$hashableAttributes;
    }


    /**
     * Returns the name for the user's password.
     *
     * @return string
     */
    public function getPasswordName()
    {
        return 'password';
    }

    /**
     * Returns the user's password (hashed).
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->{$this->getPasswordName()};
    }

    /**
     * Returns permissions for the user.
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }


    /**
     * Check if the user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        return (bool)$this->activated;
    }

    /**
     * Get mutator for giving the activated property.
     *
     * @param mixed $activated
     *
     * @return bool
     */
    public function getActivatedAttribute($activated)
    {
        return (bool)$activated;
    }

    /**
     * Checks if the user is a super user - has access to everything regardless of permissions.
     *
     * @return bool
     */
    public function isSuperUser()
    {
        return $this->hasPermission('superuser');
    }


    public function recordLogin()
    {
        $this->last_login = $this->freshTimestamp();
        $this->save();
    }

    /**
     * Get an activation code for the given user.
     *
     * @return string
     */
    public function getVerificationCode()
    {
        $this->verification_code = $verificationCode = $this->getRandomString();

        $this->save();

        return $verificationCode;
    }

    /**
     * Protects the password from being reset to null.
     */
    public function setPasswordAttribute($value)
    {
        if ($this->exists && empty($value)) {
            unset($this->attributes['password']);
        } else {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * Returns the relationship between users and groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot);
    }

    /**
     * Returns an array of groups which the given user belongs to.
     *
     * @return array
     */
    public function getGroups()
    {
        if (!$this->userGroups)
            $this->userGroups = $this->groups()->get();

        return $this->userGroups;
    }

    /**
     * Adds the user to the given group.
     *
     * @param \App\Group $group
     * @return bool
     */
    public function addGroup($group)
    {
        if (!$this->inGroup($group)) {
            $this->groups()->attach($group);
            $this->userGroups = null;
        }

        return true;
    }

    public function removeGroup($group)
    {
        if ($this->inGroup($group)) {
            $this->groups()->detach($group);
            $this->userGroups = null;
        }

        return true;
    }

    public function inGroup($group)
    {
        foreach ($this->getGroups() as $_group) {
            if ($_group->getKey() == $group->getKey())
                return true;
        }

        return false;
    }


    /**
     * Returns an array of merged permissions for each group the user is in.
     *
     * @return array
     */
    public function getMergedPermissions()
    {
        if (!$this->mergedPermissions) {
            $permissions = [];

            foreach ($this->getGroups() as $group) {
                if (!is_array($group->permissions))
                    continue;

                $permissions = array_merge($permissions, $group->permissions);
            }

            if (is_array($this->permissions))
                $permissions = array_merge($permissions, $this->permissions);

            $this->mergedPermissions = $permissions;
        }

        return $this->mergedPermissions;
    }

    /**
     * See if a user has access to the passed permission(s).
     * Permissions are merged from all groups the user belongs to
     * and then are checked against the passed permission(s).
     *
     * If multiple permissions are passed, the user must
     * have access to all permissions passed through, unless the
     * "all" flag is set to false.
     *
     * Super users have access no matter what.
     *
     * @param string|array $permissions
     * @param bool $all
     * @return bool
     */
    public function hasAccess($permissions, $all = true)
    {
        if ($this->isSuperUser())
            return true;

        return $this->hasPermission($permissions, $all);
    }


    /**
     * See if a user has access to the passed permission(s).
     * Permissions are merged from all groups the user belongs to
     * and then are checked against the passed permission(s).
     *
     * If multiple permissions are passed, the user must
     * have access to all permissions passed through, unless the
     * "all" flag is set to false.
     *
     * Super users DON'T have access no matter what.
     *
     * @param string|array $permissions
     * @param bool $all
     * @return bool
     */
    public function hasPermission($permissions, $all = true)
    {
        $mergedPermissions = $this->getMergedPermissions();

        if (!is_array($permissions))
            $permissions = [
                $permissions
            ];

        foreach ($permissions as $permission) {
            // We will set a flag now for whether this permission was
            // matched at all.
            $matched = true;

            // Now, let's check if the permission ends in a wildcard "*" symbol.
            // If it does, we'll check through all the merged permissions to see
            // if a permission exists which matches the wildcard.
            if ((strlen($permission) > 1) && ends_with($permission, '*')) {
                $matched = false;

                foreach ($mergedPermissions as $mergedPermission => $value) {
                    // Strip the '*' off the end of the permission.
                    $checkPermission = substr($permission, 0, -1);

                    // We will make sure that the merged permission does not
                    // exactly match our permission, but starts with it.
                    if ($checkPermission != $mergedPermission && starts_with($mergedPermission, $checkPermission) && $value == 1) {
                        $matched = true;
                        break;
                    }
                }
            } elseif ((strlen($permission) > 1) && starts_with($permission, '*')) {
                $matched = false;

                foreach ($mergedPermissions as $mergedPermission => $value) {
                    // Strip the '*' off the beginning of the permission.
                    $checkPermission = substr($permission, 1);

                    // We will make sure that the merged permission does not
                    // exactly match our permission, but ends with it.
                    if ($checkPermission != $mergedPermission && ends_with($mergedPermission, $checkPermission) && $value == 1) {
                        $matched = true;
                        break;
                    }
                }
            } else {
                $matched = false;

                foreach ($mergedPermissions as $mergedPermission => $value) {
                    // This time check if the mergedPermission ends in wildcard "*" symbol.
                    if ((strlen($mergedPermission) > 1) && ends_with($mergedPermission, '*')) {
                        $matched = false;

                        // Strip the '*' off the end of the permission.
                        $checkMergedPermission = substr($mergedPermission, 0, -1);

                        // We will make sure that the merged permission does not
                        // exactly match our permission, but starts with it.
                        if ($checkMergedPermission != $permission && starts_with($permission, $checkMergedPermission) && $value == 1) {
                            $matched = true;
                            break;
                        }
                    }

                    // Otherwise, we'll fallback to standard permissions checking where
                    // we match that permissions explicitly exist.
                    elseif ($permission == $mergedPermission && $mergedPermissions[$permission] == 1) {
                        $matched = true;
                        break;
                    }
                }
            }

            // Now, we will check if we have to match all
            // permissions or any permission and return
            // accordingly.
            if ($all === true && $matched === false) {
                return false;
            } elseif ($all === false && $matched === true) {
                return true;
            }
        }

        if ($all === false)
            return false;

        return true;
    }

    /**
     * Returns if the user has access to any of the given permissions.
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyAccess(array $permissions)
    {
        return $this->hasAccess($permissions, false);
    }


    /**
     * Mutator for giving permissions.
     *
     * @param mixed $permissions
     *
     * @return array $_permissions
     */
    public function getPermissionsAttribute($permissions)
    {
        if (!$permissions) {
            return [];
        }

        if (is_array($permissions)) {
            return $permissions;
        }

        if (!$_permissions = json_decode($permissions, true)) {
            throw new \InvalidArgumentException("Cannot JSON decode permissions [$permissions].");
        }

        return $_permissions;
    }

    /**
     * Validate any set permissions.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute($permissions)
    {
        // Merge permissions
        $permissions = array_merge($this->getPermissions(), $permissions);

        foreach ($permissions as $permission => &$value) {
            if (!in_array($value = (int)$value, $this->allowedPermissionsValues))
                throw new \InvalidArgumentException(sprintf('Invalid value "%s" for permission "%s" given.', $value, $permission));

            if ($value === 0)
                unset($permissions[$permission]);
        }

        $this->attributes['permissions'] = (!empty($permissions)) ? json_encode($permissions) : '';
    }

    /**
     * Generate a random string
     *
     * @return string
     */
    public function getRandomString($length = 42)
    {
        /*
         * Use OpenSSL (if available)
         */
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
                throw new \RuntimeException('Unable to generate a random string');

            return substr(str_replace([
                '/',
                '+',
                '='
            ], '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = parent::toArray();

        if (isset($result['permissions']))
            $result['permissions'] = $this->getPermissionsAttribute($result['permissions']);

        return $result;
    }


}