<?php

namespace App\core;

class Controller {


    public function view($view, $data = []) {

        if(file_exists('../app/view/' . $view . '.php')) {
            // Load  lview file
            require_once '../app/view/' . $view . '.php';
        } else {
            die("View " . $view . " does not exist");
        }
    }
}
