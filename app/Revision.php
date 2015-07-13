<?php namespace app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * app\Revision
 *
 * @property integer $id
 * @property string $revisionable_type
 * @property integer $revisionable_id
 * @property integer $user_id
 * @property string $key
 * @property string $old_value
 * @property string $new_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \ $revisionable
 * @property-read \config('auth.model $user
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereRevisionableType($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereRevisionableId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereOldValue($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereNewValue($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Revision whereDeletedAt($value)
 */
class Revision extends Model
{

    use Traits\BelongsToUser, SoftDeletes;

    /**
     * The table the groups are stored in.
     *
     * @var string
     */
    protected $table = 'revisions';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'revision';

    /**
     * The properties on the model that are dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = ['*'];

    /**
     * The max groups per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'id';

    /**
     * This defines if the model should be treated
     * in the context of being a security action.
     *
     * @var bool
     */
    public $security = false;

    /**
     * Get the model the action as been taken on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function revisionable()
    {
        return $this->morphTo();
    }


}
