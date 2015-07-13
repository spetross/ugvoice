<?php namespace app;

use Illuminate\Database\Eloquent\Model;

/**
 * app\Report
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $type
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Report whereUpdatedAt($value)
 */
class Report extends Model
{

    //

}
