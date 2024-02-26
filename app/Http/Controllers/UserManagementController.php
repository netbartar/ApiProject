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
//        $users = User::select('id','name','email')->get();
        $users = User::all('id','name','email');
        return response($users,200);
    }

    public function userDetails($id)
    {
        $user = User::findOrFail($id);
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
