<?php

namespace App\Controller;

use App\core\Controller;

class HomeController extends Controller
{
    public function index(){
        echo "Home Page";
    }
    public function login()
    {
        echo 'login';
        echo "<br>";
    }

}