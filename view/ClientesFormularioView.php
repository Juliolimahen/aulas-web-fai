<script type="text/javascript">
	
//----------------------------------	
$(document).ready(function(){

	//-------------------------------------------------------------
	$('div[id*=div_erro]').css('color','#f00');

	//-------------------------------------------------------------
	$("#btcancelar").click(function(){
		document.location="index.php?modulo=clientes";
	});

	//-------------------------------------------------------------
		//-------------------------------------------------------------
		$("#btgravar").click(function(){

			// validando o formulário ------			
			var erros = 0;

			$("#div_status").hide();
			$("#div_status").val("");

			$("div[id*=erro]").html("");

			$("#nome").val(  $.trim($("#nome").val() ) );

			if( $("#nome").val() == "" )
			{
				$("#div_error_nome").html("O campo Nome deve ser preenchido !!!");
				erros++;
			}

			if( !validaCPF($("#cpf").val()) )
			{
				$("#div_error_cpf").html("O campo CPF deve ser válido !!!");
				erros++;
			}


			if( erros > 0 )
			{
				$("#div_status").show();
				$("#div_status").html('<p>Não é possível gravar, há campos inválidos !</p>');

				return;
			}


			//$("#fcad").submit();


			/**/
			// analisando a duplicidade do registro da cidade
			//$("#div_status").css("color", "#00f");
			$("#div_status").show();
			$("#div_status").html('<p>Verificando a duplicidade...<br><img src="view/_imagens/ajax-loader3.gif"></p>');

			$("#btgravar").attr("disabled", true);
			$("#btcancelar").attr("disabled", true);

			
			$.post("index.php?modulo=clientes&acao=ver-duplic", 
							{ cpf:$("#cpf").val(), 
							  cod_cliente:$("#cod_cliente").val()
						    }, 
				function(dados){

					$("#btgravar").attr("disabled", false);
					$("#btcancelar").attr("disabled", false);

					//alert( dados );

					if( $.trim(dados) != '' )
					{
						//$("#div_status").css("color", "#f00");
						$("#div_status").show();						
						$("#div_status").html('<p>'+ dados +'</p>');

					}
					else
					{
						$("#div_status").show();
						$("#div_status").html('<p>Enviando os dados...<br><img src="view/_imagens/ajax-loader3.gif"></p>');
						$("#fcad").submit();
					}
				

			} ); // $.post
			/**/


		}); // click do btgravar
}); // ready

</script>

<div class="container">


	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1>Clientes <small>Ficha</small></h1>
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form name="fcad" id="fcad" action="index.php?modulo=clientes&acao=<?php echo $acao; ?>"" method="post">

				<input type="hidden" name="cod_cliente" id="cod_cliente" value="<?php echo $cod_cliente; ?>">

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="nome">Nome</label><br>	
						<input type="text" name="nome" id="nome" size="60" maxlength="100" value="<?php echo $nome ?>" class="form-control"  placeholder="Nome do cliente">
						<div id="div_error_nome"></div>
					</div>

				</div>


				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="cpf">CPF</label><br>	
						<input type="text" name="cpf" id="cpf" maxlength="11" value="<?= $cpf; ?>" size="20" class="form-control">
						<div id="div_error_cpf"></div>
					</div>

					<div class="form-group col-md-3">
						<label for="rg">RG</label><br>	
						<input type="text" name="rg" id="rg" maxlength="16" value="<?= $rg; ?>" size="20" class="form-control">
						<div id="div_error_rg"></div>
					</div>

					<div class="form-group col-md-3">
						<label for="data_nascimento">Data de Nascimento</label><br>	
						<input type="text" name="data_nascimento" id="data_nascimento" value="<?= $data_nascimento; ?>" maxlength="10" class="form-control" >
						<div id="div_error_data_nascimento"></div>
					</div>


					<div class="form-group col-md-3">
						<label for="renda_familiar">Renda Familiar</label><br>	
						<input type="text" name="renda_familiar" id="renda_familiar" value="<?= $renda_familiar; ?>" class="form-control">
						<div id="div_error_renda_familiar"></div>
					</div>
				</div>


				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="sexoM">Sexo</label><br>	

						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" <?php if( $sexo == 'M' ) echo ' checked="checked" '; ?> >
						  <label class="form-check-label" for="sexoM"> Masculino </label>
						</div>

						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" <?php if( $sexo == 'F' ) echo ' checked="checked" '; ?> >
						  <label class="form-check-label" for="sexoF"> Feminino </label>
						</div>

						<div id="div_error_sexo"></div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="telefone">Telefone</label><br>	
						<input type="text" name="telefone" id="telefone" maxlength="20" value="<?= $telefone; ?>" class="form-control">
						<div id="div_error_telefone"></div>
					</div>

					<div class="form-group col-md-3">
						<label for="celular">Celular</label><br>	
						<input type="text" name="celular" id="celular" maxlength="20" value="<?= $celular; ?>" class="form-control">
						<div id="div_error_celular"></div>
					</div>

					<div class="form-group col-md-6">
						<label for="email">E-mail</label><br>	
						<input type="text" name="email" id="email" maxlength="150" size="60" value="<?= $email; ?>" class="form-control">
						<div id="div_error_email"></div>
					</div>
				</div>


				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="rua">Logradouro:(Rua, Avenida, Alameda...)</label><br>	
						<input type="text" name="rua" id="rua" maxlength="200" size="60" value="<?= $rua; ?>" class="form-control">
						<div id="div_error_rua"></div>
					</div>

					<div class="form-group col-md-6">
						<label for="bairro">Bairro</label><br>	
						<input type="text" name="bairro" id="bairro" maxlength="100" size="60" value="<?= $bairro; ?>" class="form-control">
						<div id="div_error_bairro"></div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-8">
						<label for="cod_cidade">Cidade</label><br>	
						<select name="cod_cidade" id="cod_cidade" class="form-control">
							<option value="0">Selecione uma cidade</option>	

							<?php

								while( $d = $lista_de_cidades->fetch(PDO::FETCH_ASSOC) )
								{

									if( $cod_cidade == $d['cod_cidade'] ) 
										$selected = ' selected="selected" ';
									else
										$selected = '';

									echo '<option value="'.$d['cod_cidade'].'"  '.$selected.'  >'.$d['nome'].'-'.$d['uf'].'</option>';

								} // while

							?>


						</select>
						<div id="div_error_cod_cidade"></div>
					</div>

					<div class="form-group col-md-4">
						<label for="cep">Cep</label><br>	
						<input type="text" name="cep" id="cep" maxlength="8" size="10" value="<?= $cep; ?>" class="form-control">
						<div id="div_error_cep"></div>
					</div>

				</div>


					Como conheceu nossa loja ?<br>

					<div class="form-check">
						<input type="checkbox" class="form-check-input"  name="conheceu_por_jornais" id="conheceu_por_jornais" value="1" <?php if( $conheceu_por_jornais == '1' ) echo ' checked="checked" '; ?> >			
						<label class="form-check-label" for="conheceu_por_jornais"> Jornais </label>
					</div>

					<div class="form-check">
						<input type="checkbox" class="form-check-input"  name="conheceu_por_internet" id="conheceu_por_internet" value="1" <?php if( $conheceu_por_internet == '1' ) echo ' checked="checked" '; ?> >			
						<label class="form-check-label" for="conheceu_por_internet"> Internet </label>
					</div>

					<div class="form-check">
						<input type="checkbox"  class="form-check-input" name="conheceu_por_outro" id="conheceu_por_outro" value="1" <?php if( $conheceu_por_outro == '1' ) echo ' checked="checked" '; ?> >			
						<label class="form-check-label" for="conheceu_por_outro"> Outros meios </label>
					</div>

					<div id="div_error_como_conheceu"></div>

				<p>&nbsp;</p>


				<div class="form-row">
					<div class="form-group col-md-12">
						<input type="button" name="btgravar" id="btgravar" value=" Gravar " class="btn btn-success btn-md">
						&nbsp;&nbsp;
						<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar " class="btn btn-danger btn-md">
					</div>
				</div>

				<div id="div_status" class="alert alert-danger" style="display: none;"></div>

			</form>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->