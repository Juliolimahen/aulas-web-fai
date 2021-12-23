<script type="text/javascript">

	// varivável global no javascript
	var mensagem = '<?php echo @$mensagem; ?>';

	
	//---------------------------------------------------------------
	function Incluir()
	{
		document.location="index.php?modulo=clientes&acao=incluindo";
	} // Incluir

	//---------------------------------------------------------------
	function Alterar(cod_cliente)
	{
		document.location="index.php?modulo=clientes&acao=alterando&cod_cliente="+cod_cliente;
	} // Alterar

	//---------------------------------------------------------------
	function Excluir(cod_cliente)
	{
		if( confirm("Deseja realmente excluir este registro ???") )
		{
			document.location='index.php?modulo=clientes&acao=excluir&cod_cliente='+cod_cliente;
		}

	} // Excluir


//-Quando a página estiver totalmente carregada --------
$(document).ready( function(){ 

	if( mensagem != "" )
	{
		$("#div_status").show();
		$("#div_status").html( mensagem );
	}

	// colocando o foco na caixa de edição da pesquisa 
	$('#pesquisa').focus();
	$('#pesquisa').select();
    
}); // ready

</script>

<div class="container">


	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1>Clientes <small>Listagem</small></h1>
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

			<div id="div_status" class="alert alert-danger" style="display: none;"></div>

			<form name="fpesquisa" id="fpesquisa" method="post" action="index.php?modulo=clientes"> <!--class="form-inline" -->

				<?php
				$pesquisa = @$_POST['pesquisa'];
				?>

				<div class="form-group">
					<label for="pesquisa">Pesquise pelo nome ou CPF do Cliente:</label>
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
			echo ' <td  class="text-center"><strong>CPF</strong></td>';
			echo ' <td  class="text-center"><strong>Opções</strong></td>';
			echo '</tr>';

			// obtendo o próximo registro da consulta
			while( $dados = $lista_cliente->fetch(PDO::FETCH_ASSOC)  )
			{
				echo '<tr class="active">';
				echo ' <td class="text-center">'.$dados['cod_cliente'].'</td>';
				echo ' <td>'.$dados['nome'] .'</td>';
				echo ' <td class="text-center">'.$dados['cpf'] .'</td>';

				echo ' <td class="text-center">';
				
				echo '<a class="btn btn-warning btn-xs" href="javascript:Alterar('.$dados['cod_cliente'].');">Alterar</a>';
				
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';

				//echo '<a href="clientes_gravar.php?acao=excluir&cod_cliente='.$dados['cod_cliente'].'">Excluir</a>';

				echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir('.$dados['cod_cliente'].');">Excluir</a>';

				echo '</td>';

				echo '</tr>';
			} // while

			echo '</table>';

			?>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->