<?php

namespace App\Helpers;

class AppResponse
{
    public $ok;
    public $message;
    public $data;

    public function __construct($ok = true, $message = '', $data = null)
    {
        $this->ok = $ok;
        $this->message = $message;
        $this->data = $data;
    }

    public function toJson()
    {
        return json_encode($this);
    }
}