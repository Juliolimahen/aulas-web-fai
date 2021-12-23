<?php

namespace Controller;

use \Model\IngredientesModel;
use \Model\ComposicaoModel;

class ComposicaoController
{

    //--------------------------------------------------------------------------------
    public function Form()
    {

        $model = new IngredientesModel();
        $lista_ingrediente = $model->Get_lista('');

        include_once("view/ComposicaoFormView.php");
    } // Index()

    //--------------------------------------------------------------------------------
    public function Listar($cod_prato)
    {

        $model = new ComposicaoModel();
        $lista_composicao = $model->Get_lista($cod_prato);

        include_once("view/ComposicaoListarView.php");
    } // Listar()

    //--------------------------------------------------------------------------------
    public function Incluir($dados)
    {

        $model = new ComposicaoModel();

        $erro = $model->Incluir($dados);

        echo $erro;
    } // Incluir()

    //--------------------------------------------------------------------------------
    public function Excluir($cod_prato, $cod_ingrediente)
    {
        $model = new ComposicaoModel();

        $erro = $model->Excluir($cod_prato, $cod_ingrediente);

        echo $erro;
    } // Incluir()

} // ModaltesteController