<?php

namespace App\Controller;

use App\core\Controller;

class HomeController extends Controller
{
    public function index(){
        echo "Home Page";
        $this->view('index');
    }
    public function login()
    {
        echo 'login';
        $this->view('pages/login');
    }
    public function register()
    {
        echo 'register';
        $this->view('pages/signup');
    }
    public function top10()
    {
        echo 'top10';
        $this->view('pages/top10');
    }
    public function watchList()
    {
        echo 'watchList';
        $this->view('pages/watchList');
    }

}