<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post): jsonResponse
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'comment' => $request['comment']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created',
            'data' => $comment
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to perform this action',
            ], Response::HTTP_FORBIDDEN);
        }

        $comment->update([
            'comment' => $request['comment']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment updated',
            'data' => $comment
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to perform this action',
            ], Response::HTTP_FORBIDDEN);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted',
        ], Response::HTTP_OK);
    }
}
