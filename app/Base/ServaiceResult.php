<?php 


namespace App\Base;


class ServaiceResult
{
    public function __construct(public bool $isOk, public mixed $data=null, public string $message="No Message")
    {

    }
}