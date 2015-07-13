<?php namespace app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * app\Article
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Database\Eloquent\Collection|\app\Tag[] $tags
 * @property string $excerpt
 * @property string $content
 * @property string $content_html
 * @property string $status
 * @property boolean $published
 * @property \Carbon\Carbon $published_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \app\Organisation $organisation
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereExcerpt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereContentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Article published()
 */
class Article extends Model
{

    public static $name = 'article';

    /**
     *
     */
    protected $dates = ['published_at'];

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', TRUE)
            ->where('published_at', '>=', Carbon::now());
    }


    public function organisation()
    {
        return $this->belongsTo('app\Organisation', 'organisation_id');
    }

    public function tags()
    {
        return $this->belongsToMany('app\Tag', 'article_tag');

    }

    public function author()
    {
        return $this->belongsTo(config('auth.model'), 'user_id');
    }

    public function photos()
    {
        return $this->morphMany('app\File', 'attachable');
    }

    public function getUrl()
    {
        $params = [
            'year' => date('Y', strtotime($this->created_at)),
            'month' => date('m', strtotime($this->created_at)),
            'day' => date('d', strtotime($this->created_at)),
            'slug' => $this->slug,
        ];
        return $this->url = route('article.show', $params);
    }
}
