<script type="text/javascript">

	
	//---------------------------------------------------------------
	function Incluir()
	{
		document.location="index.php?modulo=unidades&acao=incluindo";
	} // Incluir

	//---------------------------------------------------------------
	function Alterar(cod_unidade)
	{
		document.location="index.php?modulo=unidades&acao=alterando&cod_unidade="+cod_unidade;
	} // Alterar

	//---------------------------------------------------------------
	function Excluir(cod_unidade)
	{
		if( confirm("Deseja realmente excluir este registro ???") )
		{
			document.location='index.php?modulo=unidades&acao=excluir&cod_unidade='+cod_unidade;
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
				<h1>Unidades <small>Listagem</small></h1>
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

			<form name="fpesquisa" id="fpesquisa" method="post" action="index.php?modulo=unidades"> <!--class="form-inline" -->

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
			echo ' <td><strong>Descrição</strong></td>';
			echo ' <td><strong>Sigla</strong></td>';
			echo ' <td  class="text-center"><strong>Opções</strong></td>';
			echo '</tr>';

			// obtendo o próximo registro da consulta
			while( $dados = $lista_unidade->fetch(PDO::FETCH_ASSOC)  )
			{
				echo '<tr class="active">';
				echo ' <td class="text-center">'.$dados['cod_unidade'].'</td>';
				echo ' <td>'.$dados['descricao'].'</td>';
				echo ' <td>'.$dados['sigla'].'</td>';

				echo ' <td class="text-center">';
				
				echo '<a class="btn btn-warning btn-xs" href="javascript:Alterar('.$dados['cod_unidade'].');">Alterar</a>';
				
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';

				//echo '<a href="unidades_gravar.php?acao=excluir&cod_unidade='.$dados['cod_unidade'].'">Excluir</a>';

				echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir('.$dados['cod_unidade'].');">Excluir</a>';

				echo '</td>';

				echo '</tr>';
			} // while

			echo '</table>';

			?>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->