<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $type
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereUpdatedAt($value)
 */
class Report extends Model
{

    //

}
