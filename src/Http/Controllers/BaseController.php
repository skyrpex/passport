<?php

namespace Laravel\Passport\Http\Controllers;

class BaseController
{
    public function getMiddleware()
    {
        return [];
    }
}
