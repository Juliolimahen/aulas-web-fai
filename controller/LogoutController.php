<?php

namespace Controller;

class LogoutController
{

    public function Logout()
    {
		unset($_SESSION['usuario']);
		
        include_once("view/IndexView.php");

    } // Autenticar()

} // LogoutController





