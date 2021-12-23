<?php

namespace Controller;

use \Model\PratosModel;
use \Model\Itens_encomendaModel;

class Itens_encomendaController
{

    //--------------------------------------------------------------------------------
    public function Form()
    {

        $model = new PratosModel();
        $lista_pratos = $model->Get_lista('');

        include_once("view/ItensEcomendaFormView.php");
    } // Index()

    //--------------------------------------------------------------------------------
    public function Listar($num_encomenda)
    {

        $model = new Itens_encomendaModel();
        $lista_itens_encomenda = $model->Get_lista($num_encomenda);

        include_once("view/ItensEcomendaListarView.php");
    } // Listar()

    //--------------------------------------------------------------------------------
    public function Incluir($dados)
    {

        $model = new Itens_encomendaModel();

        $erro = $model->Incluir($dados);

        echo $erro;
    } // Incluir()

    //--------------------------------------------------------------------------------
    public function Excluir($cod_prato, $num_encomenda)
    {
        $model = new Itens_encomendaModel();

        $erro = $model->Excluir($cod_prato, $num_encomenda);

        echo $erro;
    } // Incluir()

} // ModaltesteController