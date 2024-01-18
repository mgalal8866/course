<?php
namespace App\Repositoryinterface;

interface UsersRepositoryinterface{


    public function login($request);
    public function signup($request);
    public function sendotp();
    public function verificationcode($code);

}

