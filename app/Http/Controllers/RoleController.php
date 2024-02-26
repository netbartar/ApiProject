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
}
