<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * ? Status Code :
     * * 200 => Success Returned
     * * 201 => Success Created
     * * 404 => Not Found
     * * 403 => Permissions Error
     * * 422 => Validation Error
     */

    //put your code here
    private $statusCode;
    private $status;
    private $message;
    private $data;
    private $paging;

    private $header_status_code;

    public function setResponse($message = "", $statusCode = 200, $status = true, $data = null, $paging = null)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
        $this->paging = $paging;

        return $this->getResponse();
    }

    public function successResponse($message = "", $statusCode = 200, $status = true, $data = null, $paging = null)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->status = $status;
        $this->data = $data;
        $this->paging = $paging;

        if ($paging) {
            return $this->getResponseWithPaginate();
        }

        return $this->getResponse();
    }

    public function failedResponse($message = "", $statusCode = 422, $status = false, $data = null, $header_status_code = null)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->status = $status;
        $this->data = $data;
        $this->header_status_code = $header_status_code;

        return $this->getResponse();
    }

    public function getResponse()
    {
        $arr = [
            "statusCode" => $this->statusCode,
            "status" => $this->status,
            "message" => $this->message,
            "data" => $this->data,
        ];
        return response()->json($arr, $this->header_status_code ? $this->header_status_code : $this->statusCode);
    }

    public function getResponseWithPaginate()
    {
        $arr = [
            "statusCode" => $this->statusCode,
            "status" => $this->status,
            "message" => $this->message,
            "data" => $this->data,
            "pagination" => [
                'total' => $this->paging->total(),
                'per_page' => $this->paging->perPage(),
                'current_page' => $this->paging->currentPage(),
                'last_page' => $this->paging->lastPage(),
                'from' => $this->paging->firstItem(),
                'to' => $this->paging->lastItem(),
                'next_page_url' => $this->paging->nextPageUrl(),
                'prev_page_url' => $this->paging->previousPageUrl(),
            ]
        ];
        return response()->json($arr, $this->statusCode);
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
