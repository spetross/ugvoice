<?php namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $pictures
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \config('auth.model $user
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post wherePostType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereHasImages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post wherePrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereHideIdentity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUpdatedAt($value)
 */
class Post extends Model
{

    use Traits\BelongsToUser;

    protected $guarded = ['_token', '_method'];

    public static $name = 'post';

    public function pictures()
    {
        return $this->morphMany('App\File', 'attachable');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
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
