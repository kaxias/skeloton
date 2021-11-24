<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ControllerTraits\OldFields;
use App\Http\Controllers\ControllerTraits\Validation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SimpleSlim\App;

class Controller
{
    use OldFields, Validation;

    protected Response $response;
    protected Request $request;
    protected App $app;

    public function __construct(Response $response, Request $request, App $app)
    {
        $this->response = $response;
        $this->request = $request;
        $this->app = $app;

        $this->setOldFormFields();
    }
}
