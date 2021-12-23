<script type="text/javascript">
// varivável global no javascript
var mensagem = '<?php echo @$mensagem; ?>';


//------------------------------------------------------------------------------------------------
function Abriritens_encomenda(num_encomenda, cod_prato) {
    $('#div_modal_nome_prato').html('Itens da encomenda: ' + num_encomenda);

    $('#div_form_modal_itens_encomenda').load('index.php?modulo=itens_encomenda&acao=form', {
        num_encomenda: num_encomenda
    });

    $('#div_status_modal_itens_encomenda').html(
        "<img src='view/_imagens/ajax-loader.gif'>Carregando a lista, aguarde...");

    /**/
    $('#div_lista_modal_itens_encomenda').load('index.php?modulo=itens_encomenda&acao=listar', {
        num_encomenda: num_encomenda
    }, function() {
        $('#div_status_modal_itens_encomenda').html("");
    });
    /**/

    // Abre a janela modal
    $('#modalform_itens_encomenda').modal('show');

} // Abriritens_encomenda()


//---------------------------------------------------------------
function Incluir() {
    document.location = "index.php?modulo=encomendas&acao=incluindo";
} // Incluir

//---------------------------------------------------------------
function Alterar(num_encomenda) {
    document.location = "index.php?modulo=encomendas&acao=alterando&num_encomenda=" + num_encomenda;
} // Alterar

//---------------------------------------------------------------
function Excluir(num_encomenda) {
    if (confirm("Deseja realmente excluir este registro ???")) {
        document.location = 'index.php?modulo=encomendas&acao=excluir&num_encomenda=' + num_encomenda;
    }

} // Excluir


//-Quando a página estiver totalmente carregada --------
$(document).ready(function() {

    if (mensagem != "") {
        $("#div_status").show();
        $("#div_status").html(mensagem);
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
                <h1>Encomendas <small>Listagem</small></h1>
            </div>
        </div>

        <div class="col-md-6">
            <div class="text-bottom text-right">
                <a href="javascript:Incluir();" class="btn btn-success">Novo Registro</a>
            </div>
        </div>
    </div>

    <div class="row" id="div_form_pesquisa">
        <div class="col-md-12">

            <div id="div_status" class="alert alert-danger" style="display: none;"></div>

            <form name="fpesquisa" id="fpesquisa" method="post" action="index.php?modulo=encomendas">
                <!--class="form-inline" -->

                <?php
                $pesquisa = @$_POST['pesquisa'];
                ?>

                <div class="form-group">
                    <label for="pesquisa">Pesquise pela descrição ou categoria do Prato:</label>
                    <input type="text" class="form-control" placeholder="Digite sua pesquisa" name="pesquisa"
                        id="pesquisa" size="40" value="<?php echo $pesquisa; ?>">
                </div>

                <input type="submit" name="btpesquisar" id="btpesquisar" value="Pesquisar" class="btn btn-primary">

            </form>
        </div>
    </div>
    <br>


    <div class="row">
        <div class="col-md-12">


            <?php

            if (@$_GET['msg'] != '') {
                echo '<div class="alert alert-danger">' . @$_GET['msg'] . '</div>';
            }


            echo '<table class="table table-hover">';
            echo '<tr>';
            echo ' <td class="text-center"><strong>Código</strong></td>';
            echo ' <td><strong>data</strong></td>';
            echo ' <td  class="text-left"><strong>Codigo Cliente</strong></td>';
            echo ' <td  class="text-right"><strong>Cliente</strong></td>';
            echo ' <td  class="text-right"><strong>Valor Total</strong></td>';
            echo ' <td  class="text-center"><strong>Opções</strong></td>';
            echo '</tr>';

            // obtendo o próximo registro da consulta
            while ($dados = $lista_encomenda->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr class="active">';
                echo ' <td class="text-center">' . $dados['num_encomenda'] . '</td>';
                echo ' <td class="text-left">' .dataBR($dados['data']) . '</td>';
                echo ' <td>' . $dados['cod_cliente'] . '</td>';
                echo ' <td>' . $dados['cliente'] . '</td>';
                echo ' <td class="text-right">' . number_format($dados['valor_total'], 2, ',', '.') . '</td>';

                echo ' <td class="text-center">';


                echo '<a class="btn btn-primary btn-xs" href="javascript:Abriritens_encomenda(' . $dados['num_encomenda'] . ',\'' . $dados['data'] . '\');">Itens encomenda</a>';

                echo '&nbsp;&nbsp;&nbsp;&nbsp;';

                echo '<a class="btn btn-warning btn-xs" href="javascript:Alterar(' . $dados['num_encomenda'] . ');">Alterar</a>';

                echo '&nbsp;&nbsp;&nbsp;&nbsp;';

                //echo '<a href="pratos_gravar.php?acao=excluir&num_encomenda='.$dados['num_encomenda'].'">Excluir</a>';

                echo '<a class="btn btn-danger btn-xs" href="javascript:Excluir(' . $dados['num_encomenda'] . ');">Excluir</a>';

                echo '</td>';

                echo '</tr>';
            } // while

            echo '</table>';

            ?>

        </div> <!-- col -->

    </div> <!-- row -->

</div> <!-- container -->



<!-- JANELA MODAL : https://getbootstrap.com/docs/4.0/components/modal/ -->

<!-- Modal -->

<!-- small
<div class="modal fade" id="modalform_itens_encomenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
 -->

<!-- large -->
<div class="modal fade bd-example-modal-lg" id="modalform_itens_encomenda" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <b>
                        <div id="div_modal_nome_prato"></div>
                    </b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="div_conteudo_modal_itens_encomenda">
                <div id="div_form_modal_itens_encomenda"></div>
                <div id="div_lista_modal_itens_encomenda"></div>
                <div id="div_status_modal_itens_encomenda"></div>
            </div>
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