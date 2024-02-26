<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->role->name == 'admin' || $user->id == $product->user_id;
    }
}
