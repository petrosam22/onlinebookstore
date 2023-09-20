<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgetPassword;
use App\interfaces\ForgetPasswordRepositoryInterface;

class ForgotPasswordController extends Controller
{
    private ForgetPasswordRepositoryInterface $PasswordRepositories;

    public function __construct(ForgetPasswordRepositoryInterface $passwordRepositories) {
        $this->PasswordRepositories = $passwordRepositories;

    }



    public function ForgetPassword(UserForgetPassword $request){
      $this->PasswordRepositories->forgotPassword($request);

     return   response()->json(
        [
                'message' =>'Password reset email sent'
            ]
        );

    }

}
