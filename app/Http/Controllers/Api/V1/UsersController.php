<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\TeamWorkResource;
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
    public function get_teamwork()
    {
        $teamwork =  $this->users->get_teamwork();

        if ($teamwork) {
            return Resp(TeamWorkResource::collection($teamwork), 'sucess',200);
        } else {
            return Resp('error', 401);
        }

    }
    public function signup(UserRequest $request)
    {
      return  $this->users->signup($request);
    }

    public function forgotpassword(LoginUserRequest $request)
    {
      return  $this->users->forgotpassword($request);
    }
    public function verificationcode(Request $request)
    {
        return  $this->users->verificationcode($request);
    }
    public function change_password(Request $request)
    {
      return  $this->users->change_password($request);
    }
    public function resend_code(Request $request)
    {
      return  $this->users->resend_code($request);
    }
    public function profile_details()
    {
      return  $this->users->profile_details();
    }


    public function sendotp(Request $request)
    {
      return  $this->users->sendotp($request);
    }

    public function profile_update(Request $request)
    {
      return  $this->users->profile_update($request);
    }


}
