<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller

{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(int $errorCode = 200, string $message, $result = [])
    {
    	$response = [
            'metadata' => [
                'success' => true,
                'errorCode' => $errorCode,
                'message' => $message,
            ],
            'data'    => $result,
        ];
        return response()->json($response, $errorCode);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError(int $errorCode = 404, $message, $errorMessages = [])
    {
    	$response = [
            'metadata' => [
                'success' => false,
                'errorCode' => $errorCode,
                'message' => $message,
            ],
            'data'    => [],
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $errorCode);
    }
}
