<?php

namespace App\Http\Controllers;

use App\Support\Facades\Twig;
use Psr\Http\Message\ResponseInterface as Response;

class WelcomeController extends Controller
{
    public function index(): Response
    {
        return Twig::render('welcome.twig');
    }
}
