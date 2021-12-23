<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\IngredientesModel;
use \Model\UnidadesModel;

class IngredientesController
{
    //--------------------------------------------------------------------------
    public function Listar($mensagem)
    {
        $model = new IngredientesModel();
        $lista_ingrediente = $model->Get_lista(@$_POST['pesquisa']);


        //die($mensagem);

       	$arquivo = "view/IngredientesListarView.php";	
        
        include_once("view/IndexView.php");
    }

    //--------------------------------------------------------------------------
    public function Excluir($cod_ingrediente)
    {
        $model = new IngredientesModel();

        $resultado = $model->Excluir($cod_ingrediente);

        $this->Listar($resultado);

    }

    //--------------------------------------------------------------------------
    public function Formulario($cod_ingrediente)
    {

        if( $cod_ingrediente != '')       
        {
            $model = new IngredientesModel();
            $dados = $model->Get_ingrediente($cod_ingrediente);

            $descricao         = $dados['descricao'];
            $valor_unitario    = floatBR($dados['valor_unitario']);    
            $cod_unidade     = $dados['cod_unidade'];    

            $acao='alterar';
        }
        else
        {
            $descricao       = "";
            $valor_unitario  = "";
            $cod_unidade   = "";

            $acao='incluir';
        }

        $model_unidades = new UnidadesModel();

        $lista_de_unidades = $model_unidades->Get_lista('');

        $arquivo = "view/IngredientesFormularioView.php";
        include_once("view/IndexView.php");
        
    } // Formulario

    //--------------------------------------------------------------------------
    public function Incluir()
    {
        $model = new IngredientesModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Incluir

    //--------------------------------------------------------------------------
    public function Alterar()
    {
        $model = new IngredientesModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Alterar

   //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {

        $model = new IngredientesModel();
        $dados = $model->VerDuplicidade($dados);

        if( $dados['total'] > 0 )
        {
            echo 'Este Ingrediente já está cadastrado !!!';
        }

    } // VerDupliunidade($dados)

}