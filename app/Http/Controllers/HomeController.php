<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;

    class HomeController{
        public function home(){
            return view("home");
        }
    }

?>