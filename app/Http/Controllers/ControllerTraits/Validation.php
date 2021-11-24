<?php

namespace App\Http\Controllers\ControllerTraits;

use App\Support\Facades\Validator;
use Psr\Http\Message\ServerRequestInterface;

/** @property ServerRequestInterface $request */
trait Validation
{
    protected \Rakit\Validation\Validation $validation;

    protected function validate(array $rules = []): void
    {
        $inputs = $this->request->getParsedBody();
        $validation = Validator::make($inputs, $rules);
        $validation->setAlias('identifier', 'Username or Email Address');
        $validation->validate($inputs);
        $this->validation = $validation;
    }
}
