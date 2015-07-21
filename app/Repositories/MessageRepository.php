<?php

namespace App\Repositories;

use App\Message;
use Illuminate\Events\Dispatcher;

/**
 * Class MessageRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Repositories
 */
class MessageRepository
{

    public function __construct(
        Message $message,
        MessageConversationRepository $messageConversationRepository,
        FileRepository $fileRepository,
        Dispatcher $event
    )
    {
        $this->model = $message;
        $this->conversationRepository = $messageConversationRepository;
        $this->fileProvider = $fileRepository;
        $this->event = $event;
    }


    /**
     * Method to send message to a user
     *
     * @param int $userid
     * @param string $text
     * @param string $image
     * @param int $fromUserid
     * @return bool
     */
    public function send($userid, $text, $image = null, $fromUserid = null)
    {
        $fromUserid = ($fromUserid) ? $fromUserid : \Auth::id();

        //if (!$this->canSendEachOther($userid, $fromUserid)) return false;

        $conversation = $this->conversationRepository->ensureConnection($userid, $fromUserid);

        $message = $this->model->newInstance();
        $message->text = e($text);
        $message->sender = e($fromUserid);
        $message->receiver = e($userid);
        $message->conversation_id = $conversation->id;
        $message->save();

        if ($image) {
            $photo = $this->fileProvider->findById($image);
            $message->image()->save($photo);
        }

        $this->event->fire('message.send', [$message]);

        return $message;
    }

    public function canSendEachOther($userid, $fromUserid)
    {
        //we need to check the user privacy also on who can send message to user
        $user = app('App\\Repositories\\UserRepository')->findById($userid);

        if (!$user->present()->canSendMessage()) return false;
        return true;
    }

    public function countNew()
    {
        return $this->model
            ->where('seen', '=', 0)
            ->where('receiver', '=', \Auth::user()->id)
            ->count();
    }

    public function getUnread($limit = 5)
    {
        return $this->model->with('senderUser')
            ->where('seen', '=', 0)
            ->where('receiver', '=', \Auth::user()->id)
            ->orderBy('id', 'desc')
            ->groupBy('sender')
            ->take($limit)->get();
    }

    public function markAllByUser($userid)
    {
        return $this->model->where('receiver', '=', \Auth::user()->id)
            ->where('sender', '=', $userid)->update(['seen' => 1]);
    }

    public function lastMessage($sender)
    {
        return $this->model->where('sender', '=', $sender)
            ->where('receiver', '=', \Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function countUnreadFrom($sender)
    {
        return $this->model->where('sender', '=', $sender)
            ->where('receiver', '=', \Auth::user()->id)
            ->where('seen', '=', 0)
            ->count();
    }

    public function getList($userid, $take = 5)
    {
        $sender = $userid;
        $receiver = \Auth::id();

        $query = $this->model->with('senderUser', 'receiverUser')
            ->where(function ($query) use ($sender, $receiver) {
                $query->where(function ($message) use ($sender, $receiver) {
                    $message->where('sender', '=', $sender)
                        ->where('receiver', '=', $receiver);
                })->orWhere(function ($message) use ($sender, $receiver) {
                    $message->where('sender', '=', $receiver)
                        ->where('receiver', '=', $sender);
                });
            });


        $query = $query->latest()->paginate($take);
        if(!$query->isEmpty()) {
            $firstMessage = $query->first();
            $lastMessage = $query->last();
            session(['firstMessage' => $firstMessage->id, 'lastMessage' => $lastMessage->id]);
        }
        return $query;
    }

    /**
     * @param $userid
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNewList($userid)
    {
        $sender = $userid;
        $receiver = \Auth::id();

        $query = $this->model->with('senderUser', 'receiverUser')
            ->where(function ($query) use ($sender, $receiver) {
                $query->where(function ($message) use ($sender, $receiver) {
                    $message->where('sender', '=', $sender)
                        ->where('receiver', '=', $receiver);
                })->orWhere(function ($message) use ($sender, $receiver) {
                    $message->where('sender', '=', $receiver)
                        ->where('receiver', '=', $sender);
                });
            });

        $query = $query->latest()->get();
        $filter = range(session('firstMessage'), 1);
        $messages = $query->except($filter);
        $firstMessage = $query->first();
        session(['firstMessage' => $firstMessage->id]);
        return $messages;
    }

    public function get($id)
    {
        return $this->model->where('id', '=', $id)->first();
    }

    public function delete($id)
    {
        $message = $this->get($id);
        $userid = \Auth::user()->id;

        if ($message->sender == $userid) {
            $message->sender_status = 1;
        } else {
            $message->receiver_status = 1;
        }
        $message->save();
    }

    public function deleteAllByUser($userid)
    {
        return $this->model->where('sender', '=', $userid)
            ->orWhere('receiver', '=', $userid)
            ->delete();
    }


}