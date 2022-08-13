<?php

namespace App\Repositories\User;

use App\Exceptions\UserException;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository construct
     * 
     * DB $db
     * @return void
     */
    public function __construct(DB $db)
    {
        $this->model = $db::table('users');
    }

    /**
     * Get all
     * 
     * @return collection
     */
    public function getAll()
    {
        return $this->model
            ->select('name', 'email', 'avatar')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get one
     * 
     * int $id
     * @return stdClass object
     */
    public function find($id)
    {
        $result = $this->model
            ->select('name', 'email', 'avatar')
            ->find($id);

        return $result;
    }
}
