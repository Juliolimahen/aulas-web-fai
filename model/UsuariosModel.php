<?php

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class UsuariosModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	//-----------------------------------------------------
	function Get_Usuario($login, $senha) {

		$sql = "select * from usuarios where login = :login and senha = :senha ";	

		$r = $this->pdo->prepare($sql);		
		$r->bindValue(':login', $login, PDO::PARAM_STR);
		$r->bindValue(':senha', $senha, PDO::PARAM_STR);
		$r->execute();

		return  $r->fetch(PDO::FETCH_ASSOC);

	} // Get_Usuario


} // UsuariosModel


?>
