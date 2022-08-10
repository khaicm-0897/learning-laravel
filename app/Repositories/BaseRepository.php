<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * Get all
     * @return collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return collection
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Delete
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
