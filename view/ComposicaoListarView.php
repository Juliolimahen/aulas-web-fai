<script type="text/javascript">

	//---------------------------------------------------------------
	function Excluir_Item(cod_prato, cod_ingrediente)
	{

		if( confirm("Deseja realmente excluir este registro ???") )
		{
		
			$('#div_status_modal_composicao').html("<img src='view/_imagens/ajax-loader.gif'>Excluindo ingrediente, aguarde...");

			$.post('index.php?modulo=composicao&acao=excluir'
					, { cod_prato: cod_prato, 
						cod_ingrediente:cod_ingrediente
					  }

					, function(erro){

						if( erro == '' )
						{
							$('#div_status_modal_composicao').html("<img src='view/_imagens/ajax-loader.gif'>Carregando a lista, aguarde...");
							
							$('#div_lista_modal_composicao').load('index.php?modulo=composicao&acao=listar'
																	, {cod_prato:cod_prato}
																	, function(){
																		$('#div_status_modal_composicao').html("");
																	  }
															      );

						} // não houve erro na exclusão
						else
						{
							$('#div_status_modal_composicao').html( '<span style="color:#F00;">'  + erro + "</span>");
						}						

					  } // function(erro){

	               ); // $.post('index.php?modulo=composicao&acao=incluir'

		} // se confirmou a exclusão
		
		

	} // Excluir


</script>


<div class="row">
	<div class="col-md-12">

		<?php

		$dados = $lista_composicao->fetch(PDO::FETCH_ASSOC);

		// se houver ingredientes nesta composição
		if( $dados )
		{
			echo '<table class="table table-hover">';
			echo '<tr>';
			echo ' <td><strong>Ingrediente</strong></td>';
			echo ' <td><strong>Quantidade</strong></td>';
			echo ' <td><strong>Unidade</strong></td>';
			echo ' <td align="right"><strong>Vl. Unit&aacute;rio</strong></td>';
			echo ' <td align="right"><strong>Vl. Custo</strong></td>';
			echo ' <td  class="text-center"><strong>Opção</strong></td>';
			echo '</tr>';

			$vl_total_custo = 0;
			$vl_prato = $dados['valor_prato'];

			// obtendo o próximo registro da consulta
			while( $dados )
			{
				$vl_total_custo += $dados['valor_custo'];

				echo '<tr class="active">';
				
				echo ' <td>'.$dados['ingrediente'] .'</td>';
				echo ' <td align="right">'.number_format($dados['qde'],2,',','.') .'</td>';
				echo ' <td align="left">'. $dados['unidade'] .'</td>';
				echo ' <td align="right">'.number_format($dados['valor_unitario'],2,',','.') .'</td>';
				echo ' <td align="right">'.number_format($dados['valor_custo'],2,',','.') .'</td>';

				echo ' <td class="text-center">';
				
				echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir_Item('.$dados['cod_prato'].',' .$dados['cod_ingrediente'].');">Excluir</a>';

				echo '</td>';

				echo '</tr>';

				$dados = $lista_composicao->fetch(PDO::FETCH_ASSOC);

			} // while

			echo '<tr class="active">';
			echo '  <td colspan="3"><b>CUSTO DO PRATO</b></td>';
			echo '  <td colspan="3" align="right"><b> <span style="color:#F00">R$ ' . number_format($vl_total_custo,2,',','.') . '</span></b></td>';
			echo '</tr>';

			echo '<tr class="active">';
			echo '  <td colspan="3"><b>VALOR DE VENDA DO PRATO</b></td>';
			echo '  <td colspan="3" align="right"><b> <span style="color:#00F">R$ ' . number_format($vl_prato,2,',','.') . '</span></b></td>';
			echo '</tr>';

			if( $vl_prato - $vl_total_custo > 0 )
			{
				echo '<tr class="active">';
				echo '  <td colspan="3"><b><span style="color:#00F">LUCRO DO PRATO</span></b></td>';
				echo '  <td colspan="3" align="right"><b> <span style="color:#00F">R$ ' . number_format($vl_prato - $vl_total_custo,2,',','.') . '</span></b></td>';
				echo '</tr>';
			}
			else
			{
				echo '<tr class="active">';
				echo '  <td colspan="3"><b><span style="color:#F00">PREJUIZO DO PRATO</span></b></td>';
				echo '  <td colspan="3" align="right"><b> <span style="color:#F00">R$ ' . number_format($vl_total_custo-$vl_prato,2,',','.') . '</span></b></td>';
				echo '</tr>';
			}


			echo '</table>';

		} // if( $dados )
		else
		{
			echo '<p>Não há ingredientes relacionados com este prato !!!</p>';
		}

		


		?>

	</div>
</div>
