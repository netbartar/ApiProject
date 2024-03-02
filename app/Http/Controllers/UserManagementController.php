<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{

    public function userStore(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response($user,201);
    }

    public function userList()
    {
        $users = User::select('id','name','email')->with('orders')->get();
//        $users = User::select('id','name')->orderBy('email','desc')->get();
//        $users = User::take(100)->get();
//            $users = User::skip(20)->limit(10)->get();
        return response($users,200);
    }

    public function userDetails($id)
    {

//        $user = User::find(1);
//        $user = User::where('email','admin@test.com')->first();
//        $user = User::firstWhere('email','admin@test.com');
//        $user = User::findOrFail($id);

//        $user = User::findOr($id,function (){
//            abort(404,'user not found');
//        });
//        $user = User::where('email','admin1@test.com')->firstOr(function (){
//            abort(404,'user not found');
//        });

//        $user = User::where('email','admin@test.com')->first();
//        if($user)
//            return response($user,200);

//        $user = User::findOrFail($id);
        $user = User::where('email','admin@test.com')->firstOrFail();
        return response($user,200);

    }

    public function userUpdate(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return response($user,200);
    }

    public function userDelete($id)
    {
        User::findOrfail($id)->delete();
        return response([],204);
    }


}
