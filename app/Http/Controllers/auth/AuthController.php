<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Controller Function for Register
     **/
    public function register(StoreRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'username' => $request['username'],
            'phone_number' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])

        ]);

        $user->assignRole('user');
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    /**
     * Controller Function for Login
     **/
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->all();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->firstOrFail();
//        $token = $user->createToken('auth_token')->plainTextToken;
        $token = $user->createToken('auth_token', ["*"], now()->addHours())->plainTextToken;


        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], Response::HTTP_OK);
    }

    /**
     * Controller Function for Logout
     **/
    public function logout(): JsonResponse
    {
        DB::transaction(function (){

            Auth::user()->tokens()->delete();
            DB::table('personal_access_tokens')->where('expires_at', '<', now()->toDateTimeString())->delete();

        });

        return response()->json([
            'success' => true,
            'message' => 'Logout successful'
        ], Response::HTTP_OK);
    }

}
