<?php

namespace App\Http\Controllers\ControllerTraits;

use App\Support\Facades\Session;
use Psr\Http\Message\ServerRequestInterface;

/** @property ServerRequestInterface $request */
trait OldFields
{
    protected function setOldFormFields(): void
    {
        Session::set('old_fields', (array)$this->request->getParsedBody());
    }
}
