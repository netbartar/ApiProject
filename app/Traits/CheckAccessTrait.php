<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CheckAccessTrait
{

    public function isAccess($resource_user_id)
    {
        $user = Auth::user();
        $result = false;
        if($user->role->name == 'admin' || $resource_user_id == $user->id)
            $result = true;

        return $result;

    }

}
