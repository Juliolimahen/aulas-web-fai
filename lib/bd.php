<?php

namespace Lib;

use \PDO; // necess�rio para autoload da classe PDO

class BD
{
	public $pdo;

	function __construct()
	{
		try {
			$this->pdo = new PDO("mysql:host=localhost;dbname=restaurante2021", "root", "");
		} catch (PDOException $e) {
			die('N�o foi poss�vel realizar a conex�o com o Banco de Dados!!!');
		}
	} // construct

} // class Bd