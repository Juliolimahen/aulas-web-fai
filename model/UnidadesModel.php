<?php 

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class UnidadesModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	
	//-----------------------------------------------------
	public function Get_unidade($cod_unidade)	{
		$sql = " select * 
				 from unidades 
				 where cod_unidade = '$cod_unidade' ";				  

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);

	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)	{
		$sql = " select * 
				 from unidades 
				 where descricao like '%$pesquisa%' or sigla like '%$pesquisa%'
				 order by descricao ";				  

		return $this->pdo->query($sql);

	} // alterar
	
	//-----------------------------------------------------	
	public function Incluir($dados)	{	

		$sql = "insert into unidades (descricao, sigla) values (:descricao, :sigla) ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':descricao',$dados['descricao']);
		$cmd->bindValue(':sigla',$dados['sigla']);
		$cmd->execute();

	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)	{			

		$sql = " update unidades set 
					descricao = :descricao,
					sigla   = :sigla
				 where cod_unidade = :cod_unidade
			   ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':descricao',$dados['descricao']);
		$cmd->bindValue(':sigla',$dados['sigla']);
		$cmd->bindValue(':cod_unidade',$dados['cod_unidade']);
		$cmd->execute();


	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_unidade)	{			

		$sql = " delete from unidades where cod_unidade = :cod_unidade ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_unidade',$cod_unidade);
		$cmd->execute();

	} // excluir
}