<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): JsonResponse
    {
        $posts = Post::all();

        $response = [
            'success' => true,
            'data'    => PostResource::collection($posts),
            'message' => 'Posts retrieved successfully',
        ];
        return response()->json($response, 200);
    }
}
