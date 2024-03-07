<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Repositoryinterface\UsersRepositoryinterface;

class UsersController extends Controller
{
    private $users;
    public function __construct(UsersRepositoryinterface $Users)
    {
        $this->users = $Users;
    }

    public function login(LoginUserRequest $request)
    {
      return  $this->users->login($request);
    }
    public function signup(UserRequest $request)
    {
      return  $this->users->signup($request);
    }
    public function sendotp(Request $request)
    {
      return  $this->users->sendotp($request);
    }
    public function verificationcode($code)
    {
        return  $this->users->verificationcode($code);
    }
    public function profile_update(Request $request)
    {
      return  $this->users->profile_update($request);
    }


}
