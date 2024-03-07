<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Repositoryinterface\UsersRepositoryinterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DBUsersRepository implements UsersRepositoryinterface
{

    protected Model $model;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
    public function login($request)
    {

        $credentials = [
            'phone' => $request->phone,
            'password' =>  $request->password,
        ];
        if ($token = Auth::guard('student')->attempt($credentials)) {
            $user = auth('student')->user();
        } else {
            return Resp('', 'Invalid Credentials', 404, false);
        }

        if ($token == null) {
            return Resp('', 'User Not found', 404, false);
        }
        // $user =  auth('student')->user();
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
            // 'password'     => Hash::make($request->password),
            'password'     => $request->password,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'gender'       => $request->gender,
            'country_id'   => $request->country_id,
        ]);
        if ($user != null) {

            return $this->login($request);
        }
        return Resp('', 'error', 402, true);
    }
    public function profile_update($request)
    {

        $id = Auth::guard('student')->user()->id;
        $user =  User::find($id);

        if ($this->request->has('first_name')) {
            $user->first_name = $request->first_name;
        }
        if ($this->request->has('middle_name')) {
            $user->middle_name = $request->middle_name;
        }
        if ($this->request->has('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($this->request->has('country_id')) {
            $user->country_id = $request->country_id;
        }
        if ($this->request->has('password')) {
            $user->password = $request->password;
        }
        if ($this->request->has('phone_parent')) {
            $user->phone_parent = $request->phone_parent;
        }
        if ($this->request->has('email_parent')) {
            $user->email_parent = $request->email_parent;
        }
        
        $user->save();
        if ($user != null) {

            $data =  new LoginUserResource($user);
            return Resp($data, 'Success', 200, true);
        }
        return Resp('', 'error', 402, true);
    }
}
