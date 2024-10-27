<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userIndex() : JsonResponse
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function UserShow(User $user): JsonResponse
    {

        return response()->json([
            'status' => true,
            'user' => $user
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'content' => $request['content'],
            'image_url' => $request['image_url'],
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'post' => $post
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): jsonResponse
    {
        $validated = $request->validated();

        $post->update([
            'updated_at' => now()
        ] + $validated);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'post' => $post
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post has been deleted'
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     */
    public function CommentIndex(): JsonResponse
    {
        $comments = Comment::with('user','post')->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function CommentShow(Comment $comment): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $comment
        ], Response::HTTP_OK);
    }
}
