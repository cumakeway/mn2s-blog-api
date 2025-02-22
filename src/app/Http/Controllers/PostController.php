<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    
    /**
    * Display the list of posts.
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

    /* Display the specified post.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function show($id): JsonResponse
    {
        $post = Post::find($id);
        if (is_null($post)) {
            $response = [
                'success' => false,
                'message' => 'Post not found',
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data'    => new PostResource($post),
            'message' => 'Post retrieved successfully',
        ];
        return response()->json($response, 200);
    }
}
