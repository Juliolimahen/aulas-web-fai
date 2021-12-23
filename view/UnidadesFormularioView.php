<script type="text/javascript">
	
//----------------------------------	
$(document).ready(function(){

	//-------------------------------------------------------------
	$('div[id*=div_erro]').css('color','#f00');

	//-------------------------------------------------------------
	$("#btcancelar").click(function(){
		document.location="index.php?modulo=unidades";
	});

	//-------------------------------------------------------------
	// capturando o evento submit do formulário
	$('#fcad').submit(function(){
		
		$('div[id*=div_erro]').html('');

		erros=0;

		if( $.trim($('#descricao').val()) == '' )
		{
			$('#div_error_descricao').html('O descricao deve ser preenchido!');
			erros++;
		}

		if( $.trim($('#sigla').val()) == '' )
		{
			$('#div_error_sigla').html('A sigla deve ser preenchida!');
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
				<h1>Unidades <small>Ficha</small></h1>
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form name="fcad" id="fcad" action="index.php?modulo=unidades&acao=<?php echo $acao; ?>"" method="post">

				<input type="hidden" name="cod_unidade" id="cod_unidade" value="<?php echo $cod_unidade; ?>">

				<div class="form-row">

					<div class="form-group col-md-8">
						<label for="descricao">Descrição:</label><br>	
						<input type="text" name="descricao" id="descricao" size="60" maxlength="100" value="<?php echo $descricao ?>" class="form-control"  placeholder="Descrição da unidade">
						<div id="div_error_descricao"></div>
					</div>

					<div class="form-group col-md-4">
						<label for="sigla">Sigla:</label><br>	
						<input type="text" name="sigla" id="sigla" size="30" maxlength="15" value="<?php echo $sigla ?>" class="form-control"  placeholder="Sigla da unidade">
						<div id="div_error_sigla"></div>
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