<?php

namespace Controller;

class HomeController
{

    public function Index()
    {

        $arquivo = "view/HomeView.php";
        include_once("view/IndexView.php");

    } // Index()

}