<script type="text/javascript">
    //----------------------------------	
    $(document).ready(function() {


        $('div[id*=div_erro]').css('color', '#f00');

        // capturando o evento click do botão incluir
        $("#btincluir").click(function() {

            $('div[id*=div_erro]').html('');

            erros = 0;

            if ($('#cod_prato').val() == '') {
                $('#div_erro_cod_cod_prato').html('O Prato deve ser informado!');
                erros++;
            }

            if (!numReal($.trim($('#quantidade').val()))) {
                $('#div_erro_quantidade').html('A quantidade de ingredientes deve ser um número válido!');
                erros++;
            } else
            if ($('#quantidade').val() <= 0) {
                $('#div_erro_quantidade').html(
                    'A quantidade de ingredientes deve ser um número superior a zero!');
                erros++;
            }

            if (erros == 0) {
                // chamar via ajax a ação de incluir
                $('#div_status_modal_itens_encomenda').html(
                    "<img src='view/_imagens/ajax-loader.gif'>Inserindo ingrediente, aguarde...");

                $.post('index.php?modulo=itens_encomenda&acao=incluir', {
                        num_encomenda: $("#num_encomenda").val(),
                        cod_prato: $('#cod_prato').val(),
                        quantidade: $.trim($('#quantidade').val())
                    }

                    ,
                    function(erro) {

                        if (erro == '') {
                            $('#div_status_modal_itens_encomenda').html(
                                "<img src='view/_imagens/ajax-loader.gif'>Carregando a lista, aguarde..."
                            );
                            $('#div_lista_modal_itens_encomenda').load(
                                'index.php?modulo=itens_encomenda&acao=listar', {
                                    num_encomenda: $("#num_encomenda").val()
                                },
                                function() {
                                    $('#div_status_modal_itens_encomenda').html("");
                                });

                            // Limpando o formulário ---
                            $('##cod_prato').val("0");
                            $('#quantidade').val("0");


                        } // não houve erro
                        else {
                            $('#div_status_modal_itens_encomenda').html('<span style="color:#F00;">' +
                                erro +
                                "</span>");
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

            <input type="hidden" name="num_encomenda" id="num_encomenda" value="<?= @$_POST['num_encomenda']; ?>">

            <div class="form-group">
                <label for="cod_prato">Prato:</label><br>

                <select id="cod_prato" name="cod_prato" class="form-control">
                    <option value="">Selecione um prato</option>
                    <?php
                    /**/
                    while ($dados_prato = $lista_pratos->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $dados_prato['cod_prato'] . '">' . $dados_prato['descricao'] . '</option>';
                    } // while
                    /**/
                    ?>
                </select>
                <div id="div_erro_cod_prato"></div>
            </div>

            <p></p>

            <div class="form-group">
                <label for="qde">Quantidade de prato:</label><br>
                <input type="text" name="quantidade" id="quantidade" size="30" maxlength="20" value="0" class="form-control" placeholder="Quantidade itens">
                <div id="div_erro_quantidade"></div>
            </div>

            <p></p>

            <input type="button" name="btincluir" id="btincluir" value="Incluir" class="btn btn-success btn-md">

        </form>

    </div>
</div>