<?php namespace App\Repositories;

use App\Exceptions\GroupNotFoundException;
use App\Group;

class GroupRepository
{

    protected $model;

    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    /**
     * Find the group by ID.
     *
     * @param int $id
     * @return Group
     * @throws GroupNotFoundException
     */
    public function find($id, array $columns = ['*'])
    {
        $model = $this->model;

        if (!$group = $model->find($id)) {
            throw new GroupNotFoundException("A group could not be found with ID [$id].");
        }

        return $group;
    }

    /**
     * Find the group by name.
     *
     * @param string $name
     *
     * @throws GroupNotFoundException
     *
     * @return Group $group
     */
    public function findByName($name)
    {
        $model = $this->model;
        $group_name = strtolower($name);
        if (!$group = $model->query()->where('name', '=', $group_name)->first()) {
            throw new GroupNotFoundException("A group could not be found with the name [$name].");
        }

        return $group;
    }

    public function findAll()
    {
        return $this->model->all();
    }
}
