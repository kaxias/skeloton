<?php

namespace App\Support\Twig\Extension;

use App\Support\Facades\Flash;

class FlashRuntime
{
    public function flash_get(string $flash)
    {
        return Flash::get($flash);
    }

    public function flash_has(string $flash)
    {
        return Flash::has($flash);
    }

    public function flash_all()
    {
        return Flash::all();
    }
}
