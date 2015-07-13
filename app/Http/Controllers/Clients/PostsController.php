<?php

namespace app\Http\Controllers\Clients;

/**
 * Class PostsController
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Http\Controllers\Clients
 */
class PostsController extends ClientController
{


    public function index()
    {
        if ($this->request->ajax() && $this->request->isMethod('post'))
            return $this->onRefresh();
        $this->asset()->container('footer')->add('timeago', 'assets/vendor/jquery.timeago.js', ['jquery']);
        $this->asset()->container('footer')->add('auto-textarea', 'assets/vendor/autosize.min.js', ['jquery']);
        $this->asset()->container('footer')->add('client', 'assets/js/client.js', ['auto-textarea', 'timeago', 'core']);
        /** @var \Illuminate\Database\Eloquent\Collection $posts */
        $posts = $this->client->posts()->latest()->paginate(4);
        if (!$posts->isEmpty()) {
            $post = $posts->first();
            session(['lastPost' => $post->id]);
        }
        return $this->render('client.posts.timeline.index', compact('posts'));
    }

    public function posts()
    {
        $response = [];
        $posts = $this->client->posts()->latest()->paginate(3);
        $response['success'] = true;
        /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $posts */
        if ($posts->hasMorePages())
            $response['nextPage'] = $posts->currentPage() + 1;
        $response['Posts'] = [];
        foreach ($posts as $post) {
            array_push($response['Posts'], view('client.posts.post', compact('post'))->render());
        }
        return $response;
    }

    public function onRefresh()
    {
        $response = [];
        /** @var \Illuminate\Database\Eloquent\Collection $posts */
        $posts = $this->client->posts()->latest()->get();

        $filter = range(session('lastPost'), 1);
        $posts = $posts->except($filter);
        if ($posts->isEmpty())
            \Flash::info('No more posts');
        else {
            $firstItem = $posts->first();
            session(['lastPost' => $firstItem->id]);
            $response['Posts'] = [];
            foreach ($posts as $post) {
                array_push($response['Posts'], $this->theme->partial('client.timeline.post', compact('post')));
            }
        }

        return $response;
    }

    public function onPost()
    {
        $response = [];
        if ($this->request->has('Post.content') || $this->request->has('Post.link') || $this->request->has('files')) {
            /** @var \app\Post $post */
            $post = $this->client->posts()
                ->create([
                    'content' => $this->request->input('Post.content'),
                    'link' => $this->request->input('Post.link')
                ]);
            $post->user_id = \Auth::id();
            if ($this->request->has('Post.user_anonymous')) {
                $post->hide_identity = true;
            }
            if ($this->request->has('files')) {
                $post->has_images = true;
                foreach ($this->request->input('files') as $_fileId) {
                    $file = $this->fileProvider->findById($_fileId);
                    $post->pictures()->save($file);
                }
            }
            $post->save();
            if ($this->request->ajax()) {
                session(['lastPost' => $post->id]);
                $response['success'] = true;
                $response['Post'] = view('client.posts.post', compact('post'))->render();
                return $response;
            }
        }
        return null;
    }

    public function editPost($client, $postId)
    {

    }

    public function updatePost($client, $postId)
    {

    }

    /**
     * @param \app\Organisation $client
     * @param $postId
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function onComment($client, $postId)
    {
        $response = [];
        /** @var \app\Post $post */
        if ($this->request->has('Post.comment')) {
            $post = $client->posts()->getQuery()->find($postId);
            /** @var \app\Post $comment */
            $comment = $post->comments()
                ->create([
                    'content' => $this->request->input('Post.comment')
                ]);
            $comment->user_id = \Auth::id();
            $comment->organisation_id = $client->id;
            $comment->save();
            $response['commentsCount'] = $post->comments->count();
            if ($this->request->ajax()) {
                $response['Comment'] = view('client.posts.comment', compact('comment'))->render();
                return $response;
            }
            return redirect(action('ClientController@showPost', $client->slug, $post->id));
        }
        return $response;
    }

    public function pageComments()
    {

    }

    public function editComment($client, $commentId)
    {
    }

    public function updateComment($client, $commentId)
    {
    }

}