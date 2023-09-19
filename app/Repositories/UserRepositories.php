<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ValidatesImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\interfaces\UserRepositoryInterface;

class UserRepositories implements UserRepositoryInterface {
    use ValidatesImageTrait;
    public function register(CreateUserRequest $request){
        $image = null;

        if ($request->hasFile('image')) {
            $image = $this->validateImage($request->file('image'));
        }



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>'user',
            'password' => Hash::make($request->password),
            'image'=>$image,
         ]);

         $token = $user->createToken('Api-Token')->plainTextToken;


         return response()->json([
            'user'=>$user,
            'token'=> $token,

         ],
        201);
    }

}

