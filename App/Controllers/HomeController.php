<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index(): void {
        if ($this->getMethod() === 'GET') {

            $this->render('Home');
        }
    }

}