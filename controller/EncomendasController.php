<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\EncomendasModel;
use \Model\ClientesModel;

class EncomendasController
{
    //--------------------------------------------------------------------------
    public function Listar($mensagem)
    {
        $model = new EncomendasModel();
        $lista_encomenda = $model->Get_lista(@$_POST['pesquisa']);


        //die($mensagem);

        $arquivo = "view/EncomendasListarView.php";

        include_once("view/IndexView.php");
    }

    //--------------------------------------------------------------------------
    public function Excluir($num_encomenda)
    {
        $model = new EncomendasModel();

        $resultado = $model->Excluir($num_encomenda);

        $this->Listar($resultado);
    }

    //--------------------------------------------------------------------------
    public function Formulario($num_encomenda)
    {

        if ($num_encomenda != '') {
            $model = new EncomendasModel();
            $dados = $model->Get_encomenda($num_encomenda);

            $data   = dataBR($dados['data']);
            $cod_cliente = $dados['cod_cliente'];
            $valor_total = floatBR($dados['valor_total']);
 
            $acao ='alterar';
        } else {
            $data       ="";
            $cod_cliente  ="";
            $valor_total  ="";
            $acao ='incluir';
        }

        $model_clientes = new ClientesModel();

        $lista_de_clientes = $model_clientes->Get_lista('');

        $arquivo = "view/EncomendasFormularioView.php";
        include_once("view/IndexView.php");
    } // Formulario

    //--------------------------------------------------------------------------
    public function Incluir()
    {
        $model = new EncomendasModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] ='';

        $this->Listar("");
    } // Incluir

    //--------------------------------------------------------------------------
    public function Alterar()
    {
        $model = new EncomendasModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");
    } // Alterar

    //--------------------------------------------------------------------------
    
    public function VerDuplicidade($dados)
    {

        $model = new EncomendasModel();
        $dados = $model->VerDuplicidade($dados);

        if ($dados['total'] > 0) {
            echo 'Este cliente já está cadastrado !!!';
        }
    } // VerDuplicategoria($dados)*/
}