<script type="text/javascript">
//----------------------------------	
$(document).ready(function() {

    //-------------------------------------------------------------
    $('div[id*=div_erro]').css('color', '#f00');

    //-------------------------------------------------------------
    $("#btcancelar").click(function() {
        document.location = "index.php?modulo=pratos";
    });

    //-------------------------------------------------------------
    //-------------------------------------------------------------
    $("#btgravar").click(function() {

        // validando o formulário ------			
        var erros = 0;

        $("#div_status").hide();
        $("#div_status").val("");

        $("div[id*=erro]").html("");

        $("#descricao").val($.trim($("#descricao").val()));

        if ($("#descricao").val() == "") {
            $("#div_error_descricao").html("O campo Descrição deve ser preenchido !!!");
            erros++;
        }

        if ($("#cod_categoria").val() == "0") {
            $("#div_error_cod_categoria").html("A categoria do prato deve ser informada !!!");
            erros++;
        }

        if (!numReal($("#valor_unitario").val())) {
            $("#div_error_valor_unitario").html("O valor unitário deve ser um número válido !!!");
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


        $.post("index.php?modulo=pratos&acao=ver-duplic", {
                descricao: $("#descricao").val(),
                cod_prato: $("#cod_prato").val()
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
                <h1>Pratos <small>Ficha</small></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form name="fcad" id="fcad" action="index.php?modulo=pratos&acao=<?php echo $acao; ?>"" method="post">

                <input type="hidden" name="cod_prato" id="cod_prato" value="<?php echo $cod_prato; ?>">

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="descricao">Descrição do Prato</label><br>
                        <input type="text" name="descricao" id="descricao" size="60" maxlength="100"
                            value="<?php echo $descricao ?>" class="form-control" placeholder="Descrição do prato">
                        <div id="div_error_descricao"></div>
                    </div>

                </div>



                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="cod_categoria">Categoria do Prato</label><br>
                        <select name="cod_categoria" id="cod_categoria" class="form-control">
                            <option value="0">Selecione uma categoria</option>

                            <?php

							while ($d = $lista_de_categorias->fetch(PDO::FETCH_ASSOC)) {

								if ($cod_categoria == $d['cod_categoria'])
									$selected = ' selected="selected" ';
								else
									$selected = '';

								echo '<option value="' . $d['cod_categoria'] . '"  ' . $selected . '  >' . $d['descricao'] . '</option>';
							} // while

							?>


                        </select>
                        <div id="div_error_cod_categoria"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="valor_unitario">Valor Unitário</label><br>
                        <input type="text" name="valor_unitario" id="valor_unitario" maxlength="8" size="10"
                            value="<?= $valor_unitario; ?>" class="form-control">
                        <div id="div_error_valor_unitario"></div>
                    </div>

                </div>

                <p>&nbsp;</p>


                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="button" name="btgravar" id="btgravar" value=" Gravar "
                            class="btn btn-success btn-md">
                        &nbsp;&nbsp;
                        <input type="button" name="btcancelar" id="btcancelar" value=" Cancelar "
                            class="btn btn-danger btn-md">
                    </div>
                </div>

                <div id="div_status" class="alert alert-danger" style="display: none;"></div>

            </form>

        </div> <!-- col -->

    </div> <!-- row -->

</div> <!-- container -->