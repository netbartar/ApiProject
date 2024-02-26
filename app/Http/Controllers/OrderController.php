<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function createOrder(CreateOrderRequest $request)
    {
        $product = Product::find($request->product_id);
        if($this->checkQnt($request->qnt,$product->qnt))
        {
            Order::create([
               'product_id' => $request->product_id,
               'qnt' => $request->qnt,
               'user_id' => Auth::id(),
               'total_price' => $product->price * $request->qnt
            ]);
            return response($product,201);
        }

        abort(403,'mojodi kafi nist');
    }

    public function checkQnt($request_qnt,$product_qnt)
    {
        $result = false;
        if($product_qnt >= $request_qnt)
            $result = true;

        return $result;

    }
}
