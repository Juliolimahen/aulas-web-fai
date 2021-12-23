<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\PratosModel;
use \Model\CategoriasModel;

class PratosController
{
    //--------------------------------------------------------------------------
    public function Listar($mensagem)
    {
        $model = new PratosModel();
        $lista_prato = $model->Get_lista(@$_POST['pesquisa']);


        //die($mensagem);

       	$arquivo = "view/PratosListarView.php";	
        
        include_once("view/IndexView.php");
    }

    //--------------------------------------------------------------------------
    public function Excluir($cod_prato)
    {
        $model = new PratosModel();

        $resultado = $model->Excluir($cod_prato);

        $this->Listar($resultado);

    }

    //--------------------------------------------------------------------------
    public function Formulario($cod_prato)
    {

        if( $cod_prato != '')       
        {
            $model = new PratosModel();
            $dados = $model->Get_prato($cod_prato);

            $descricao         = $dados['descricao'];
            $valor_unitario    = floatBR($dados['valor_unitario']);    
            $cod_categoria     = $dados['cod_categoria'];    

            $acao='alterar';
        }
        else
        {
            $descricao       = "";
            $valor_unitario  = "";
            $cod_categoria   = "";

            $acao='incluir';
        }

        $model_categorias = new CategoriasModel();

        $lista_de_categorias = $model_categorias->Get_lista('');

        $arquivo = "view/PratosFormularioView.php";
        include_once("view/IndexView.php");
        
    } // Formulario

    //--------------------------------------------------------------------------
    public function Incluir()
    {
        $model = new PratosModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Incluir

    //--------------------------------------------------------------------------
    public function Alterar()
    {
        $model = new PratosModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Alterar

    //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {

        $model = new PratosModel();
        $dados = $model->VerDuplicidade($dados);

        if( $dados['total'] > 0 )
        {
            echo 'Este Prato já está cadastrado !!!';
        }


    } // VerDuplicategoria($dados)

}