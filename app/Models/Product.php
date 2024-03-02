<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $fillable =  ['title', 'description', 'price', 'user_id', 'qnt'];

//    protected $hidden = [
//        'description',
//        'qnt'
//    ];

//    const CREATED_AT = 'creation_at';
//    const UPDATED_AT = 'edit_at';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
