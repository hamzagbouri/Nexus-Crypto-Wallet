<?php

namespace App\Controller;

use App\core\Controller;

class HomeController extends Controller
{
    public function index(){
       $this->view('Home');
    }

}

