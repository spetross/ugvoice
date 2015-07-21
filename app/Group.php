<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 *
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Models
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $permissions
 * @property boolean $is_new_user_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$userModel[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereIsNewUserDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereUpdatedAt($value)
 */
class Group extends Model
{

    use Traits\GroupTrait;

    public static $name = "group";

    protected static $userModel = 'App\User';

    protected static $userGroupsPivot = 'users_groups';


    public function addAllUsersToGroup()
    {
        $this->users()->sync(User::lists('id'));
    }

}