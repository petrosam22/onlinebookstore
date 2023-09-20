<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgetPassword;
use App\interfaces\ResetPasswordRepositoriesInterface;

class ResetPasswordController extends Controller
{
    private ResetPasswordRepositoriesInterface $ResetPassword;

     public function __construct(ResetPasswordRepositoriesInterface $ResetPassword) {
        $this->ResetPassword = $ResetPassword;
    }



    public function ResetPassword(User $user, UserForgetPassword $request){
       $response= $this->ResetPassword->reset($user,$request);

        if(isset($response['error'])){
        return response()->json(
            [
                'status'=>401,
                'message'=>$response['error']
            ]);


        }

        return response()->json([
            'user'=> $response['user'],
            'message'=>'Password Reset Successfully'
        ]);
    }

}
