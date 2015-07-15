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
        $this->theme->share('user', \Auth::user());
        $this->user = \Auth::user();
    }


    public function OnSend()
    {
        $userId = $this->request->input('user_id');
        $text = $this->request->input('message');
        $type = $this->request->input('type');

        if(empty($text)) {
            return ['alert' => 'No Message specified'];
        }

        $message = $this->messageRepository->send($userId, $text);

        if ($type == 'alert') {
            return trans('message.sent');
        } else {
            if ($message) {
                return ['Message' => view('messages.message', ['message' => $message])->render()];
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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;
        if($this->request->has('user')) {
            $user = $this->userRepository->findByIdUsername(e($this->request->query('user')));
            if(!$user)
                return redirect()->route('messages');
            if($user->id == $this->user->id)
                return redirect()->route('messages');
        } else {
            $lastConversation = $this->conversationRepository->lastConversation();
            if ($lastConversation) {
                $user = $lastConversation->present()->theUser();
                $this->messageRepository->markAllByUser($user->id);
            }
        }

        $this->theme->set('title', trans('message.messages'));
        $this->asset()->container('footer')
            ->add('messages', 'assets/js/messages.js', ['main']);
        $conversations = $this->conversationRepository->listAll();
        if($this->request->ajax()) {
            $response  = [];
            if($user) {
                $messages = $this->messageRepository->getNewList($user->id, 5);
                if(!$messages->isEmpty()) {
                    if ($messages->count() > 5) {
                        $response['page'] = $messages->currentPage() + 1;
                        $response['Messages'] = view('messages.thread', ['messages' => $messages, 'contact' => $user])->render();
                    } else {
                        $response['Messages'] = array();
                        foreach ($messages as $message) {
                            array_push($response['Messages'], view('messages.message', ['message' => $message, 'contact' => $user])->render());
                        }
                    }
                }
            }
            return $response;
        }
        return $this->theme->of('messages.index', [
            'conversations' => $conversations,
            'contact'       => $user,
            'messages'      => ($user) ? $this->messageRepository->getList($user->id) : []
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