<?php

namespace App\Repositories;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserRepository
{
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return [
            'user' => new UserResource($user),
            'access_token' => $user->createToken('authToken')->accessToken
        ];
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'Invalid Credentials',
            ], 422);
        }

        return [
            'user' => new UserResource(auth()->user()),
            'access_token' => auth()->user()->createToken('authToken')->accessToken
        ];
    }
}
