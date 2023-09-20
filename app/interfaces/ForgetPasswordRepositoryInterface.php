<?php
namespace App\interfaces;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserForgetPassword;


interface ForgetPasswordRepositoryInterface
{
    public function forgotPassword(UserForgetPassword $request);

}



