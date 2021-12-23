<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\CidadesModel;

class CidadesController
{
    public function Listar()
    {
        $model = new CidadesModel();
        $lista_cidade = $model->Get_lista(@$_POST['pesquisa']);

        $arquivo = "view/CidadesListarView.php";
        include_once("view/IndexView.php");
    }

    public function Excluir($cod_cidade)
    {
        $model = new CidadesModel();
        $model->Excluir($cod_cidade);

        $this->Listar();

        /*
        $lista_cidade = $model->Get_lista(@$_POST['pesq']);        
        $arquivo = "view/CidadesListarView.php";
        include_once("view/IndexView.php");
        */
    }

    public function Formulario($cod_cidade)
    {

        if( $cod_cidade != '')       
        {
            $model = new CidadesModel();
            $dados = $model->Get_cidade($cod_cidade);
            $nome = $dados['nome'];
            $uf = $dados['uf'];
            $acao='alterar';
        }
        else
        {
            $nome = '';
            $uf = '';
            $acao='incluir';
        }

        $arquivo = "view/CidadesFormularioView.php";
        include_once("view/IndexView.php");
        
    } // Formulario

    public function Incluir()
    {
        $model = new CidadesModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar();

        /*
        $lista_cidade = $model->Get_lista('');
        
        $arquivo = "view/CidadesListarView.php";
        include_once("view/IndexView.php");
        */

    } // Incluir

    public function Alterar()
    {
        $model = new CidadesModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar();

        /*
        $lista_cidade = $model->Get_lista('');
        
        $arquivo = "view/CidadesListarView.php";
        include_once("view/IndexView.php");
        */

    } // Incluir


}