<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Traits\CheckAccessTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use CheckAccessTrait;

    public function postStore(PostStoreRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => $request->author_id
        ]);

        return response($post,201);
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);
        if($this->isAccess($post->author_id))
            return response($post,200);
        return response(['message'=>'access Denied'],403);
    }


}
