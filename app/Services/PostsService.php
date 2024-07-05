<?php

namespace App\Services;


use App\Models\Post;
use App\Events\PostPublished;

class PostsService
{
    public function __construct(private Post $post)
    {
        //
    }

    /**
     * Create a new post.
     */
    public function create(array $data): Post
    {
        return $this->post->create($data);
    }

    public function publish(Post $post): Post
    {
        $post->is_published = true;
        $post->save();

        event(new PostPublished($post));  

        return $post;
    }

    public function getPostById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function getPosts():Post
    {
        return $this->post;
    }
}