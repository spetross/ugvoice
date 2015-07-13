<?php namespace app\Repositories;


use app\Revision;

/**
 * Class RevisionRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Repositories
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