<?php
namespace Frs\LaravelMassCrudGenerator\Utils;
use Illuminate\Http\JsonResponse;

class Response
{
    public static function success($statusCode = 200, string $message = 'Request successful !', array $data = [],  array $metadata = []): JsonResponse
    {
        if(count($metadata) > 0) {
            return response()->json([
                'status' => $statusCode,
                'message' => $message,
                'data' => $data,
                'meta' => $metadata
            ], $statusCode);
        }else{
            return response()->json([
                'status' => $statusCode,
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        }
    }

    public static function created($statusCode=201, string $message = 'Request successful !', array $data = [],  array $metaData = []): JsonResponse
    {
        return self::success($statusCode, $message, $data, $metaData);
    }

    public static function noContent($message = 'No content'): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 204);
    }

    public static function badRequest($statusCode=400, $message = 'Bad request',$errors = []): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
            'errors' => $errors,
        ], 400);
    }

    public static function unauthorized($message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 401);
    }

    public static function forbidden($message = 'Forbidden'): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 403);
    }

    public static function notFound( $statusCode=404,$message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], 404);
    }

    public static function serverError($statusCode = 500, $message = 'An error occurred. Please try again later.'): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], 500);
    }
}
                                                    
                                                            
                     
                                            
            
            