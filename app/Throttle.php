<?php namespace app;


use Illuminate\Database\Eloquent\Model;

/**
 * app\Throttle
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
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereIpAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereAttempts($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereSuspended($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereLastAttemptAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereSuspendedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Throttle whereBannedAt($value)
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
    protected static $userModel = 'app\User';

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