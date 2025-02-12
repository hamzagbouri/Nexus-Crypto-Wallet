<?php

namespace App\core;
use App\Model\Session;
class Controller {


    public function view($view, $data = []) {

        if(file_exists('../app/view/' . $view . '.php')) {
            Session::ActiverSession();
            $logged = false;
            // Load  lview file
            require_once '../app/view/' . $view . '.php';
        } else {
            die("View " . $view . " does not exist");
        }
    }
}
