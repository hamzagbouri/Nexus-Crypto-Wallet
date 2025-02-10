<?php

namespace App\Controller;

use App\core\Controller;

class AboutController extends Controller
{
    public function index(){
       $this->view('About');
    }

}