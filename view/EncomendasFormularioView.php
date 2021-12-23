<script type="text/javascript">
    //----------------------------------	
    $(document).ready(function() {

        //-------------------------------------------------------------
        $('div[id*=div_erro]').css('color', '#f00');

        //-------------------------------------------------------------
        $("#btcancelar").click(function() {
            document.location = "index.php?modulo=encomendas";
        });

        //-------------------------------------------------------------
        //-------------------------------------------------------------
        $("#btgravar").click(function() {

            // validando o formulário ------			
            var erros = 0;

            $("#div_status").hide();
            $("#div_status").val("");

            $("div[id*=erro]").html("");

            $("#data").val($.trim($("#data").val()));

            if ($("#data").val() == "") {
                $("#div_erro_data").html("O campo Descrição deve ser preenchido !!!");
                erros++;
            }

            if ($("#cod_cliente").val() == "0") {
                $("#div_erro_cod_cliente").html("A categoria do prato deve ser informada !!!");
                erros++;
            }

            if (!numReal($("#valor_total").val())) {
                $("#div_erro_valor_total").html("O valor unitário deve ser um número válido !!!");
                erros++;
            }


            if (erros > 0) {
                $("#div_status").show();
                $("#div_status").html('<p>Não é possível gravar, há campos inválidos !</p>');

                return;
            }


            //$("#fcad").submit();


            /**/
            // analisando a duplicidade do registro da categoria
            //$("#div_status").css("color", "#00f");
            $("#div_status").show();
            $("#div_status").html(
                '<p>Verificando a duplicidade...<br><img src="view/_imagens/ajax-loader3.gif"></p>');

            $("#btgravar").attr("disabled", true);
            $("#btcancelar").attr("disabled", true);


            $.post("index.php?modulo=encomendas&acao=ver-duplic", {
                    cod_cliente: $("#cod_cliente").val(),
                    data: $("#data").val()
                },
                function(dados) {

                    $("#btgravar").attr("disabled", false);
                    $("#btcancelar").attr("disabled", false);

                    //alert( dados );

                    if ($.trim(dados) != '') {
                        //$("#div_status").css("color", "#f00");
                        $("#div_status").show();
                        $("#div_status").html('<p>' + dados + '</p>');

                    } else {
                        $("#div_status").show();
                        $("#div_status").html(
                            '<p>Enviando os dados...<br><img src="view/_imagens/ajax-loader3.gif"></p>'
                        );
                        $("#fcad").submit();
                    }


                }); // $.post
            /**/


        }); // click do btgravar
    }); // ready
</script>


<div class="container">


    <div class="row">
        <div class="col-md-6">
            <div class="page-header">
                <h1>Encomendas <small>Ficha</small></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form name="fcad" id="fcad" action="index.php?modulo=encomendas&acao=<?php echo $acao; ?>"" method="post">

                <input type="hidden" name="num_encomenda" id="num_encomenda" value="<?php echo $num_encomenda; ?>">

        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">

            <label for="data">Data</label><br>
            <input type="text" name="data" id="data" value="<?= $data; ?>" size="60" maxlength="100" class="form-control" placeholder="data">
            <div id="div_erro_data"></div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="cod_cliente">Cliente</label><br>
            <select name="cod_cliente" id="cod_cliente" class="form-control">
                <option value="0">Selecione uma cliente</option>

                <?php

                while ($d = $lista_de_clientes->fetch(PDO::FETCH_ASSOC)) {

                    if ($cod_cliente == $d['cod_cliente'])
                        $selected = ' selected="selected" ';
                    else
                        $selected = '';

                    echo '<option value="' . $d['cod_cliente'] . '"  ' . $selected . '  >' . $d['nome'] . '</option>';
                } // while

                ?>

            </select>
            <div id="div_erro_cod_cliente"></div>
        </div>
    </div>

    <div class="form-col-md-12">
        <label for="valor_total">Valor Total</label><br>
        <input type="text" name="valor_total" id="valor_total" value="<?=0//$valor_total; ?>" maxlength="20" size="10" class="form-control"readonly>
        <div id="div_erro_valor_total"></div>
    </div>

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