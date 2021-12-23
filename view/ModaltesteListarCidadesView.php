<?php
	while( $dados = $lista_cidade->fetch(PDO::FETCH_ASSOC) )
	{
		echo $dados['nome'] . '-' . $dados['uf'] . '<br>';
	}
?>