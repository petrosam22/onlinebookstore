<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendResetPasswordEmail;
use App\Http\Requests\UserForgetPassword;
use App\interfaces\ForgetPasswordRepositoryInterface;

class ForgetPasswordRepositories implements ForgetPasswordRepositoryInterface {

    public function forgotPassword(UserForgetPassword $request){


        $user = User::where('email', $request->email)->first();
      
        if(!$user){
            return response()->json([
                'error'=> 'email not found'
            ]);


        }
        $token = $user->createToken('Api-Token')->plainTextToken;

        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
        ]);



        dispatch(new SendResetPasswordEmail($user , $token));

        return response()->json([
            'message' => 'Password reset email sent'
        ]);



    }
}
