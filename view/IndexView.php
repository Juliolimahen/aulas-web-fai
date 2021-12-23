<?php
	$titulo = 'SISTEMA DE GESTÃO COMERCIAL';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão Comercial : Restaurantes</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="view/_bootstrap/css/bootstrap.min.css">

	<!-- incluindo a biblioteca jQuery -->
	<script type="text/javascript" src="view/_js/jquery-3.4.1.min.js"></script>

	<!-- incluindo a biblioteca de funções gerais -->
	<script type="text/javascript" src="view/_js/funcoes.js"></script>	

	<script type="text/javascript" src="view/_bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<?php
		include_once("view/MenuView.php")			;
		include_once("view/CabecalhoView.php");
	?>

	<div class="container-fluid">

		<?php

			// se o usuário estiver logado -------
			if( isset($_SESSION['usuario']) )
			{
				
				if( file_exists($arquivo) )
				{
					include_once( $arquivo );	
				}

			} // se o usuário estiver logado
			else
			{
				//echo 'Usuário não logado no sistema!!!';
				include_once("view/LoginView.php");
			}

		?>

	</div> <!-- container -->


	<?php
		include_once("view/RodapeView.php");
	?>


</body>
</html>