<?php

namespace Controller;

use \Model\UsuariosModel;

class AutenticarController
{

    public function Autenticar()
    {
    	$msg_login = '';	

		// se NÃO estiver autenticado
		if( !isset($_SESSION['usuario']) )
		{
			$model = new UsuariosModel();

			$usuario = $model->Get_Usuario($_POST['login'],  md5($_POST['senha']) );

			if( $usuario )
			{
				$_SESSION['usuario']['login']	      = $usuario['login'];
				$_SESSION['usuario']['cod_usuario']	  = $usuario['cod_usuario'];
				$_SESSION['usuario']['nome_completo'] = $usuario['nome_completo'];
			}
			else
			{
				$msg_login = 'Usuário e/ou Senha Inválidos !';
			}


		} // não autenticado

		echo $msg_login;

		/*
		$arquivo = 'view/HomeView.php';        
        include_once("view/IndexView.php");
        */

    } // Autenticar()

} // AutenticarController




