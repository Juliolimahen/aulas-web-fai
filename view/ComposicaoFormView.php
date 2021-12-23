
<script type="text/javascript">
	
//----------------------------------	
$(document).ready(function(){


	$('div[id*=div_erro]').css('color','#f00');

	// capturando o evento click do botão incluir
	$("#btincluir").click(function(){
		
		$('div[id*=div_erro]').html('');

		erros=0;

		if( $('#cod_ingrediente').val() == '' )
		{
			$('#div_erro_cod_ingrediente').html('O ingrediente deve ser informado!');
			erros++;
		}

		if( !numReal($.trim($('#qde').val())) )
		{
			$('#div_erro_qde').html('A quantidade de ingredientes deve ser um número válido!');
			erros++;
		}
		else
		if( $('#qde').val() <= 0 )
		{
			$('#div_erro_qde').html('A quantidade de ingredientes deve ser um número superior a zero!');
			erros++;
		}

		
		if( erros == 0 )
		{
			// chamar via ajax a ação de incluir
			$('#div_status_modal_composicao').html("<img src='view/_imagens/ajax-loader.gif'>Inserindo ingrediente, aguarde...");

			$.post('index.php?modulo=composicao&acao=incluir'
					, { cod_prato: $("#cod_prato").val(), 
						cod_ingrediente:$('#cod_ingrediente').val(),
						qde:$.trim($('#qde').val())	
					  }

					, function(erro){

						if( erro == '' )
						{
							$('#div_status_modal_composicao').html("<img src='view/_imagens/ajax-loader.gif'>Carregando a lista, aguarde...");
							$('#div_lista_modal_composicao').load('index.php?modulo=composicao&acao=listar'
																	, {cod_prato:$("#cod_prato").val()}
																	, function(){
																		$('#div_status_modal_composicao').html("");
																	  }
															      );

							// Limpando o formulário ---
							$('#cod_ingrediente').val("");
							$('#qde').val("0");

								
						} // não houve erro
						else
						{
							$('#div_status_modal_composicao').html( '<span style="color:#F00;">'  + erro + "</span>");
						}						

					  } // function(erro){

	               ); // $.post('index.php?modulo=composicao&acao=incluir'

		


		} // se não houver erros no preenchimento dos campos

	}); // evendo submit do formulário fcad

}); // ready

</script>

	<div class="row">
		<div class="col-md-12">
			<form name="fcad" id="fcad" action="" method="post">

				<input type="hidden" name="cod_prato" id="cod_prato" value="<?= @$_POST['cod_prato']; ?>">

				<div class="form-group">
					<label for="cod_ingrediente">Ingrediente:</label><br>	

					<select id="cod_ingrediente" name="cod_ingrediente" class="form-control" >
						<option value="">Selecione</option>
						<?php
							/**/
							while( $dados_ingrediente = $lista_ingrediente->fetch(PDO::FETCH_ASSOC) )
							{
								echo '<option value="'.$dados_ingrediente['cod_ingrediente'].'">'.$dados_ingrediente['descricao'].'</option>';
							} // while
							/**/
						?>
					</select>
					<div id="div_erro_cod_ingrediente"></div>
				</div>

				<p></p>

				<div class="form-group">
					<label for="qde">Quantidade do Ingrediente:</label><br>	
					<input type="text" name="qde" id="qde" size="30" maxlength="" value="0" class="form-control"  placeholder="Quantidade do ingrediente">
					<div id="div_erro_qde"></div>
				</div>

				<p></p>
				<input type="button" name="btincluir" id="btincluir" value="  Incluir  " class="btn btn-success btn-md" >

			</form>

		</div>
	</div>
