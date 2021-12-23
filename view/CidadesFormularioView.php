<script type="text/javascript">
	
//----------------------------------	
$(document).ready(function(){

	//-------------------------------------------------------------
	$('div[id*=div_erro]').css('color','#f00');

	//-------------------------------------------------------------
	$("#btcancelar").click(function(){
		document.location="index.php?modulo=cidades";
	});

	//-------------------------------------------------------------
	// capturando o evento submit do formulário
	$('#fcad').submit(function(){
		
		$('div[id*=div_erro]').html('');

		erros=0;

		if( $.trim($('#nome').val()) == '' )
		{
			$('#div_error_nome').html('O nome deve ser preenchido!');
			erros++;
		}

		if( $.trim($('#uf').val()) == '' )
		{
			$('#div_error_uf').html('A uf deve ser preenchida!');
			erros++;
		}

		return erros == 0;

	}); // evendo submit do formulário fcad

}); // ready

</script>

<div class="container">


	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1>Cidades <small>Ficha</small></h1>
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form name="fcad" id="fcad" action="index.php?modulo=cidades&acao=<?php echo $acao; ?>"" method="post">

				<input type="hidden" name="cod_cidade" id="cod_cidade" value="<?php echo $cod_cidade; ?>">

				<div class="form-row">

					<div class="form-group col-md-8">
						<label for="nome">Nome:</label><br>	
						<input type="text" name="nome" id="nome" size="60" maxlength="100" value="<?php echo $nome ?>" class="form-control"  placeholder="Nome da cidade">
						<div id="div_error_nome"></div>
					</div>

					<div class="form-group col-md-4">
						<label for="uf">Unidade Federal:</label><br>	
						<input type="text" name="uf" id="uf" size="30" maxlength="2" value="<?php echo $uf ?>" class="form-control"  placeholder="Unidade Federal">
						<div id="div_error_uf"></div>
					</div>

				</div>


				<div class="form-row">
					<div class="form-group col-md-12">
						<input type="submit" name="btgravar" id="btgravar" value=" Gravar " class="btn btn-success btn-md">
						&nbsp;&nbsp;
						<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar " class="btn btn-danger btn-md">
					</div>
				</div>

				<div id="div_status" class="alert alert-danger" style="display: none;"></div>

			</form>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->