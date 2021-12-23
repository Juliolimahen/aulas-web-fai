<script type="text/javascript">

	
	//---------------------------------------------------------------
	function Incluir()
	{
		document.location="index.php?modulo=cidades&acao=incluindo";
	} // Incluir

	//---------------------------------------------------------------
	function Alterar(cod_cidade)
	{
		document.location="index.php?modulo=cidades&acao=alterando&cod_cidade="+cod_cidade;
	} // Alterar

	//---------------------------------------------------------------
	function Excluir(cod_cidade)
	{
		if( confirm("Deseja realmente excluir este registro ???") )
		{
			document.location='index.php?modulo=cidades&acao=excluir&cod_cidade='+cod_cidade;
		}

	} // Excluir


//-Quando a página estiver totalmente carregada --------
$(document).ready( function(){ 

	// colocando o foco na caixa de edição da pesquisa 
	$('#pesquisa').focus();
	$('#pesquisa').select();
    
}); // ready

</script>

<div class="container">


	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1>Cidades <small>Listagem</small></h1>
			</div>	
		</div>

		<div class="col-md-6">
			<div class="text-bottom text-right">
				<a href="javascript:Incluir();"  class="btn btn-success">Novo Registro</a>
			</div>	
		</div>
	</div>	

	<div class="row" id="div_form_pesquisa">
		<div class="col-md-12">

			<form name="fpesquisa" id="fpesquisa" method="post" action="index.php?modulo=cidades"> <!--class="form-inline" -->

				<?php
				$pesquisa = @$_POST['pesquisa'];
				?>

				<div class="form-group">
					<label for="pesquisa">Pesquisa:</label>
					<input type="text" class="form-control" placeholder="Digite sua pesquisa" name="pesquisa" id="pesquisa" size="40" value="<?php echo $pesquisa; ?>">
				</div>

				<input type="submit" name="btpesquisar" id="btpesquisar" value="Pesquisar" class="btn btn-primary">

			</form>
		</div>
	</div>
	<br>


	<div class="row">
		<div class="col-md-12">


			<?php

			if( @$_GET['msg'] != '' )
			{
				echo '<div class="alert alert-danger">' . @$_GET['msg'] . '</div>';
			}


			echo '<table class="table table-hover">';
			echo '<tr>';
			echo ' <td class="text-center"><strong>Código</strong></td>';
			echo ' <td><strong>Nome</strong></td>';
			echo ' <td  class="text-center"><strong>Opções</strong></td>';
			echo '</tr>';

			// obtendo o próximo registro da consulta
			while( $dados = $lista_cidade->fetch(PDO::FETCH_ASSOC)  )
			{
				echo '<tr class="active">';
				echo ' <td class="text-center">'.$dados['cod_cidade'].'</td>';
				echo ' <td>'.$dados['nome'] . '-' . $dados['uf'].'</td>';

				echo ' <td class="text-center">';
				
				echo '<a class="btn btn-warning btn-xs" href="javascript:Alterar('.$dados['cod_cidade'].');">Alterar</a>';
				
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';

				//echo '<a href="cidades_gravar.php?acao=excluir&cod_cidade='.$dados['cod_cidade'].'">Excluir</a>';

				echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir('.$dados['cod_cidade'].');">Excluir</a>';

				echo '</td>';

				echo '</tr>';
			} // while

			echo '</table>';

			?>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->