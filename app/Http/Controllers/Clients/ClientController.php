<?php namespace app\Http\Controllers\Clients;

use app\Http\Controllers\AppController;
use app\Repositories\FileRepository;

class ClientController extends AppController
{
    /**
     * @var \app\Organisation
     */
    protected $client;

    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct();
        if ($this->request->route('client')) {
            $this->client = $this->request->route('client');
            $this->title = $this->client->name;
            $this->theme->share('client', $this->client);
            $this->theme->layout('clients.page');
            $this->asset()->container('footer')->add('tab-history', 'assets/vendor/sui/history.min.js', ['jquery']);
        }
        $this->fileProvider = $fileRepository;
    }

    /**
     * Show client public profile page.
     *
     * @return \Response
     */
    public function home()
    {
        $this->asset()->container('footer')->add('timeago', 'assets/vendor/jquery.timeago.js', ['jquery']);
        $this->asset()->container('footer')->add('auto-textarea', 'assets/vendor/autosize.min.js', ['jquery']);
        $this->asset()->container('footer')->add('client', 'assets/js/client.js', ['auto-textarea', 'timeago', 'core']);
        return $this->timeline();
    }

    public function timeline()
    {
        $query = $this->client->posts();
        $posts = $query->latest()->paginate(3);
        if (!$posts->isEmpty()) {
            $post = $posts->first();
            session(['lastPost' => $post->id]);
        }
        return $this->render('client.timeline', compact('posts'));
    }

    public function about()
    {
        return $this->render('client.about');
    }

    public function articles()
    {
        return $this->render('client.articles');
    }


}
