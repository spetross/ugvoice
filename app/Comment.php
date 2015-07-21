<?php namespace App;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property string $content
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Post $post
 * @property-read \config('auth.model $user
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment wherePostId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUpdatedAt($value)
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
        return $this->belongsTo('App\Models\Post');
    }

}
