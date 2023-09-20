<?php


namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserForgetPassword;
use App\interfaces\ResetPasswordRepositoriesInterface;


class ResetPasswordRepositories implements ResetPasswordRepositoriesInterface {

public function reset(User $user, UserForgetPassword $request)
{
    // $user =

$tokenData =     DB::table('password_resets')
    ->where('email',$request->email)
    ->where('token',$request->token);

    if(!$tokenData){
        return response()->json([
            'error'=>'email or token is incorrect'
        ]);


    }

    $newPassword = Hash::make($request->password);
    $user = User::where('email', $request->email)
    ->update(['password'=>$newPassword]);

    DB::table('password_resets')
    ->where('email',$request->email)
    ->where('token',$request->token)->delete();

    return [
        'user'=>$user,
    ];

}


}
