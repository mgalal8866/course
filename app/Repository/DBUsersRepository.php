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
    public function login($request)
    {

        $credentials = [
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];
        if ($token =Auth::guard('student')->attempt(  $credentials )) {
            $user =auth('student')->user();
        } else {
            return Resp(null, 'Invalid Credentials', 404, false);

        }

        if ($token == null) {
            return Resp(null, 'User Not found', 404, false);
        }
        $user =  auth('student')->user();
        $user->token = $token;
        $data =  new LoginUserResource($user);
        return Resp($data, 'Success', 200, true);
    }
    public function sendotp()
    {
        $code = rand(123456, 999999);
        return Resp($code, 'Success', 200, true);
    }
    public function  verificationcode($code)
    {
        return Resp($code, 'Success', 200, true);
    }
    public function signup($request)
    {
        $user =  User::create([
            'first_name'   => $request->first_name,
            'middle_name'  => $request->middle_name,
            'last_name'    => $request->last_name,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'email'        => $request->email,
            'gender'       => $request->gender,
            // 'phone_parent' => $request->phone_parent,
            // 'email_parent' => $request->email_parent,
            'country_id'   => $request->country_id,
        ]);
        return Resp('$data', 'Success', 200, true);
    }
}
