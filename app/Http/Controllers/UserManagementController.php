<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Scopes\IsActiveScope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
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
//        $users_count = User::count();
//        $chunk_count = intval($users_count * 0.25);
//
//        $users = User::with('orders')->take(100)->get();

        $users = Cache::get('user-list3');
        if(!$users)
        {
            $users = User::all();
            Cache::put('user-list3',$users);
        }


//        $user_count = count($users);

//        $user_count = User::count();

//        $products = Product::all();
//        $max_qnt = $products->max('qnt');
//        $max_qnt = Product::min('qnt');
//        return $max_qnt;

//        foreach ($users as $user)
//        {
//            $user->name .= ' salam';
//            $user->save();
//        }

//        $users = User::select('id','email','name')
//            ->where('name' , 'Jafar jamalzadeh salam salam')->take(100)->get();

//        $users = User::select('id','email','name')->take(100);
//        $users = $users->where('name','Jafar jamalzadeh salam salam')->get();

//        $users = User::chunk(intval($users_count * 0.25),function ($users){
//            foreach ($users as $user)
//            {
//                $user->name .= ' salam';
//            }
//        });

//        foreach (Product::lazy() as $user)
//        {
//            $user->name .= ' salam';
//        }

//        Product::chunk(50,function ($products){
//           foreach ($products as $product)
//           {
//               $product->qnt += 2;
//           }
//        });


//        $users = [];
//        $users = User::paginate(200);


//        $users = User::select('id','name')->orderBy('email','desc')->get();
//        $users = User::take(100)->get();
//            $users = User::skip(20)->limit(10)->get();

//        $users = User::where('name','Jafar jamalzadeh')->get();
//        $users = User::take(20)->get();
//        $new_users = $users->where('name','Jafar jamalzadeh')->sum('role_id');

//        $users = [
//            [
//                'name' => 'vahid',
//                'lastname' => 'mohammadi',
//                'age' => 150
//            ],
//            [
//                'name' => 'X',
//                'lastname' => 'mohammadi',
//                'age' => 32
//            ],
//            [
//                'name' => 'Y',
//                'lastname' => 'mohammadi',
//                'age' => 56
//            ],
//        ];

//        $new_users = collect($users)->where('name','X');
//        return response($users,200);
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

        $user = User::checkId($id)->firstOr(function (){
            abort(404,'user not active');
        });
//        $user = User::where('email','admin@test.com')->firstOrFail();

//        $user = User::findOrFail($id);
//        $user->name = 'Jamal jamalzadeh';
//        $user->refresh();

//        $user = User::where('email','sara1@test.com')->first();
//        $user = User::whereEmail('sara1@test.com')->first();
//        $user = User::where('name',null)->get();
//        $user = User::whereNotNull('name')->take(10)->get();
//        $user = User::whereEmail('sara1@test.com')->exists();
//        if($user)
//            return 'hast';
//        return 'nist';
        return response($user,200);

    }

    public function userUpdate(UserUpdateRequest $request, $id)
    {
        $user = User::checkId($id)->firstOr(function (){
            abort(404,'user not active');
        });
        $user->update($request->only('name'));
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $test =  $user->getOriginal('password');
//        $user->password = $request->passowrd;
//        if ($user->isDirty('name'))
//            Log::info('updated user field');

//        if ($user->isClean(['name','email']))
//            Log::info('ok');loc
//        $user->save();

//        $user->save();
//        if ($user->wasChanged('name'))
//            Log::info('O+K');
//        if ($user->isDirty('name'))
//            Log::info('ok');
        return response($user,200);
    }


    public function isCustomClean($user_object,$request_obj)
    {
        $result = false;
        if ($user_object->name == $request_obj->name)
            $result = true;
        return $result;
    }

    public function multiUserUpdate(Request $request)
    {
        foreach ($request->all() as $value)
        {
            User::updateOrCreate(
                [
                    'email' => $value['email'],
                    'id' => $value['id']
                ],
                $value
            );
        }

        return 'done';
    }

    public function userDelete($id)
    {

//        Order::truncate();
//        User::findOrfail($id)->delete();
//        User::whereIn('id',[12,13,14])->delete();
        User::destroy([15,16,17]);
        return response([],204);
    }

    public function restoreTrashed($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return response($user,200);
    }

    public function forceDeleteUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return response([],204);
    }

}
