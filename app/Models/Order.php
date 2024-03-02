<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'product_id', 'user_id', 'qnt', 'total_price', 'flag'
//    ];

    protected $guarded = [];

//
//    protected $casts = [
//        'qnt' => 'float'
//    ];

//    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function getCreatedAtAttribute()
    {
        return verta($this->attributes['created_at'])->formatJalaliDatetime();
    }

//    public function createdAt(): Attribute
//    {
//        return Attribute::make(
//          get: fn($created_at) => verta($created_at)->formatJalaliDatetime()
//        );
//
//    }


//    public static function boot()
//    {
//        parent::boot();
//
//        static::created(function ($order){
//            $order->product->qnt = $order->product->qnt - $order->qnt;
//            $order->product->save();
//        });
//    }

}
