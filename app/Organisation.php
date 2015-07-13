<?php namespace app;

use Illuminate\Database\Eloquent\Model;

/**
 * app\Organisation
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $cc_email
 * @property string $website
 * @property string $mission
 * @property string $objectives
 * @property string $description
 * @property string $phone
 * @property string $cc_phone
 * @property string $facebook
 * @property string $twitter
 * @property string $google
 * @property string $country
 * @property string $address
 * @property integer $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereCcEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereMission($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereObjectives($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereCcPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereGoogle($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Organisation whereUpdatedAt($value)
 */
class Organisation extends Model
{

    protected $table = 'organisations';

    public static $name = 'organisation';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function logo()
    {
        return $this->morphOne('app\File', 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('app\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('app\Article');
    }
}
