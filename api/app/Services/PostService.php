<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function store(array $postDetails): Post
    {
        $post = Post::create([
            'title' => $postDetails['title'],
            'content' => $postDetails['content']
        ]);

        return $post;
    }
}
