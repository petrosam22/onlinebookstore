<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository){
            $this->UserRepository = $UserRepository;
    }


    public function storeUser(CreateUserRequest $request){
        $response =     $this->UserRepository->register($request);
        return response()->json([
            'user' => $response['user'],
            'token' => $response['token'],
            'message' => "User created successfully.",
        ], 200);
    }

    public function login(LoginUserRequest $request){
        $response = $this->UserRepository->login($request);

        if(isset($response['error'])){
            return response()->json([
                'error'=>$response['error']
            ],401);
        }
        return response()->json([
          'user'=> $response['user'],
          'token'=> $response['token'],
          'massage'=>'login Successfully',

        ]);
    }

    public function update(UpdateUserRequest $request,$id){


     $response=   $this->UserRepository->update( $request, $id);

        return response()->json([
            'user'=>$response['user'],
            'message'=>'User Updated Successfully'
        ]);

    }

}
