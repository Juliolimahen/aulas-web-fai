<?php

namespace Controller;

use \PDO; // necessário para utilizar recursos da classe PDO
use \Model\ClientesModel;
use \Model\CidadesModel;

class ClientesController
{
    //--------------------------------------------------------------------------
    public function Listar($mensagem)
    {
        $model = new ClientesModel();
        $lista_cliente = $model->Get_lista(@$_POST['pesquisa']);


        //die($mensagem);

       	$arquivo = "view/ClientesListarView.php";	
        
        include_once("view/IndexView.php");
    }

    //--------------------------------------------------------------------------
    public function Excluir($cod_cliente)
    {
        $model = new ClientesModel();

        $resultado = $model->Excluir($cod_cliente);

        $this->Listar($resultado);

    }

    //--------------------------------------------------------------------------
    public function Formulario($cod_cliente)
    {

        if( $cod_cliente != '')       
        {
            $model = new ClientesModel();
            $dados = $model->Get_cliente($cod_cliente);

            $nome                  = $dados['nome'];
            $cpf                   = $dados['cpf'];    
            $rg                    = $dados['rg'];    
            $sexo                  = $dados['sexo'];    
            $data_nascimento       = dataBR($dados['data_nascimento']);    
            $renda_familiar        = floatBR($dados['renda_familiar']);    
            $telefone              = $dados['telefone'];    
            $celular               = $dados['celular'];    
            $email                 = $dados['email'];    
            $rua                   = $dados['rua'];    
            $bairro                = $dados['bairro'];    
            $cod_cidade            = $dados['cod_cidade'];    
            $cep                   = $dados['cep'];    
            $conheceu_por_jornais  = $dados['conheceu_por_jornais'];
            $conheceu_por_internet = $dados['conheceu_por_internet'];
            $conheceu_por_outro    = $dados['conheceu_por_outro'];      


            $acao='alterar';
        }
        else
        {
            $nome                  = "";
            $cpf                   = "";
            $rg                    = "";
            $sexo                  = "";
            $data_nascimento       = "";
            $renda_familiar        = "";
            $telefone              = "";
            $celular               = "";
            $email                 = "";
            $rua                   = "";
            $bairro                = "";
            $cod_cidade            = "";
            $cep                   = "";
            $conheceu_por_jornais  = "";
            $conheceu_por_internet = "";
            $conheceu_por_outro    = "";

            $acao='incluir';
        }

        $model_cidades = new CidadesModel();

        $lista_de_cidades = $model_cidades->Get_lista('');

        $arquivo = "view/ClientesFormularioView.php";
        include_once("view/IndexView.php");
        
    } // Formulario

    //--------------------------------------------------------------------------
    public function Incluir()
    {
        $model = new ClientesModel();
        $model->Incluir($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Incluir

    //--------------------------------------------------------------------------
    public function Alterar()
    {
        $model = new ClientesModel();
        $model->Alterar($_POST);

        $_POST['pesquisa'] = '';

        $this->Listar("");

    } // Alterar

    //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {

        $model = new ClientesModel();
        $dados = $model->VerDuplicidade($dados);

        if( $dados['total'] > 0 )
        {
            echo 'Este CPF já está cadastrado !!!';
        }


    } // VerDuplicidade($dados)

}