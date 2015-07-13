<?php namespace app;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * app\MessageConversation
 *
 * @property integer $id
 * @property integer $user1
 * @property integer $user2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \app\\Models\\User $userOne
 * @property-read \app\\Models\\User $userTwo
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\\Models\\Message[] $messages
 * @method static \Illuminate\Database\Query\Builder|\app\MessageConversation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\MessageConversation whereUser1($value)
 * @method static \Illuminate\Database\Query\Builder|\app\MessageConversation whereUser2($value)
 * @method static \Illuminate\Database\Query\Builder|\app\MessageConversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\MessageConversation whereUpdatedAt($value)
 */
class MessageConversation extends Model
{
    use PresentableTrait;

    protected $table = "message_conversation";

    protected $presenter = "app\\Presenters\\MessageConversationPresenter";

    public function userOne()
    {
        return $this->belongsTo('app\\Models\\User', 'user1');
    }

    public function userTwo()
    {
        return $this->belongsTo('app\\Models\\User', 'user2');
    }

    public function messages()
    {
        return $this->hasMany('app\\Models\\Message', 'conversation_id')->orderBy('id', 'desc');
    }
}