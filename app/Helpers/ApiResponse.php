<?php

namespace App\Helpers;


class ApiResponse
{
    private ?string $message = null;
    private mixed $data= null;
    private int $status = 200;


    public static function success(?string $message=null, mixed $data=null, int $status=200)
    {
        $res = new self();
        $res->setMessage($message ??  "Success");
        $res->setStatus($status);
        $res->setData($data);
        return $res;
    }


        public static function error(?string $message="Internal Server Error", mixed $data=null, int $status=500)
    {
        $res = new self();
        $res->setMessage($message);
        $res->setStatus($status);
        $res->setData($data);
        return $res;
    }


    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function response()
    {
        $body = [];
        !is_null($this->message) && $body['message'] = $this->message;
        !is_null($this->data) && $body['data'] = $this->data;
        return response()->json($body, $this->status);
    }
}