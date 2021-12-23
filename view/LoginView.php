<script type="text/javascript">
	
	$(document).ready(function(){
		//alert('jQuery working!!!');


		$("#btacessar").click(function(){

			$("#div_status").css("color", "#00f");
			$("#div_status").html('<p>Autenticando usuário...<br><img src="view/_imagens/ajax-loader3.gif"></p>');

			$("#btacessar").attr("disabled", true);
			$("#login").attr("disabled", true);
			$("#senha").attr("disabled", true);

			$.post("index.php?modulo=autenticar", {login:$("#login").val(), senha:$("#senha").val()}, function(dados){

				$("#btacessar").attr("disabled", false);
				$("#login").attr("disabled", false);
				$("#senha").attr("disabled", false);

				if( dados == '' ) // se o usuário e senha estiverem corretos
				{
					$("#div_status").html("<p>Usuário e senha corretos...</p>");

					document.location="index.php";

				}
				else // se o usuário e/ou senha não estiverem corretos
				{
					$("#div_status").css("color", "#f00");
					$("#div_status").html( dados );
				}

			}); // $.post()


						

		}); // onclick do btcessar

	}); // ready

</script>


<div class="container">

	<div class="row">
		<div class="col-12">		

			<div class="page-heaer text-center">		
				<h3>ACESSO AO SISTEMA</h3>
			</div>

			<form name="flogin" id="flogin" action="autenticar.php" method="post">
				
				<div class="form-group">
					Login:<br>
					<input type="text" name="login" id="login" value="" class="form-control">
				</div>


				<div class="form-group">
					Senha:<br>
					<input type="password" name="senha" id="senha" value="" class="form-control">
				</div>

				<p></p>
				<div class="form-group text-center">
					<input type="button" name="btacessar" id="btacessar" value=" Acessar " class="btn btn-success">
				</div>

			</form>

			<div id="div_status"></div>

		</div> <!-- col -->

	</div> <!-- row -->

</div> <!-- container -->

