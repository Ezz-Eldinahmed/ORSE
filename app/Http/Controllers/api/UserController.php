<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): array
    {
        return $this->userRepository->store($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->userRepository->login($request);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
            return response('Logged Out Succssefully', 200);
        }
    }

    public function profile(User $user): UserResource
    {
        return new UserResource($user);
    }
}
