<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notification
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
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereToUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereSeen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereUpdatedAt($value)
 */
class Notification extends Model
{

    //

}
