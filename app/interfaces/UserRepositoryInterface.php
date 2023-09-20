<?php
namespace App\interfaces;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;




interface UserRepositoryInterface
{
public function register(CreateUserRequest $request);
public function login(LoginUserRequest $request);
public function logout();
public function update(UpdateUserRequest $request , $id);



}



