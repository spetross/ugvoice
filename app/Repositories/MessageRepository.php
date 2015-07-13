<?php

namespace app\Repositories;

use app\Message;
use Illuminate\Events\Dispatcher;

/**
 * Class MessageRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Repositories
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
        $fromUserid = ($fromUserid) ? $fromUserid : \Auth::user()->id;

        if (!$this->canSendEachOther($userid, $fromUserid)) return false;

        $conversation = $this->conversationRepository->ensureConnection($userid, $fromUserid);

        $photo = '';
        if ($image) {
            $photo = $this->fileProvider->findById($image);
        }

        $message = $this->model->newInstance();
        $message->text = sanitizeText($text);
        $message->sender = sanitizeText($fromUserid);
        $message->receiver = sanitizeText($userid);
        $message->conversation_id = $conversation->id;
        $message->save();

        $message->image()->save($photo);

        $this->event->fire('message.send', [$message]);

        return $message;
    }

    public function canSendEachOther($userid, $fromUserid)
    {
        //we need to check the user privacy also on who can send message to user
        $user = app('app\\Repositories\\UserRepository')->findById($userid);

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

    public function getList($userid, $take = 5, $offset = 0, $time = null, $ignoreIds = null, $ignoreUserids = null)
    {
        $sender = $userid;
        $receiver = \Auth::user()->id;

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

        if ($ignoreUserids) {
            $query = $query->whereNotIn('sender', $ignoreUserids)
                ->where('seen', '=', '0');
        }

        if ($ignoreIds) {
            $query = $query->whereNotIn('id', $ignoreIds);
        }

        if ($time) {
            $query = $query->where('sender', '!=', \Auth::user()->id);
            $query = $query->where(function ($query) use ($time) {
                if ($time != 'nill') $query->where('created_at', '>', $time);

                if ($time != 'nill') {
                    $query->orWhere('seen', '=', '0');
                } else {
                    $query->where('seen', '=', '0');
                }

            });

        }

        $query = $query->orderBy('id', 'desc')
            ->skip($offset)
            ->take($take)
            ->get();

        return $query;
    }

    public function getNewList($ignoreIds, $limit = 10)
    {
        $userid = \Auth::user()->id;

        return $this->model->where('receiver', '=', $userid)
            ->whereNotIn('sender', $ignoreIds)
            ->where('seen', '=', 0)->orderBy('id', 'desc')->take($limit)->get();
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