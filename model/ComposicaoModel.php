<?php

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class ComposicaoModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()
	{
		$meu_BD = new BD();
		$this->pdo = $meu_BD->pdo;
	}


	//-----------------------------------------------------
	public function Get_lista($cod_prato)
	{

		$sql = " 	select 	c.cod_prato
							, c.cod_ingrediente
							, i.descricao as ingrediente
							, u.descricao as unidade
							, c.qde
							, i.valor_unitario
							, c.qde * i.valor_unitario as valor_custo
							, p.valor_unitario as valor_prato								
								
					from 	ingredientes as i
							inner join composicao as c on (i.cod_ingrediente = c.cod_ingrediente)		
							inner join pratos p on (p.cod_prato = c.cod_prato)	
							left outer join unidades as u on (i.cod_unidade = u.cod_unidade)
							
					where	p.cod_prato = '$cod_prato'
							
					order by ingrediente		
 				";

		return $this->pdo->query($sql);
	} // alterar

	//-----------------------------------------------------	
	public function Incluir($dados)
	{

		$cod_prato = $dados['cod_prato'];
		$cod_ingrediente = $dados['cod_ingrediente'];

		$sql = " select count(*) as total from composicao where cod_prato = '$cod_prato' and cod_ingrediente = '$cod_ingrediente' ";
		$r = $this->pdo->query($sql);
		$d = $r->fetch(PDO::FETCH_ASSOC);

		if ($d['total'] == 0) {

			$sql = "insert into composicao (cod_prato, cod_ingrediente, qde) values (:cod_prato, :cod_ingrediente, :qde) ";

			$cmd = $this->pdo->prepare($sql);
			$cmd->bindValue(':cod_prato', $dados['cod_prato']);
			$cmd->bindValue(':cod_ingrediente', $dados['cod_ingrediente']);
			$cmd->bindValue(':qde', floatUSA($dados['qde']));
			$cmd->execute();

			return '';
		} else {
			return 'Este ingrediente já está cadastrado na composição deste prato!';
		}
	} // incluir

	//-----------------------------------------------------
	public function Excluir($cod_prato, $cod_ingrediente)
	{

		$sql = " delete from composicao where cod_prato = :cod_prato and cod_ingrediente = :cod_ingrediente ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_ingrediente', $cod_ingrediente);
		$cmd->bindValue(':cod_prato', $cod_prato);

		if ($cmd->execute()) {
			return '';
		} else {
			return 'Houve algum erro com a transação do banco de dados !';
		}
	} // excluir
}