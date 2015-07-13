<?php

namespace app\Http\Controllers\Clients;

use app\Exceptions\ArticleNotFoundException;
use app\Repositories\ArticleRepository;
use app\Repositories\FileRepository;

class ArticleController extends ClientController
{

    public function __construct(
        FileRepository $repository,
        ArticleRepository $articleRepository
    )
    {
        parent::__construct($repository);
        $this->articleProvider = $articleRepository;
    }

    public function index()
    {
        $articles = $this->client->articles()->getQuery()->paginate(20);
        return $this->render('client.articles.index', compact('articles'));
    }

    public function create()
    {
        $article = $this->articleProvider->getNew();
        return $this->render('client.articles.form', compact('article'));
    }

    public function store()
    {
    }

    public function edit($id)
    {
        $article = $this->client->articles()->getQuery()->find($id);
        if ($article)
            return $this->render('client.articles.form', compact('article'));
        throw new ArticleNotFoundException;
    }

    public function update($id)
    {
    }
}