<?php namespace app;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * app\Message
 *
 * @property integer $id
 * @property string $text
 * @property integer $sender
 * @property integer $receiver
 * @property string $image
 * @property integer $conversation_id
 * @property integer $sender_status
 * @property integer $receiver_status
 * @property integer $seen
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \app\\Models\\User $senderUser
 * @property-read \app\\Models\\User $receiverUser
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereSender($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereReceiver($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereConversationId($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereSenderStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereReceiverStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereSeen($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\app\Message whereDeletedAt($value)
 */
class Message extends Model
{
    use PresentableTrait;

    protected $table = "messages";

    protected $presenter = "app\\Presenters\\MessagePresenter";

    public function senderUser()
    {
        return $this->belongsTo('app\\User', 'sender');
    }

    public function receiverUser()
    {
        return $this->belongsTo('app\\User', 'receiver');
    }

    public function image()
    {
        return $this->morphOne('app\File', 'attachable');
    }
}