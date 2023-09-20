<?php
namespace App\Repositories;
use App\Models\Post;
use App\Models\User;
use App\Jobs\SendWelcomeEmailJob;
use App\Traits\ValidatesImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

         dispatch(new SendWelcomeEmailJob([
            'email' => $user->email,
            'name' => $user->name,

        ]));

         return [
            'user' => $user,
            'token' => $token,
        ];


    }


    public function login(LoginUserRequest $request){

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            return[
                'user'=>Auth::user()
            ];
        }else{
            return[
                'error' => 'Email or password is incorrect.',
            ];

        }
    }


    public function update(UpdateUserRequest $request,$id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;



        if ($request->hasFile('image')) {

            $image = $this->validateImage($request->file('image'));
            $user->image = $image;

        }


        $user->save();

        return [
            'user' => $user,
            'message' => 'Post updated successfully'
        ];






    }

}

