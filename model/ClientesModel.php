<?php 

namespace Model;

use \PDO; // necessário para utilizar recursos da classe PDO

use \lib\bd;

class ClientesModel
{
	private $pdo;

	//-----------------------------------------------------
	function __construct()	{
		$meu_BD = new BD();	
		$this->pdo = $meu_BD->pdo;
	}
	
	
	//-----------------------------------------------------
	public function Get_cliente($cod_cliente)	{
		$sql = " select * 
				 from clientes 
				 where cod_cliente = '$cod_cliente' ";				  

		$r = $this->pdo->query($sql);
		return $r->fetch(PDO::FETCH_ASSOC);

	} // alterar

	//-----------------------------------------------------
	public function Get_lista($pesquisa)	{
		$sql = " select * 
				 from clientes 
				 where nome like '%$pesquisa%' or cpf like '%$pesquisa%'
				 order by nome ";				  

		return $this->pdo->query($sql);

	} // alterar

	//-----------------------------------------------------	
	protected function ExecutarSQL($dados, $acao, $sql)	{	

		$cmd = $this->pdo->prepare($sql);

		$nome                     = $dados['nome'];                    
		$cpf                      = $dados['cpf'];
		$rg                       = $dados['rg'];                     
		$sexo                     = @$dados['sexo'];                   
		$data_nascimento          = trim($dados['data_nascimento']) == "" ? null : dataUSA($dados['data_nascimento']);     
		$renda_familiar           = trim($dados['renda_familiar']) == "" ? null : floatUSA($dados['renda_familiar']);         
		$telefone                 = $dados['telefone'];               
		$celular                  = $dados['celular'];                
		$email                    = $dados['email'];                  
		$rua                      = $dados['rua'];                    
		$bairro                   = $dados['bairro'];   
		$cod_cidade               = $dados['cod_cidade'] == '0' ? null : $dados['cod_cidade'];
		$cep                      = $dados['cep'];                    
		$conheceu_por_jornais     = @$dados['conheceu_por_jornais'];   
		$conheceu_por_internet    = @$dados['conheceu_por_internet'];  
		$conheceu_por_outro       = @$dados['conheceu_por_outro'];     

		$cmd->bindValue(":nome"                     , $nome);                    
		$cmd->bindValue(":cpf"                      , $cpf);
		$cmd->bindValue(":rg"                       , $rg);                     
		$cmd->bindValue(":sexo"                     , $sexo);                   
		$cmd->bindValue(":data_nascimento"          , $data_nascimento);        
		$cmd->bindValue(":renda_familiar"           , $renda_familiar);         
		$cmd->bindValue(":telefone"                 , $telefone);               
		$cmd->bindValue(":celular"                  , $celular);                
		$cmd->bindValue(":email"                    , $email);                  
		$cmd->bindValue(":rua"                      , $rua);                    
		$cmd->bindValue(":bairro"                   , $bairro);                 
		$cmd->bindValue(":cod_cidade"               , $cod_cidade);             
		$cmd->bindValue(":cep"                      , $cep);                    
		$cmd->bindValue(":conheceu_por_jornais"     , $conheceu_por_jornais);   
		$cmd->bindValue(":conheceu_por_internet"    , $conheceu_por_internet);  
		$cmd->bindValue(":conheceu_por_outro"       , $conheceu_por_outro);	

		if( $acao == 'alterar' )
		{
			$cmd->bindValue(':cod_cliente',$dados['cod_cliente']);	
		}
		
		$cmd->execute();

	} // ExecutarSQL
	
	//-----------------------------------------------------	
	public function Incluir($dados)	{	

		$sql = " insert into clientes 	
					(nome,cpf,rg,sexo,data_nascimento,renda_familiar,telefone,celular,email,rua,bairro,cod_cidade,cep,conheceu_por_jornais,conheceu_por_internet,conheceu_por_outro) 
				 values 
				 	(:nome,:cpf,:rg,:sexo,:data_nascimento,:renda_familiar,:telefone,:celular,:email,:rua,:bairro,:cod_cidade,:cep,:conheceu_por_jornais,:conheceu_por_internet,:conheceu_por_outro) 
				";

		$this->ExecutarSQL($dados, 'incluir', $sql);


	} // incluir

	//-----------------------------------------------------
	public function Alterar($dados)	{			

		$sql = " update clientes set
						nome                     = :nome                   , 
						cpf                      = :cpf                    ,
						rg                       = :rg                     ,
						sexo                     = :sexo                   ,
						data_nascimento          = :data_nascimento        ,
						renda_familiar           = :renda_familiar         ,
						telefone                 = :telefone               ,
						celular                  = :celular                ,
						email                    = :email                  ,
						rua                      = :rua                    ,
						bairro                   = :bairro                 ,
						cod_cidade               = :cod_cidade             ,
						cep                      = :cep                    ,
						conheceu_por_jornais     = :conheceu_por_jornais   ,
						conheceu_por_internet    = :conheceu_por_internet  ,
						conheceu_por_outro       = :conheceu_por_outro   

				 where cod_cliente = :cod_cliente
			   ";

		$this->ExecutarSQL($dados, 'alterar', $sql);


	} // alterar

	//-----------------------------------------------------
	public function Excluir($cod_cliente)	{			

		// verificando a integridade referencial -----	

		$sql = " select count(*) as total from encomendas where cod_cliente = :cod_cliente ";

		$cmd = $this->pdo->prepare($sql);
		$cmd->bindValue(':cod_cliente',$cod_cliente);
		$cmd->execute();

		$d = $cmd->fetch(PDO::FETCH_ASSOC);

		if( $d['total'] == 0 )
		{
			$sql = " delete from clientes where cod_cliente = :cod_cliente ";

			$cmd = $this->pdo->prepare($sql);
			$cmd->bindValue(':cod_cliente',$cod_cliente);
			$cmd->execute();

			return '';

		} // se estiver ok com a integridade referencial
		else 
		{
			return 'Não é possível excluir este cliente porque possui encomendades relacionadas!';
		}

	} // excluir

    //--------------------------------------------------------------------------
    public function VerDuplicidade($dados)
    {
        $cpf         = trim(@$dados['cpf']);
        $cod_cliente = @$dados['cod_cliente'];

        $sql = " select count(*) as total 
                 from clientes 
                 where  cpf = '$cpf' and 
                        cod_cliente != '$cod_cliente' ";

        $r = $this->pdo->query( $sql );

        return $r->fetch(PDO::FETCH_ASSOC);

    } // VerDuplicidade

} // class