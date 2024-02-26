<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class RoleObserver
{
    public function deleting(Role $role) : void
    {
        $teacherRole = Role::where('name','teacher')->first();
        User::where('role_id',$role->id)->update([
            'role_id' => $teacherRole->id
        ]);
    }
}
