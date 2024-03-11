<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();
        return response([],204);
    }

    public function storeRole(Request $request)
    {
//        $role = Role::where('name',$request->name)->first();
//        if(!$role)
//            $role = Role::create(['name'=> $request->name]);
//        $role = Role::firstOrCreate([
//            'name' => $request->name
//        ]);

//        $role = Role::create(['name' => $request->name]);

//        $role = new Role();
//        $role->name = $request->name;
//        $role->save();

//        $role = Role::where('name',$request->name)->first();
//        if(!$role)
//        {
//            $role = new Role();
//            $role->name = $request->name;
//            //
//            //
//
//        }
        $role = Role::firstOrNew(
            ['name' => $request->name]
        );
        return response($role,201);
    }
}
