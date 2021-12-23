<?php

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class Itens_encomendaModel
{
    private $pdo;

    //-----------------------------------------------------
    function __construct()
    {
        $meu_BD = new BD();
        $this->pdo = $meu_BD->pdo;
    }


    //-----------------------------------------------------
    public function Get_lista($num_encomenda)
    {

        $sql = " 	select 	e.num_encomenda,
                            p.cod_prato
							, p.descricao as pratos
							, c.nome as cliente
							, i.quantidade
							, p.valor_unitario
							, i.quantidade * p.valor_unitario as valor_compra
							, p.valor_unitario as valor_prato								
								
					from 	itens_encomenda as i
							inner join encomendas as e on (i.num_encomenda = e.num_encomenda)		
							inner join pratos p on (p.cod_prato = i.cod_prato)	
							INNER join clientes as c on (e.cod_cliente = c.cod_cliente)
							
					where	e.num_encomenda = '$num_encomenda'
							
					order by pratos		
 				";

        return $this->pdo->query($sql);
    } // alterar

    //-----------------------------------------------------	
    public function Incluir($dados)
    {

        $num_encomenda = $dados['num_encomenda'];
        $cod_prato = $dados['cod_prato'];

        $sql = " select count(*) as total from itens_encomenda where num_encomenda ='$num_encomenda' and cod_prato='$cod_prato'";
        $r = $this->pdo->query($sql);
        $d = $r->fetch(PDO::FETCH_ASSOC);

        if ($d['total'] == 0) {

            $sql = "insert into itens_encomenda(num_encomenda, cod_prato, quantidade,valor_unitario) values ( :num_encomenda, :cod_prato, :quantidade,(SELECT valor_unitario from pratos where cod_prato = :cod_prato))";

            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(':num_encomenda', $dados['num_encomenda']);
            $cmd->bindValue(':cod_prato', $dados['cod_prato']);
            $cmd->bindValue(':quantidade', floatUSA($dados['quantidade']));
            $cmd->execute();

            return '';
        } else {
            return 'Este prato já está cadastrado nessa encomenda!';
        }
    } // incluir

    //-----------------------------------------------------
    public function Excluir($cod_prato,$num_encomenda)
    {

        $sql = " delete from itens_encomenda where cod_prato = :cod_prato and num_encomenda = :num_encomenda ";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':cod_prato',$cod_prato);
        $cmd->bindValue(':num_encomenda',$num_encomenda);

        if ($cmd->execute()) {
            return '';
        } else {
            return 'Houve algum erro com a transação do banco de dados !';
        }
    } // excluir
}
