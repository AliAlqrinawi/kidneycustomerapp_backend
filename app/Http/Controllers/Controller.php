<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseApi($status, $message, $items = null, $status_code = 200, $redirect_url = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($status && isset($items)) {
            $response['item'] = $items;
        } else {
            $response['errors_object'] = $items;
        }
        if ($redirect_url) {
            $response['redirect_url'] = $redirect_url;
        }
        return response()->json($response, $status_code);
    }
}
