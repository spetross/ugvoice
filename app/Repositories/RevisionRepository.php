<?php namespace App\Repositories;


use App\Revision;

/**
 * Class RevisionRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Repositories
 */
class RevisionRepository
{

    public function __construct(Revision $revision)
    {
        $this->model = $revision;
    }


    public function create(array $input)
    {
        $model = $this->model;

        return $model::create($input);
    }

}