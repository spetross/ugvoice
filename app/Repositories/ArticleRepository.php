<?php namespace app\Repositories;

use app\Article;
use Carbon\Carbon;

class ArticleRepository
{

    protected $fileProvider;

    public function __construct(
        Article $article,
        FileRepository $fileProvider
    )
    {
        $this->model = $article;
        $this->fileProvider = $fileProvider;
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->query()
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param string $name
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function findByTitle($name)
    {
        return $this->model
            ->query()
            ->where('title', $name)
            ->first();
    }

    /**
     * Create new article
     * @param array $attributes
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function create(array $attributes)
    {
        $article = $this->model->newInstance();
        $article->title = $attributes['title'];
        $article->slug = str_slug($attributes['title']);
        $article->content = strip_tags($attributes['content']);
        $article->content_html = $attributes['content'];
        $article->status = $attributes['status'];
        if ('published' === trim($attributes['status'])) {
            $article->published = true;
            $article->published_at = new Carbon();
        }
        if (empty($attributes['excerpt']))
            $article->excerpt = str_limit($article->content, 200);
        else
            $article->content = $attributes['excerpt'];
        if (!empty($attributes['tags'])) {
            $article->tags = $attributes['tags'];
            $this->processTags($article, $attributes['tags']);
        }
        $user = \Auth::user();
        $article->user_id = $user->id;
        if ($user->organisation)
            $user->organisation->articles()->save($article);
        else
            $article->save();
        if (array_has($attributes, 'files')) {
            foreach ($attributes['files'] as $_file) {
                $file = $this->getFileModel()->find($_file);
                if ($file)
                    $article->photos()->save($file);
            }
        }
        return $article;
    }

    /**
     * Upda existing article
     * @param integer $id
     * @param array $attributes
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function update($id, array $attributes)
    {
        $article = $this->findById($id);
        $article->title = $attributes['title'];
        $article->content = strip_tags($attributes['content']);
        $article->content_html = $attributes['content'];
        if (!$article->published && 'published' === trim($attributes['status'])) {
            $article->published = true;
            $article->published_at = new Carbon();
        } else {
            $article->status = $attributes['status'];
        }
        if (empty($attributes['excerpt']))
            $article->excerpt = str_limit($article->content, 200);
        else
            $article->content = $attributes['excerpt'];
        if (!empty($attributes['tags'])) {
            $article->tags = $attributes['tags'];
            $this->processTags($article, $attributes['tags']);
        }
        $user = \Auth::user();
        if ($user->organisation)
            $user->organisation->articles()->save($article);
        else
            $article->save();
        if ($attributes['files']) {
            foreach ($attributes['files'] as $_file) {
                $file = $this->getFileModel()->find($_file);
                if ($file)
                    $article->photos()->save($file);
            }
        }
        return $article;
    }

    /**
     * @param Article $article
     * @param $tags
     */
    protected function processTags($article, $tags)
    {
        if (is_string($tags))
            $_tags = explode(',', $tags);
        else
            $_tags = $tags;
        $tags = [];
        foreach ($_tags as $_tag) {
            $tag = $article->tags()->firstOrCreate(['name' => trim($_tag)]);
            array_push($tags, $tag->getKey());
        }
        $article->tags()->sync($tags, true);
    }

    public function paginate($perpage = 15)
    {
        return $this->model->query()->paginate($perpage);
    }


    public function getNew()
    {
        return $this->model->newInstance();
    }


}