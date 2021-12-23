<?php

namespace Controller;

//use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\CidadesModel;


class ModaltesteController
{

    public function Index()
    {
    	
        $arquivo = "view/ModaltesteIndexView.php";
        include_once("view/IndexView.php");
        
    } // Index()

    public function ListarCidades()
    {
    	// chamar o modelo de cidades para obter as cidades
        $model = new CidadesModel();
        $lista_cidade = $model->Get_lista('');
        
        include_once("view/ModaltesteListarCidadesView.php");
        
    } // ListarCidades()


} // ModaltesteController