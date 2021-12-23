<script type="text/javascript">
	
	//-------------------------------------------------------
	// Apresenta Formulário (janela) Modal que apresenta informações aleatórias
	function AbrirModalTeste()
	{

		$('#div_conteudo_janela_modal_teste').html('Conteúdo da jenala. <br>Poderia ser carregado por ajax também...');

		// Abre a janela modal
		$('#modalform_teste').modal('show');

	} // AbrirModalTeste()

	//-------------------------------------------------------
	function ListarCidadesModal()
	{

		$('#div_conteudo_janela_modal_teste').html('<img src="view/_imagens/ajax-loader.gif">Obtendo dados, aguarde...');

		// Abre a janela modal
		$('#modalform_teste').modal('show');

		// Carregando o conteúdo da janela via ajax
		$('#div_conteudo_janela_modal_teste').load('index.php?modulo=modalteste&acao=listarcidades');

	} // ListarCidadesModal()

	

</script>


<div class="row" id="div_titulo">
	<div class="col-md-12">
		<div class="alert alert-success" role="alert" id="div_titulo_texto"><b>Hello World em Janelas Modais utilizando Bootstrap !!!</b></div>
	</div>
</div>


<p>&nbsp;</p>

<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalform_teste" >Abrir Janela Modal através das classes e propriedades do Bootstrap no Link</a>

<p>&nbsp;</p>


<a class="btn btn-primary btn-sm" href="javascript:AbrirModalTeste();">Abrir Janela Modal via JavaScript</a>


<p>&nbsp;</p>

<a class="btn btn-success btn-sm" href="javascript:ListarCidadesModal();">Listar Cidades</a>


<!-- JANELA MODAL : https://getbootstrap.com/docs/4.0/components/modal/ -->

<!-- Modal -->
<div class="modal fade" id="modalform_teste" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Janela Modal - Testes</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      	<div class="modal-body" id="div_conteudo_janela_modal_teste"></div>
      <div class="modal-footer">
      	<!--
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    	-->
    	<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>




