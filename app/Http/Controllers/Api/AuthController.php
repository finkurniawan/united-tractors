<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\CategoryProductRepository;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->safe()->only(['name','email', 'password']);
        try {
            $result = $this->authService->register($validated);

            return $this->respondWithToken($result['user'],$result['token'],201);
        } catch (\Exception $exception){
            return $this->msgResponse($exception->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->safe()->only(['email','password']);

        $result = $this->authService->login($validated);

        return $this->respondWithToken($result['user'],$result['token'],200);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return $this->msgResponse('Successfully logged out');
    }

    protected function respondWithToken($user,$token,$code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],$code);
    }
}
