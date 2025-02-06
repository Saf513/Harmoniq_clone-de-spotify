<?php

namespace App\Controllers;

class TestController
{
    public function index()
    {
        global $twig;
        echo $twig->render('test.twig', ['message' => 'Hello, Twig!']);
    }
}