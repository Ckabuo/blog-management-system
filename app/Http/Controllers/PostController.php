<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('user')->get();

        return response()->json([
            'success' => true,
            'posts' => $posts
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'success' => true,
            'post' => $post
        ], Response::HTTP_OK);

        $this->view();
    }

    public function comments(Post $post): JsonResponse
    {
        $comments = $post->load('comments');
//        $comments = $post->comments()->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ], Response::HTTP_OK);
    }

    public function commentById(Post $post, Comment $comment): JsonResponse
    {
        if ($comment->post_id !== $post->id){
            return response()->json([
                'success' => false,
                'message' => 'Comment not found for this post'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $comment
        ], Response::HTTP_OK);
    }

    public function like(Post $post)
    {
        $post->likes++;
        $post->save();
    }

    public function view(Post $post)
    {
        $post->views++;
        $post->save();
    }
}
