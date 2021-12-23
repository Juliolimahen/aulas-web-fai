<?php
session_start();

// ROTEADOR -------------------------------------------------------

$modulo = isset($_GET["modulo"]) ? $_GET["modulo"] : "home";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "index";

include_once("lib/funcoes.php");

// AUTOLOAD  -------------------------------------------------------
include_once("autoload.php");

use \Controller\HomeController;
use \Controller\AutenticarController;
use \Controller\LogoutController;

use \Controller\CidadesController;
use \Controller\UnidadesController;
use \Controller\IngredientesController;
use \Controller\ClientesController;

use \Controller\ModaltesteController;
use \Controller\PratosController;
use \Controller\EncomendasController;
use \Controller\Itens_encomendaController;

use \Controller\ComposicaoController;


// ROTEADOR -------------------------------------------------------
if (strtolower($modulo) == 'home') {

	$ctrl = new HomeController();

	switch (strtolower($acao)) {
		case "index":
			$ctrl->Index();
			break;
	}
} // if modulo Home

//----------------------------------------------------------------
elseif (strtolower($modulo) == 'autenticar') {

	$ctrl = new AutenticarController();
	$ctrl->Autenticar();
}

//----------------------------------------------------------------
elseif (strtolower($modulo) == 'logout') {

	$ctrl = new LogoutController();
	$ctrl->Logout();
}

//----------------------------------------------------------------
elseif (strtolower($modulo) == 'cidades') {

	$ctrl = new CidadesController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar();
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['cod_cidade']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['cod_cidade']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;

		default:
			$ctrl->Listar();
			break;
	}
} // if modulo cidades
//----------------------------------------------------------------
elseif (strtolower($modulo) == 'unidades') {

	$ctrl = new UnidadesController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar();
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['cod_unidade']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['cod_unidade']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;

		default:
			$ctrl->Listar();
			break;
	}
} // if modulo unidades
//----------------------------------------------------------------
elseif (strtolower($modulo) == 'clientes') {

	$ctrl = new ClientesController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar("");
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['cod_cliente']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['cod_cliente']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;

		case "ver-duplic":
			$ctrl->VerDuplicidade($_POST);
			break;

		default:
			$ctrl->Listar("");
			break;
	}
} // if modulo clientes

//----------------------------------------------------------------
elseif (strtolower($modulo) == 'pratos') {

	$ctrl = new PratosController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar("");
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['cod_prato']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['cod_prato']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;

		case "ver-duplic":
			$ctrl->VerDuplicidade($_POST);
			break;

		default:
			$ctrl->Listar("");
			break;
	}
} // if modulo pratos
//----------------------------------------------------------------
elseif (strtolower($modulo) == 'modalteste') {

	$ctrl = new ModaltesteController();

	switch (strtolower($acao)) {

		case "index":
			$ctrl->Index();
			break;

		case "listarcidades":
			$ctrl->ListarCidades();
			break;

		default:
			$ctrl->Index();
			break;
	}
} // if modulo modalteste

//----------------------------------------------------------------
elseif (strtolower($modulo) == 'composicao') {

	$ctrl = new ComposicaoController();

	switch (strtolower($acao)) {

		case "form":
			$ctrl->Form();
			break;

		case "listar":
			$ctrl->Listar($_POST['cod_prato']);
			break;

		case "incluir":
			$ctrl->Incluir($_POST);
			break;

		case "excluir":
			$ctrl->Excluir($_POST['cod_prato'], $_POST['cod_ingrediente']);
			break;
	}
} // if modulo composicao

elseif (strtolower($modulo) == 'encomendas') {

	$ctrl = new EncomendasController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar("");
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['num_encomenda']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['num_encomenda']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;

		case "ver-duplic":
			$ctrl->VerDuplicidade($_POST);
			break;

		default:
			$ctrl->Listar("");
			break;
	}
} // if modulo pratos
//----------------------------------------------------------------
elseif (strtolower($modulo) == 'itens_encomenda') {

	$ctrl = new Itens_encomendaController();

	switch (strtolower($acao)) {

		case "form":
			$ctrl->Form();
			break;

		case "listar":
			$ctrl->Listar($_POST['num_encomenda']);
			break;

		case "incluir":
			$ctrl->Incluir($_POST);
			break;

		case "excluir":
			$ctrl->Excluir($_POST['cod_prato'], $_POST['num_encomenda']);
			break;
	}
} elseif (strtolower($modulo) == 'modalteste') {

	$ctrl = new ModaltesteController();

	switch (strtolower($acao)) {

		case "index":
			$ctrl->Index();
			break;

		case "listarcidades":
			$ctrl->ListarCidades();
			break;

		default:
			$ctrl->Index();
			break;
	}
} // if modulo modalteste


//----------------------------------------------------------------
elseif (
	strtolower($modulo) == 'ingredientes'
) {

	$ctrl = new IngredientesController();

	switch (strtolower($acao)) {
		case "listar":
			$ctrl->Listar("");
			break;

		case "excluir":
			$ctrl->Excluir(@$_GET['cod_ingrediente']);
			break;

		case "incluindo":
			$ctrl->Formulario('');
			break;

		case "incluir":
			$ctrl->Incluir();
			break;

		case "alterando":
			$ctrl->Formulario(@$_GET['cod_ingrediente']);
			break;

		case "alterar":
			$ctrl->Alterar();
			break;
		case "ver-duplic":
			$ctrl->VerDuplicidade($_POST);
			break;
		default:
			$ctrl->Listar("");
			break;
	}
} // if modulo cidades
//----------------------------------------------------------------
else {

	$ctrl = new HomeController();
	$ctrl->Index();
}
