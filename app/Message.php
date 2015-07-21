<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Message
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
 * @property-read \App\\Models\\User $senderUser
 * @property-read \App\\Models\\User $receiverUser
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereSender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereReceiver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereConversationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereSenderStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereReceiverStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereSeen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereDeletedAt($value)
 */
class Message extends Model
{
    use PresentableTrait;

    protected $table = "messages";

    protected $presenter = "App\\Presenters\\MessagePresenter";

    public function senderUser()
    {
        return $this->belongsTo('App\\User', 'sender');
    }

    public function receiverUser()
    {
        return $this->belongsTo('App\\User', 'receiver');
    }

    public function image()
    {
        return $this->morphOne('App\File', 'attachable');
    }
}