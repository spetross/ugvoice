<?php namespace app;

use Illuminate\Database\Eloquent\Model;

/**
 * app\Tag
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\app\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Tag whereUpdatedAt($value)
 */
class Tag extends Model
{
    protected $table = 'article_tags';
    protected $fillable = [
        'name'
    ];
}
