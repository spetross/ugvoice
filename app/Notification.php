<?php namespace app;

use Illuminate\Database\Eloquent\Model;

/**
 * app\Notification
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $to_user_id
 * @property string $title
 * @property string $content
 * @property string $data
 * @property integer $seen
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereToUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereSeen($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Notification whereUpdatedAt($value)
 */
class Notification extends Model
{

    //

}
