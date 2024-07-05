<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Services\PostsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostsService $postsService){}

    public function create(CreatePostRequest $request): JsonResponse
    {
        $post = $this->postsService->create($request->all());
        return response()->json([
            'post' => $post,
            'message' => 'Post created successfully'
        ], 201);
    }

    public function publish(Request $request): JsonResponse
    {
        $published = $this->postsService->publish($this->postsService->getPostById($request->post_id));

        return response()->json([
            'post' => $published,
            'message' => 'Post published successfully'
        ]);
    }


    public function index(): JsonResponse
    {
        return response()->json($this->postsService->getPosts()->paginate());
    }
}
