<?php 

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class CidadesModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	
	//-----------------------------------------------------
	public function Get_cidade($cod_cidade)	{
		$sql = " select * 
				 from cidades 
				 where cod_cidade = '$cod_cidade' ";				  

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);

	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)	{
		$sql = " select * 
				 from cidades 
				 where nome like '%$pesquisa%' or uf like '%$pesquisa%'
				 order by nome ";				  

		return $this->pdo->query($sql);

	} // alterar
	
	//-----------------------------------------------------	
	public function Incluir($dados)	{	

		$sql = "insert into cidades (nome, uf) values (:nome, :uf) ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':nome',$dados['nome']);
		$cmd->bindValue(':uf',$dados['uf']);
		$cmd->execute();

	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)	{			

		$sql = " update cidades set 
					nome = :nome,
					uf   = :uf
				 where cod_cidade = :cod_cidade
			   ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':nome',$dados['nome']);
		$cmd->bindValue(':uf',$dados['uf']);
		$cmd->bindValue(':cod_cidade',$dados['cod_cidade']);
		$cmd->execute();


	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_cidade)	{			

		$sql = " delete from cidades where cod_cidade = :cod_cidade ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_cidade',$cod_cidade);
		$cmd->execute();

	} // excluir
}