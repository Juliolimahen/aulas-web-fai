<script type="text/javascript">
	//---------------------------------------------------------------
	function Excluir_Item(cod_prato, num_encomenda) {

		if (confirm("Deseja realmente excluir este registro ???")) {

			$('#div_status_modal_itens_encomenda').html(
				"<img src='view/_imagens/ajax-loader.gif'>Excluindo prato, aguarde...");

			$.post('index.php?modulo=itens_encomenda&acao=excluir', {
					cod_prato:cod_prato,
					num_encomenda:num_encomenda

				}

				,
				function(erro) {

					if (erro == '') {
						$('#div_status_modal_itens_encomenda').html("<img src='view/_imagens/ajax-loader.gif'>Carregando a lista, aguarde...");

						$('#div_lista_modal_itens_encomenda').load('index.php?modulo=itens_encomenda&acao=listar', {
							num_encomenda:num_encomenda

						}, function() {
							$('#div_status_modal_itens_encomenda').html("");
						});

					} // não houve erro na exclusão
					else {
						$('#div_status_modal_itens_encomenda').html('<span style="color:#F00;">' + erro + "</span>");
					}

				} // function(erro){

			); // $.post('index.php?modulo=itens_encomenda&acao=incluir'

		} // se confirmou a exclusão



	} // Excluir
</script>


<div class="row">
	<div class="col-md-12">

		<?php

		$dados = $lista_itens_encomenda->fetch(PDO::FETCH_ASSOC);

		// se houver ingredientes nesta composição
		if ($dados) {
			echo '<table class="table table-hover">';
			echo '<tr>';
			echo ' <td><strong>Num. Encomenda</strong></td>';
			echo ' <td><strong>Pratos</strong></td>';
			echo ' <td><strong>Cliente</strong></td>';
			echo ' <td><strong>Quantidade</strong></td>';
			echo ' <td><strong>Valor Uni. Prato</strong></td>';
			echo ' <td><strong>Valor Venda</strong></td>';
			//echo ' <td align="right"><strong>Vl. Unit&aacute;rio</strong></td>';
			//echo ' <td align="right"><strong>Vl. Custo</strong></td>';
			echo ' <td  class="text-center"><strong>Opção</strong></td>';
			echo '</tr>';

			$vl_total_custo = 0;
			$vl_prato = $dados['valor_prato'];

			// obtendo o próximo registro da consulta
			while ($dados) {
				$vl_total_custo += $dados['valor_compra'];

				echo '<tr class="active">';

				echo ' <td>' . $dados['num_encomenda'].'</td>';
				echo ' <td align="right">'.$dados['pratos'].'</td>';
				echo ' <td align="right">'.$dados['cliente'].'</td>';
				echo ' <td align="right">'.number_format($dados['quantidade'],2,',','.').'</td>';
				echo ' <td align="right">'.number_format($dados['valor_prato'],2,',','.').'</td>';
				echo ' <td align="right">'.number_format($dados['valor_compra'],2,',','.').'</td>';

				echo ' <td class="text-center">';

				echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir_Item('.$dados['cod_prato'].','.$dados['num_encomenda'].');">Excluir</a>';

				echo '</td>';

				echo '</tr>';

				$dados = $lista_itens_encomenda->fetch(PDO::FETCH_ASSOC);
			} // while
			
				echo '<tr class="active">';
				echo '  <td colspan="3"><b>VALOR FINAL VENDA</b></td>';
				echo '  <td colspan="3" align="right"><b> <span style="color:#00F">R$ ' .number_format($vl_total_custo,2, ',', '.') . '</span></b></td>';
				echo '</tr>';
				echo '</table>';
			
		} // if( $dados )
		else {
			echo '<p>Não há intens relacionados com essa encomenda!!!</p>';
		}

		?>

	</div>
</div>