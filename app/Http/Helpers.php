<?php

use App\Services\ApiResponseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

if (!function_exists('error_response')) {
    function error_response($message, $err_code = 400, $http_code = 400, $data = [])
    {
        return ApiResponseService::error_response($message, $err_code, $http_code, $data);
    }
}

if (!function_exists('success_response')) {
    function success_response($data = null, $message = null)
    {
        return ApiResponseService::success_response($data, $message);
    }
}

if (!function_exists('paginate_response')) {
    function paginate_response(LengthAwarePaginator $data, String $resource_class = null, $message = null)
    {
        return ApiResponseService::paginate_response($data, $resource_class, $message);
    }
}


if (!function_exists('current_user')) {
    function current_user()
    {
        return Auth::user();
    }
}