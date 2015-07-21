<?php namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Throttle
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip_address
 * @property integer $attempts
 * @property boolean $suspended
 * @property boolean $banned
 * @property \Carbon\Carbon $last_attempt_at
 * @property \Carbon\Carbon $suspended_at
 * @property \Carbon\Carbon $banned_at
 * @property-read \static::$userModel $user
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereIpAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereAttempts($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereSuspended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereLastAttemptAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereSuspendedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Throttle whereBannedAt($value)
 */
class Throttle extends Model
{

    use Traits\ThrottlerTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'throttle';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'throttle';

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected static $userModel = 'App\User';

    /**
     * Attempt limit.
     *
     * @var int
     */
    protected static $attemptLimit = 5;

    /**
     * Suspensions time in minutes.
     *
     * @var int
     */
    protected static $suspensionTime = 15;

}