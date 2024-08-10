<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function msgResponse(string $message = null, int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message], $status);
    }

    public function responseSuccess(array $data = [], int $code = 200): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response($data,$code);
    }

    public function responseError(\Exception $exception, int $code = 500): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response([
            'message' => $exception->getMessage(),
        ],$code);
    }
}
