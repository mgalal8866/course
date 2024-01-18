<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositoryinterface\UsersRepositoryinterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $users;
    public function __construct(UsersRepositoryinterface $Users)
    {
        $this->users = $Users;
    }

    public function login(Request $request)
    {
      return  $this->users->login($request);
    }
    public function signup(Request $request)
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

}
