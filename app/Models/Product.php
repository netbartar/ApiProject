<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $fillable =  ['title', 'description', 'price', 'user_id', 'qnt'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
