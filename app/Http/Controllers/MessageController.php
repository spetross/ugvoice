<?php

namespace app\Http\Controllers;

use app\Repositories\MessageConversationRepository;
use app\Repositories\MessageRepository;
use app\Repositories\UserRepository;


/**
 * Class MessageController
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Http\Controllers
 */
class MessageController extends AppController
{

    public function __construct(MessageRepository $messageRepository,
                                MessageConversationRepository $messageConversationRepository,
                                UserRepository $userRepository
    )
    {
        $this->messageRepository = $messageRepository;
        $this->conversationRepository = $messageConversationRepository;
        $this->userRepository = $userRepository;
        parent::__construct();
        $this->theme->layout('user.private');
        $this->theme->share('user', \Auth::user());
    }


    public function send()
    {
        $userid = \Input::get('userid');
        $text = \Input::get('text');
        $type = \Input::get('type');

        $message = $this->messageRepository->send($userid, $text);

        if ($type == 'alert') {
            return trans('message.sent');
        } else {
            if ($message) {
                return $this->theme->section('messages.display', ['message' => $message]);
            }
            return 0;
        }
    }


    public function more()
    {
        $limit = 5;
        $userid = \Input::get('userid');
        $offset = \Input::get('offset');
        $offset = (empty($offset)) ? $limit : $offset;
        $newOffset = $offset + $limit;


        return json_encode([
            'offset' => $newOffset,
            'content' => (String)$this->theme->section('messages.paginate', ['messages' => $this->messageRepository->getList($userid, $limit, $offset)])
        ]);
    }

    public function index()
    {
        $userid = \Input::get('user');

        if ($userid) {
            $user = $this->userRepository->findByIdUsername($userid);
            if ($user) $userid = $user->id;
            else return \Redirect::route('messages');
        }
        if ($userid == \Auth::id()) return \Redirect::route('messages');

        if (empty($userid)) {
            $lastConversation = $this->conversationRepository->lastConversation();
            if ($lastConversation) {
                $userid = $lastConversation->present()->theUser()->id;

                $this->messageRepository->markAllByUser($userid);
            }
        }
        $this->theme->set('title', trans('message.messages'));
        $this->theme->asset()->container('ace')->add('messages', 'js/messages.js', ['application']);
        return $this->theme->of('messages.index', [
            'conversations' => $this->conversationRepository->listAll(),
            'userid' => $userid,
            'messages' => ($userid) ? $this->messageRepository->getList($userid) : []
        ])->render();
    }

    public function setOnlineStatus()
    {
        $status = \Input::get('status');
        if (\Auth::check()) \Auth::user()->updateStatus($status, true);
    }

    public function delete()
    {
        $id = \Input::get('id');
        $this->messageRepository->delete($id);
    }


}