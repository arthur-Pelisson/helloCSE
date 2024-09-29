<?php 

namespace App\Http\Response;

use Illuminate\Support\Js;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Casts\Json;

class ResponseApi
{

    /**
     * @param string $dataName
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public static function success(mixed $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public static function error($message, $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}