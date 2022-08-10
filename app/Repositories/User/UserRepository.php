<?php

namespace App\Repositories\User;

use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository construct
     * @param User $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
