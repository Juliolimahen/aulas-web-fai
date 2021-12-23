<?php

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class IngredientesModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()
	{
		$meu_BD = new BD();
		$this->pdo = $meu_BD->pdo;
	}


	//-----------------------------------------------------
	public function Get_ingrediente($cod_ingrediente)
	{
		$sql = " select * 
				 from ingredientes 
				 where cod_ingrediente = '$cod_ingrediente' ";

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);
	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)
	{
		$sql = " select p.*, c.descricao as unidade
				 from 	ingredientes p
				 		left outer join unidades c on (p.cod_unidade = c.cod_unidade)
				 where p.descricao like '%$pesquisa%' or c.descricao like '%$pesquisa%' 
				 order by p.descricao ";

		return $this->pdo->query($sql);
	} // alterar

	//-----------------------------------------------------	
	protected function ExecutarSQL($dados, $acao, $sql)
	{

		$cmd = $this->pdo->prepare($sql);

		$descricao        = $dados['descricao'];
		$valor_unitario   = trim($dados['valor_unitario']) == "" ? null : floatUSA($dados['valor_unitario']);
		$cod_unidade    = $dados['cod_unidade'] == '0' ? null : $dados['cod_unidade'];

		$cmd->bindValue(":descricao", $descricao);
		$cmd->bindValue(":valor_unitario", $valor_unitario);
		$cmd->bindValue(":cod_unidade", $cod_unidade);

		if ($acao == 'alterar') {
			$cmd->bindValue(':cod_ingrediente', $dados['cod_ingrediente']);
		}

		$cmd->execute();
	} // ExecutarSQL

	//-----------------------------------------------------	
	public function Incluir($dados)
	{

		$sql = " insert into ingredientes 	
					(descricao,valor_unitario,cod_unidade) 
				 values 
				 	(:descricao,:valor_unitario,:cod_unidade) 
				";

		$this->ExecutarSQL($dados, 'incluir', $sql);
	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)
	{

		$sql = " update ingredientes set
						descricao        = :descricao      , 
						valor_unitario   = :valor_unitario ,
						cod_unidade    = :cod_unidade             

				 where cod_ingrediente = :cod_ingrediente
			   ";

		$this->ExecutarSQL($dados, 'alterar', $sql);
	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_ingrediente)
	{

		$sql = " select count(*) as total from composicao where cod_ingrediente = '$cod_ingrediente' ";

		$r = $this->pdo->query($sql);
		$d = $r->fetch(PDO::FETCH_ASSOC);

		if ($d['total'] == 0) {
			$sql = " delete from ingredientes where cod_ingrediente = :cod_ingrediente ";

			$cmd = $this->pdo->prepare($sql);
			$cmd->bindValue(':cod_ingrediente', $cod_ingrediente);
			$cmd->execute();

			return '';
		} else {
			return 'Este ingrediente não pode ser excluído porque está relacionado a registros de composição de prato!';
		}
	} // excluir

	//--------------------------------------------------------------------------
	public function VerDuplicidade($dados)
	{
		$descricao         = trim(@$dados['descricao']);
		$cod_ingrediente = @$dados['cod_ingrediente'];

		$sql = " select count(*) as total 
                 from ingredientes 
                 where  descricao = '$descricao' and 
                        cod_ingrediente != '$cod_ingrediente' ";

		$r = $this->pdo->query($sql);

		return $r->fetch(PDO::FETCH_ASSOC);
	} // VerDuplicidade

} // class