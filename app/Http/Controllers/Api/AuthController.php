<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->safe()->only(['name','email', 'password']);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password']
            ]);

            if(!$token = auth('api')->attempt($validated)){
                return $this->msgResponse('Unauthorized', 401);
            }

            DB::commit();

        } catch (\Exception $exception){
            DB::rollBack();
            return $this->msgResponse($exception->getMessage(), 500);
        }
            return $this->respondWithToken($user,$token,201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->safe()->only(['email','password']);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password']
        ];

        if(! $token = auth('api')->attempt($credentials)){
            return $this->msgResponse('Unauthorized' . $token, 401);
        }

        $user = auth('api')->user();

        return $this->respondWithToken($user,$token,200);
    }

    public function logout()
    {
        auth()->logout();

        return $this->msgResponse('Successfully logged out');
    }

    protected function respondWithToken($user,$token,$code)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],$code);
    }
}
