<?php

namespace App\Services;

use App\Enums\ResponseMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponseService
{
    public static function success_response($obj = null, $message = null)
    {
        $data = is_object($obj) || is_array($obj) ? $obj : [];

        return response()->json(
            [
                'code' => 200,
                'message' => $message ?? self::getCurrentMethodResponseMessage(),
                'data' => $data
            ],
            200
        );
    }

    public static function paginate_response(LengthAwarePaginator $data, String $resource_class, $message = null)
    {
        return response()->json([
            'code' => 200,
            'message' => $message ?? self::getCurrentMethodResponseMessage(),
            'data' => $resource_class ? $resource_class::collection($data) : $data->items(),
            'pagination' => [
                'page' => $data->currentPage(),
                'total' => $data->total(),
                'per_page' => $data->perPage() === 99999 ? 10 : $data->perPage(),
                'last_page' => $data->lastPage(),
            ],
        ]);
    }

    public static function error_response($err_msg, $err_code = 400, $http_code = 400, $data = [])
    {
        return response()->json(
            [
                'code' => $err_code,
                'error_message' => $err_msg,
                'data' => $data,
            ],
            $http_code
        );
    }

    public static function getCurrentMethodResponseMessage()
    {
        switch (request()->method()) {
            case 'POST':
                return ResponseMessage::getDescription(ResponseMessage::CREATE);
                break;
            case 'GET':
                return ResponseMessage::getDescription(ResponseMessage::READ);
                break;
            case 'PUT':
                return ResponseMessage::getDescription(ResponseMessage::UPDATE);
                break;
            case 'DELETE':
                return ResponseMessage::getDescription(ResponseMessage::DELETE);
                break;
            default:
                return '';
                break;
        }
    }
}