<?php namespace app\Repositories;

use app\Exceptions\OrganisationNotFoundException;
use app\Organisation;

class OrganisationRepository
{


    protected $model;

    protected $fileProvider;

    /**
     * @param Organisation $organisation
     * @param FileRepository $fileProvider
     */
    public function __construct(
        Organisation $organisation,
        FileRepository $fileProvider
    )
    {
        $this->model = $organisation;
        $this->fileProvider = $fileProvider;
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection|null|Article
     */
    public function findById($id)
    {
        $model = $this->model->find($id);
        if ($model) return $model;
        throw new OrganisationNotFoundException;
    }


    /**
     * @param string $slug
     * @return mixed|Organisation
     */
    public function findBySlug($slug)
    {
        $model = $this->model->whereSlug($slug)->first();
        if ($model) return $model;
        throw new OrganisationNotFoundException;
    }

    /**
     * @param string $name
     * @return mixed|Organisation
     */
    public function findByName($name)
    {
        $model = $this->model->whereName($name)->first();
        if ($model) return $model;
        throw new OrganisationNotFoundException;
    }


    public function getFeatured()
    {
        return $this->model->newQuery()->take(4);
    }

    /**
     * Create new organisation
     * @param array $attributes
     * @return OrganisationInterface
     */
    public function create(array $attributes)
    {
        $organisation = parent::create($attributes);

        if (array_has($attributes, 'file')) {
            $file = $this->fileProvider->findById($attributes['file']);
            if ($file)
                $organisation->logo()->save($file);
        }
        return $organisation;
    }

    /**
     * Upda existing organisation
     * @param integer $id
     * @param array $attributes
     * @return OrganisationInterface
     */
    public function update($id, array $attributes)
    {
        $organisation = $this->findById($id);
        $organisation->update($attributes);
        if (array_has($attributes, 'file')) {
            $file = $this->fileProvider->findById($attributes['file']);
            if ($file)
                $organisation->logo()->save($file);
        }
        return $organisation;
    }


    public function savePost($val)
    {
        /**
         * $content
         * $link
         * $photo
         */
        extract($val);

    }

    public function paginate($limit = 10)
    {
        return $this->model->query()->paginate($limit);
    }


}