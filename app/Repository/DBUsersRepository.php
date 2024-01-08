<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\UsersRepositoryinterface;
use Illuminate\Support\Facades\Hash;

class DBUsersRepository implements UsersRepositoryinterface
{

    protected Model $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function login($request){
        
        $token =  Auth::guard('api')->attempt(['phone' => $request->get('phone'), 'password' => $request->get('password')]);
        if ($token == null) {
            return Resp(null, 'User Not found', 404, false);
        }
        $user =  auth('api')->user();
        $user->token = $token;
        $data =  new LoginUserResource($user);
        return Resp($data, 'Success', 200, true);

    }
}
