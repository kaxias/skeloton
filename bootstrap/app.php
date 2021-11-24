<?php

use App\Http\HttpKernel;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

return HttpKernel::start(dirname(__DIR__));
