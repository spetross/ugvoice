<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property string $excerpt
 * @property string $content
 * @property string $content_html
 * @property string $status
 * @property boolean $published
 * @property \Carbon\Carbon $published_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Organisation $organisation
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereOrganisationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereExcerpt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereContentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article published()
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
        return $this->belongsTo('App\Organisation', 'organisation_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag');

    }

    public function author()
    {
        return $this->belongsTo(config('auth.model'), 'user_id');
    }

    public function photos()
    {
        return $this->morphMany('App\File', 'attachable');
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
