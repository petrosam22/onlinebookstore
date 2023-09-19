<?php
namespace App\interfaces;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;


interface UserRepositoryInterface
{
public function register(CreateUserRequest $request);
}



