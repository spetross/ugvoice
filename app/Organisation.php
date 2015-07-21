<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Organisation
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereCcEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereMission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereObjectives($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereCcPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereGoogle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organisation whereUpdatedAt($value)
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
        return $this->morphOne('App\File', 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
