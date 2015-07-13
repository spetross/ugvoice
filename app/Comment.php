<?php namespace app;

use app\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

/**
 * app\Comment
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property string $content
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \app\Post $post
 * @property-read \config('auth.model $user
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment wherePostId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Comment whereUpdatedAt($value)
 */
class Comment extends Model
{

    use BelongsToUser;

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'comment';

    protected $fillable = [
        'content'
    ];


    public function post()
    {
        return $this->belongsTo('app\Models\Post');
    }

}
