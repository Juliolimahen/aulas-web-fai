<?php 

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class PratosModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	
	//-----------------------------------------------------
	public function Get_prato($cod_prato)	{
		$sql = " select * 
				 from pratos 
				 where cod_prato = '$cod_prato' ";				  

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);

	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)	{
		$sql = " select p.*, c.descricao as categoria
				 from 	pratos p
				 		left outer join categorias c on (p.cod_categoria = c.cod_categoria)
				 where p.descricao like '%$pesquisa%' or c.descricao like '%$pesquisa%' 
				 order by p.descricao ";				  

		return $this->pdo->query($sql);

	} // alterar

	//-----------------------------------------------------	
	protected function ExecutarSQL($dados, $acao, $sql)	{	

		$cmd = $this->pdo->prepare($sql);

		$descricao        = $dados['descricao'];                    
		$valor_unitario   = trim($dados['valor_unitario']) == "" ? null : floatUSA($dados['valor_unitario']);         
		$cod_categoria    = $dados['cod_categoria'] == '0' ? null : $dados['cod_categoria'];

		$cmd->bindValue(":descricao"      , $descricao);                    
		$cmd->bindValue(":valor_unitario" , $valor_unitario);         
		$cmd->bindValue(":cod_categoria"  , $cod_categoria);             

		if( $acao == 'alterar' )
		{
			$cmd->bindValue(':cod_prato',$dados['cod_prato']);	
		}
		
		$cmd->execute();

	} // ExecutarSQL
	
	//-----------------------------------------------------	
	public function Incluir($dados)	{	

		$sql = " insert into pratos 	
					(descricao,valor_unitario,cod_categoria) 
				 values 
				 	(:descricao,:valor_unitario,:cod_categoria) 
				";

		$this->ExecutarSQL($dados, 'incluir', $sql);


	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)	{			

		$sql = " update pratos set
						descricao        = :descricao      , 
						valor_unitario   = :valor_unitario ,
						cod_categoria    = :cod_categoria             

				 where cod_prato = :cod_prato
			   ";

		$this->ExecutarSQL($dados, 'alterar', $sql);


	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_prato)	{			

		// verificando a integridade referencial -----	

		//--------------------------
		$sql = " select count(*) as total from composicao where cod_prato = :cod_prato ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_prato',$cod_prato);
		$cmd->execute();

		$d = $cmd->fetch(PDO::FETCH_ASSOC);

		if( $d['total'] > 0 )
		{
			return 'Não é possível excluir este prato porque possui composições relacionadas!';
		}

		//--------------------------
		$sql = " select count(*) as total from itens_encomenda where cod_prato = :cod_prato ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_prato',$cod_prato);
		$cmd->execute();

		$d = $cmd->fetch(PDO::FETCH_ASSOC);

		if( $d['total'] > 0 )
		{
			return 'Não é possível excluir este prato porque possui encomendas relacionadas!';
		}


		//--------------------------
		$sql = " delete from pratos where cod_prato = :cod_prato ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_prato',$cod_prato);
		$cmd->execute();

		return '';


	} // excluir

    //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {
        $descricao         = trim(@$dados['descricao']);
        $cod_prato = @$dados['cod_prato'];

        $sql = " select count(*) as total 
                 from pratos 
                 where  descricao = '$descricao' and 
                        cod_prato != '$cod_prato' ";

        $r = $this->pdo->query( $sql );

        return $r->fetch(PDO::FETCH_ASSOC);

    } // VerDuplicidade

} // class