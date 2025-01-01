<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSuccess($data, $message, $status = true, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    public function sendError($message, $status = false, $statusCode = 403)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }
}
