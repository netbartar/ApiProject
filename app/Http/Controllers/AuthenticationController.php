<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateResetCodeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\ForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
//            $user = new User();
//            $user->name = $request->name;
//            $user->email = $request->email;
//            $user->password = $request->password;
//            $user->save();


        $token = $user->createToken('access token');
        return response(['message' => 'create success'] , 201);
    }

    public function loginWithQuery(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password))
        {
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            return response(['access_token'=>$token],200);
        }
        else
            return response(['message' =>  'email or password wrong!'],401);
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password'=>$request->password]))
        {
            $user = $request->user();
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            return response(['access_token'=>$token]);
        }

        return response(['message' =>  'email or password wrong!'],401);

    }

    public function loginCustom(LoginRequest $request)
    {
        $user= $this->checkLogin(['email' => $request->email, 'password'=>$request->password]);
        if($user)
        {
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            return  response(['access_token'=>$token],200);
        }
        return response(['message' =>  'email or password wrong!'],401);
    }

    public function checkLogin($params)
    {
        $user = User::where('email',$params['email'])->first();
        if($user && Hash::check($params['password'],$user->password))
            return $user;
        return false;
    }

    public function user()
    {
        $user = request()->user();
//        $user = Auth::user();
        return response(['data'=>$user],200);
    }

    public function logout()
    {
       request()->user()->tokens()->delete();
       return response(['message' => 'successfull logout!'],200);
    }

    public function generateResetCode(GenerateResetCodeRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
//            ForgotPassword::where('email',$request->email)->delete();
            $code = rand(11111,99999);
            ForgotPassword::create([
                'email' => $request->email,
                'code' => $code
            ]);
            return response(['data'=>$code],201);
        }

        return response(['message'=>'This user not found.'],404);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        $forgotPasswordCode = ForgotPassword::where('email',$request->email)->latest()->first();
        $message = 'invalid operation';
        $statusCode = 404;
        if($forgotPasswordCode) {
            if ($forgotPasswordCode->code != $request->code)
                $message = 'code vard shode eshtebah ast';

            else if ($forgotPasswordCode->flag)
                $message = 'shoma qablan az in code estefade kardin!';
            else if ($forgotPasswordCode->created_at > now()->addMinutes())
                $message = 'zaman estefade az code be etmam reside ast.';
            else {
                $user = User::where('email',$request->email)->first();
                $user->password = $request->new_password;
                $user->save();
                $forgotPasswordCode->flag = 1;
                $forgotPasswordCode->save();
                $message = 'success operation';
                $statusCode = 200;
            }
        }
        return response(['message'=> $message],$statusCode);

    }
}
