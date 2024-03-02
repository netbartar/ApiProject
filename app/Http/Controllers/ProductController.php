<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Traits\CheckAccessTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    use CheckAccessTrait;
    public function storeProduct(StoreProductRequest $request)
    {
        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        return response($product,201);
    }

    public function listProduct()
    {
//        $query = Product::select('id','title','price','description','user_id','qnt')->with('user:id,name');
        $query = Product::with('user:id,name');
        if(Auth::user()->role->name != 'admin')
            $query = $query->where('user_id',Auth::id());

        $products = $query->get();

        return response(['status'=>200,'data'=>$products],200);
    }

    public function showProduct($id)
    {
        $product = Product::with('user:id,name')->findOrFail($id);
//        Gate::authorize('view',$product);
        $user = Auth::user();
        if($user->canNot('view',$product))
            abort(403,'can not');

        return response($product,200);


    }

    public function updateProduct(StoreProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
//        if(!Gate::none(['show-product','delete-product'],$product))
//        {
            $product->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description
            ]);
            return response($product,200);
//        }
//        abort(403,'This action is unauthorized.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('delete-product');
        $product->delete();
        return response([],204);

    }

}
