<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Resources\Post as PostResource;
use  App\Models\Post;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateTileRequest;
use App\Http\Requests\UpdateContentRequest;


use App\Services\PostService;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::get())->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function show(Post $post)
    {
        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StorePostRequest $request, PostService $postService)
    {
        $post = $postService->store($request->validated());
        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // public function update(Post $post, StorePostRequest $request)
    // {
    //     $post->update($request->validated());

    //     return $this->postCollection($post, Response::HTTP_OK);
    // }


    public function updateTile(Post $post, UpdateTileRequest $request)
    {
        $post->update($request->validated());

        return $this->postCollection($post, Response::HTTP_OK);
    }

    public function updateContent(Post $post, UpdateContentRequest $request)
    {
        $post->update($request->validated());

        return $this->postCollection($post, Response::HTTP_OK);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }


    private function postCollection($post, $status)
    {
        return (new PostResource($post))
            ->response()
            ->setStatusCode($status);
    }
}
