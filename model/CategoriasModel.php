<?php 

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class CategoriasModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	
	//-----------------------------------------------------
	public function Get_categoria($cod_categoria)	{
		$sql = " select * 
				 from categorias 
				 where cod_categoria = '$cod_categoria' ";				  

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);

	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)	{
		$sql = " select * 
				 from categorias 
				 where descricao like '%$pesquisa%' 
				 order by descricao ";				  

		return $this->pdo->query($sql);

	} // alterar
	
	//-----------------------------------------------------	
	public function Incluir($dados)	{	

		$sql = "insert into categorias (descricao) values (:descricao) ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':descricao',$dados['descricao']);
		$cmd->execute();

	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)	{			

		$sql = " update categorias set 
					descricao = :descricao
				 where cod_categoria = :cod_categoria
			   ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':descricao',$dados['descricao']);
		$cmd->bindValue(':cod_categoria',$dados['cod_categoria']);
		$cmd->execute();


	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_categoria)	{			

		$sql = " delete from categorias where cod_categoria = :cod_categoria ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_categoria',$cod_categoria);
		$cmd->execute();

	} // excluir
}