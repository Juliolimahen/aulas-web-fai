<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\UnidadesModel;

class UnidadesController
{
    public function Listar()
    {
        $model = new UnidadesModel();
        $lista_unidade = $model->Get_lista(@$_POST['pesquisa']);

        $arquivo = "view/UnidadesListarView.php";
        include_once("view/IndexView.php");
    }

    public function Excluir($cod_unidade)
    {
        $model = new UnidadesModel();
        $model->Excluir($cod_unidade);

        $this->Listar();

        /*
        $lista_unidade = $model->Get_lista(@$_POST['pesq']);        
        $arquivo = "view/UnidadesListarView.php";
        include_once("view/IndexView.php");
        */
    }

    public function Formulario($cod_unidade)
    {

        if( $cod_unidade != '')       
        {
            $model = new UnidadesModel();
            $dados = $model->Get_unidade($cod_unidade);
            $descricao = $dados['descricao'];
            $sigla = $dados['sigla'];
            $acao='alterar';
        }
        else
        {
            $descricao = '';
            $sigla = '';
            $acao='incluir';
        }

        $arquivo = "view/UnidadesFormularioView.php";
        include_once("view/IndexView.php");
        
    } // Formulario

    public function Incluir()
    {
        $model = new UnidadesModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar();

        /*
        $lista_unidade = $model->Get_lista('');
        
        $arquivo = "view/UnidadesListarView.php";
        include_once("view/IndexView.php");
        */

    } // Incluir

    public function Alterar()
    {
        $model = new UnidadesModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar();

        /*
        $lista_unidade = $model->Get_lista('');
        
        $arquivo = "view/UnidadesListarView.php";
        include_once("view/IndexView.php");
        */

    } // Incluir


}