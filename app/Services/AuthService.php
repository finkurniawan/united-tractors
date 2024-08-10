<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(private AuthRepository $authRepository){}

    public function login(array $data){
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if(! $token = auth('api')->attempt($credentials)){
            throw new RuntimeException("Invalid credentials");
        }

        $user = auth('api')->user();

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function register(array $data){
        try {
            DB::beginTransaction();

            $user = $this->authRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);

            if(!$token = auth('api')->attempt($data)){
               throw new RuntimeException("Invalid credentials");
            }

            DB::commit();

            return [
                'token' => $token,
                'user' => $user
            ];
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
}
