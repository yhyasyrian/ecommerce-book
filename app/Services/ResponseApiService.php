<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseApiService
{
    public static function response(string $message, bool $status = true, int $codeHttp = 200): JsonResponse
    {
        return response()->json(['ok' => $status, 'message' => $message], $codeHttp);
    }
    public static function data(array $data, bool $status = true, int $codeHttp = 200): JsonResponse
    {
        return response()->json(['ok' => $status, ...$data], $codeHttp);
    }
    public static function responseOnly(mixed $data,int $codeHttp = 200): JsonResponse
    {
        return response()->json($data, $codeHttp);
    }
}
