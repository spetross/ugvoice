<?php

namespace App\Http\Controllers;

use App\Repositories\MessageConversationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;


/**
 * Class MessageController
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Http\Controllers
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
        $this->asset()->add('profile', 'assets/css/profile.css');
        $this->asset()->container('footer')
            ->add('messages', 'assets/js/messages.js', ['main']);
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

    /**
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function read($user)
    {
        if($user == $this->user) {
            \Flash::error('Invalid user');
            return redirect()->route('messages');
        }
        $conversations = $this->conversationRepository->listAll();
        $messages = $this->messageRepository->getList($user->id);
        $response = $this->render('messages.index', compact('messages', 'user', 'conversations'));
        if($this->request->ajax()) $response = $this->render('messages.thread', compact('messages', 'user'));
        return $response;
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
    public function index($user = null)
    {
        $this->setTitle(trans('message.messages'));

        $conversations = $this->conversationRepository->listAll();

        if($user) {
            if($user == $this->user) {
                \Flash::error('Invalid user');
                return redirect()->route('messages');
            }
            $messages = $this->messageRepository->getList($user->id);
        }
        $response = $this->render('messages.index', compact('messages', 'user', 'conversations'));
        if($this->request->ajax()) $response = $this->render('messages.thread', compact('messages', 'user'));
        return $response;
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