<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = auth()->user();

        $validated = $request->validated();

        $user->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ], Response::HTTP_OK);
    }

    public function destroy(): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->delete();
        Auth::user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Account deleted successfully',
        ], Response::HTTP_OK);
    }
}
