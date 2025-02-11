<?php

namespace App\Controller;

use App\core\Controller;

class HomeController extends Controller
{
    public function index(){
     
        $this->view('index');
    }
    public  function login()
    {
      
        $this->view('pages/login');
    }
    public function register()
    {
       
        $this->view('pages/signup');
    }
    public function top10()
    {
        
        $this->view('pages/top10');
    }
    public function watchList()
    {
      
        $this->view('pages/watchList');
    }

}