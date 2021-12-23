<?php

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class EncomendasModel
{
    private $pdo;

    //-----------------------------------------------------
    function __construct()
    {
        $meu_BD = new BD();
        $this->pdo = $meu_BD->pdo;
    }

    //-----------------------------------------------------
    public function Get_encomenda($num_encomenda)
    {
        $sql = " select * 
				 from encomendas
				 where num_encomenda = '$num_encomenda' ";

        $r = $this->pdo->query($sql);
        return $r->fetch(PDO::FETCH_ASSOC);
    } // alterar

    //-----------------------------------------------------
    public function Get_lista($pesquisa)
    {
        $sql = " select e.*, c.nome as cliente
				 from 	encomendas e
				 		left outer join clientes c on (e.cod_cliente = c.cod_cliente)
				 where c.nome like '%$pesquisa%' 
				 order by cliente ";

        return $this->pdo->query($sql);
    } // alterar

    //-----------------------------------------------------	
    protected function ExecutarSQL($dados, $acao, $sql)
    {

        $cmd = $this->pdo->prepare($sql);

        $data         = trim($dados['data']) == "" ? null : dataUSA($dados['data']);
        $cod_cliente   = $dados['cod_cliente'] == '0' ? null : $dados['cod_cliente'];
        $valor_total  = trim($dados['valor_total']) == "" ? null : floatUSA($dados['valor_total']);


        $cmd->bindValue(":data", $data);
        $cmd->bindValue(":cod_cliente", $cod_cliente);
        $cmd->bindValue(":valor_total", $valor_total);

        if ($acao == 'alterar') {
            $cmd->bindValue(':num_encomenda', $dados['num_encomenda']);
        }

        $cmd->execute();
    } // ExecutarSQL

    //-----------------------------------------------------	
    public function Incluir($dados)
    {
        $sql = "insert into encomendas 	
					(data,cod_cliente,valor_total) 
				 values 
				 	(:data,:cod_cliente,:valor_total) 
				";

        $this->ExecutarSQL($dados, 'incluir', $sql);
    } // incluir

    //-----------------------------------------------------
    public function Alterar($dados)
    {

        $sql = " update encomendas set
                        cod_cliente = :cod_cliente, 
                        data = :data,
						valor_total = :valor_total         

				 where num_encomenda = :num_encomenda
			   ";

        $this->ExecutarSQL($dados, 'alterar', $sql);
    } // alterar

    //-----------------------------------------------------
    public function Excluir($num_encomenda)
    {

        // verificando a integridade referencial -----	

        //--------------------------
        $sql = "select count(*) as total from itens_encomenda where num_encomenda = :num_encomenda";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':num_encomenda',$num_encomenda);
        $cmd->execute();

        $d = $cmd->fetch(PDO::FETCH_ASSOC);

        if ($d['total'] == 0) {
            
            $sql = "delete from encomendas where num_encomenda = :num_encomenda";

            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(':num_encomenda', $num_encomenda);
            $cmd->execute();

            return '';
        }

       else{

            return 'Não é possível excluir este prato porque possui itens relacionados!';
       }
    
    } // excluir

    //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {
        $data = @$dados['data'];
        $cod_cliente = @$dados['cod_cliente'];
        $sql = " select count(*) as total
                 from encomendas 
                 where  data = '$data' and cod_cliente != '$cod_cliente' ";

        $r = $this->pdo->query( $sql );

        return $r->fetch(PDO::FETCH_ASSOC);
    } // VerDuplicidade
} // class