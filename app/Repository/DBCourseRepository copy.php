<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\UsersRepositoryinterface;


class DBUsersRepository implements UsersRepositoryinterface
{

    protected Model $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
