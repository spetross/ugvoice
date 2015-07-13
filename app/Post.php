<?php namespace app;


use Illuminate\Database\Eloquent\Model;

/**
 * app\Post
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property string $post_type
 * @property boolean $has_images
 * @property string $title
 * @property string $content
 * @property string $link
 * @property boolean $private
 * @property boolean $hide_identity
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\File[] $pictures
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Comment[] $comments
 * @property-read \config('auth.model $user
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post wherePostType($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereHasImages($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post wherePrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereHideIdentity($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Post whereUpdatedAt($value)
 */
class Post extends Model
{

    use Traits\BelongsToUser;

    protected $guarded = ['_token', '_method'];

    public static $name = 'post';

    public function pictures()
    {
        return $this->morphMany('app\File', 'attachable');
    }

    public function comments()
    {
        return $this->hasMany('app\Comment');
    }

    public function timestamp()
    {
        if ($this->created_at->isYesterday()) {
            return 'Yesterday at ' . date('g:ia');
        } elseif ($this->created_at->diffInSeconds() < 60) {
            return 'Just now';
        } else {
            return $this->created_at->diffForHumans();
        }
    }
}
