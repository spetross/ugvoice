<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\MessageConversation
 *
 * @property integer $id
 * @property integer $user1
 * @property integer $user2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\\Models\\User $userOne
 * @property-read \App\\Models\\User $userTwo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\\Models\\Message[] $messages
 * @method static \Illuminate\Database\Query\Builder|\App\MessageConversation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageConversation whereUser1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageConversation whereUser2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageConversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageConversation whereUpdatedAt($value)
 */
class MessageConversation extends Model
{
    use PresentableTrait;

    protected $table = "message_conversation";

    protected $presenter = "App\\Presenters\\MessageConversationPresenter";

    public function userOne()
    {
        return $this->belongsTo('App\\User', 'user1');
    }

    public function userTwo()
    {
        return $this->belongsTo('App\\User', 'user2');
    }

    public function messages()
    {
        return $this->hasMany('App\\Message', 'conversation_id')->orderBy('id', 'desc');
    }
}