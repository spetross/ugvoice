<?php namespace App\Traits;

use App\Exceptions\GroupExistsException;

/**
 * Trait GroupTrait
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Models\Traits
 */
trait GroupTrait
{

    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['permissions'];

    /**
     * Allowed permissions values.
     *
     * Possible options:
     *    0 => Remove.
     *    1 => Add.
     *
     * @var array
     */
    protected $allowedPermissionsValues = [0, 1];


    /**
     * Returns the group's ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * Returns the relationship between groups and users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$userModel, static::$userGroupsPivot);
    }

    /**
     * Set the Eloquent model to use for user relationships.
     *
     * @param string $model
     *
     * @return void
     */
    public static function setUserModel($model)
    {
        static::$userModel = $model;
    }

    /**
     * Set the user groups pivot table name.
     *
     * @param string $tableName
     *
     * @return void
     */
    public static function setUserGroupsPivot($tableName)
    {
        static::$userGroupsPivot = $tableName;
    }

    /**
     * Saves the group.
     *
     * @param array $options
     *
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->validate();

        return parent::save();
    }

    /**
     * Delete the group.
     *
     * @return bool
     */
    public function delete()
    {
        $this->users()->detach();

        return parent::delete();
    }

    /**
     * Validates the group and throws a number of
     * Exceptions if validation fails.
     * @return bool
     * @throws \Exception
     */
    public function validate()
    {
        // Check if name field was passed
        if (!$name = $this->name) {
            throw new \Exception("A name is required for a group, none given.");
        }

        // Check if group already exists
        $query = $this->newQuery();
        $persistedGroup = $query->where('name', '=', $name)->first();

        if ($persistedGroup and $persistedGroup->getId() != $this->getId()) {
            throw new GroupExistsException("A group already exists with name [$name], names must be unique for groups.");
        }

        return true;
    }


    /**
     * Returns permissions for the group.
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * See if a group has access to the passed permission(s).
     *
     * If multiple permissions are passed, the group must
     * have access to all permissions passed through, unless the
     * "all" flag is set to false.
     *
     * @param string|array $permissions
     * @param bool $all
     *
     * @return bool
     */
    public function hasAccess($permissions, $all = true)
    {
        $groupPermissions = $this->getPermissions();

        if (!is_array($permissions)) {
            $permissions = (array)$permissions;
        }

        foreach ($permissions as $permission) {
            // We will set a flag now for whether this permission was
            // matched at all.
            $matched = true;

            // Now, let's check if the permission ends in a wildcard "*" symbol.
            // If it does, we'll check through all the merged permissions to see
            // if a permission exists which matches the wildcard.
            if ((strlen($permission) > 1) and ends_with($permission, '*')) {
                $matched = false;

                foreach ($groupPermissions as $groupPermission => $value) {
                    // Strip the '*' off the end of the permission.
                    $checkPermission = substr($permission, 0, -1);

                    // We will make sure that the merged permission does not
                    // exactly match our permission, but starts with it.
                    if ($checkPermission != $groupPermission and starts_with($groupPermission, $checkPermission) and $value == 1) {
                        $matched = true;
                        break;
                    }
                }
            }

            // Now, let's check if the permission starts in a wildcard "*" symbol.
            // If it does, we'll check through all the merged permissions to see
            // if a permission exists which matches the wildcard.
            elseif ((strlen($permission) > 1) and starts_with($permission, '*')) {
                $matched = false;

                foreach ($groupPermissions as $groupPermission => $value) {
                    // Strip the '*' off the start of the permission.
                    $checkPermission = substr($permission, 1);

                    // We will make sure that the merged permission does not
                    // exactly match our permission, but ends with it.
                    if ($checkPermission != $groupPermission and ends_with($groupPermission, $checkPermission) and $value == 1) {
                        $matched = true;
                        break;
                    }
                }
            } else {
                $matched = false;

                foreach ($groupPermissions as $groupPermission => $value) {
                    // This time check if the groupPermission ends in wildcard "*" symbol.
                    if ((strlen($groupPermission) > 1) and ends_with($groupPermission, '*')) {
                        $matched = false;

                        // Strip the '*' off the end of the permission.
                        $checkGroupPermission = substr($groupPermission, 0, -1);

                        // We will make sure that the merged permission does not
                        // exactly match our permission, but starts wtih it.
                        if ($checkGroupPermission != $permission and starts_with($permission, $checkGroupPermission) and $value == 1) {
                            $matched = true;
                            break;
                        }
                    }

                    // Otherwise, we'll fallback to standard permissions checking where
                    // we match that permissions explicitly exist.
                    elseif ($permission == $groupPermission and $groupPermissions[$permission] == 1) {
                        $matched = true;
                        break;
                    }
                }
            }

            // Now, we will check if we have to match all
            // permissions or any permission and return
            // accordingly.
            if ($all === true and $matched === false) {
                return false;
            } elseif ($all === false and $matched === true) {
                return true;
            }
        }

        return $all;
    }

    /**
     * Returns if the user has access to any of the
     * given permissions.
     *
     * @param array $permissions
     *
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
     * @throws \InvalidArgumentException
     *
     * @return array
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
     * Mutator for taking permissions.
     *
     * @param array $permissions
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        // Merge permissions
        $permissions = array_merge($this->getPermissions(), $permissions);

        // Loop through and adjust permissions as needed
        foreach ($permissions as $permission => &$value) {
            // Lets make sure their is a valid permission value
            if (!in_array($value = (int)$value, $this->allowedPermissionsValues)) {
                throw new \InvalidArgumentException("Invalid value [$value] for permission [$permission] given.");
            }

            // If the value is 0, delete it
            if ($value === 0) {
                unset($permissions[$permission]);
            }
        }

        $this->attributes['permissions'] = (!empty($permissions)) ? json_encode($permissions) : '';
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = parent::toArray();

        if (isset($attributes['permissions'])) {
            $attributes['permissions'] = $this->getPermissionsAttribute($attributes['permissions']);
        }

        return $attributes;
    }


}