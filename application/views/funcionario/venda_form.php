<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Vendas - {ACAO}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-dollar"></i> Gerenciar Vendas</li>
            <li class="active">
                <a href="<?php echo site_url('funcionario/venda'); ?>"> Listar Vendas</a>
            </li>
        </ol>
    </section>
    <div class="row">
        <div class="col-md-6">
            <br/>
            {MENSAGEM_SISTEMA_ERRO}
            {MENSAGEM_SISTEMA_SUCESSO}
        </div>
        <div class="col-md-6"></div>
    </div>

    <section class="content">

        <div class="row">
            <?php echo form_open(base_url('funcionario/venda/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Básicas - Venda</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4>Instruções</h4>
                                <ul>
                                    <li>Verifique novamente antes de criar a venda. A venda, uma vez feita não pode ser alterada.</li>
                                    <li>Você pode adicionar um produto pela busqueda por código de barras ou selecionando a categoria de produto.</li>
                                    <li>Você pode inserir percentagem de desconto e também pode editar a percentagem referida na seção de pagamentos.</li>
                                    <li>Digite o valor do pagamento que o cliente dá e ver a quantidade de alteração e valor líquido a pagar.</li>
                                    <li>O número entre parênteses no campo atributos representa a quantidade em estoque do produto.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="codigo_venda">Código da Venda</label>

                                <input class="form-control" type="text" name="codigo_venda" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" readonly />
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="id_cliente">Cliente <span class="required">*</span></label>

                                <select class="form-control select2" name="id_cliente" id="id_cliente" data-error="Selecione um cliente" required>
                                    <option value="" selected>Selecione um cliente</option>
                                    {BLC_CLIENTES}
                                    <option value="{ID_CLIENTE}">{NOMECLIENTE}</option>
                                    {/BLC_CLIENTES}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <!--<div class="form-group">
                                <label class="control-label" for="data_cadastro">Data <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="data_cadastro" id="data_cadastro" placeholder="Selecione uma data" value="<?php echo date('d/m/Y'); ?>" data-error="O campo data é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>-->
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Produtos selecionados para Compra</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código do Produto</th>
                                        <th>Produto</th>
                                        <th>Atributos</th>
                                        <th>Preço Unitário</th>
                                        <th>Total</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="entrada_vendas">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <i class="fa fa-search"></i> Produto pelo código de barra</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <input type="text" placeholder="Buscar pelo código de barras" class="form-control" name="" autofocus
                                       id="barcode" onKeyPress="return barcode_input(event, this.value)" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Selecione o produto por categoria</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <select onchange="get_produto('categoria', this.value)" class="form-control select2" name="idcategoria" id="idcategoria">
                                    <option value="" selected>Selecione uma categoria</option>
                                    <?php
                                    $categorias = $this->db->get('categoria')->result();
                                    foreach ($categorias as $row):
                                        ?>
                                        <option value="<?php echo $row->idcategoria; ?>"><?php echo $row->nome; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div id="lista_categoria">

                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Selecionar os produtos para venda</h3>
                    </div>
                    <div class="box-body">

                        <div class="panel-body">
                            <div id="lista_produtos">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Pagamento</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="subtotal" class="col-sm-4 control-label">Subtotal</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" name="subtotal" id="subtotal" value="" />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="desconto" class="col-sm-4 control-label">Desconto</label>
                                <div class="col-sm-6">
                                    <input class="form-control text-right" type="text" name="percentagem_desconto" id="percentagem_desconto" value="" onkeyup="calcular_valor_total()" readonly />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="percentagem_imposto" class="col-sm-4 control-label">% de Imposto</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" name="percentagem_imposto" id="percentagem_imposto" onkeyup="calcular_valor_total()" value="<?php echo $imposto; ?>" placeholder="% de Imposto" readonly />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="valor_total" class="col-sm-4 control-label">Valor Total</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" name="valor_total" id="valor_total" value="">
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="pagamento" class="col-sm-4 control-label">Pagamento</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right money" name="pagamento" id="pagamento" value="" onkeyup="return calcular_alterar_valor()" placeholder="Digite o valor do pagamento" data-error="O campo pagamento é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="alterar" class="col-sm-4 control-label">Troco</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" id="troco_valor" value="">
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="pagamento_liquido" class="col-sm-4 control-label">Pagamento Líquido</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" name="valor" id="pagamento_liquido" value="" />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="valor_restante" class="col-sm-4 control-label">Valor Restante</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" name="valor_restante" id="valor_restante" value="" />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="forma_pagamento" class="col-sm-4 control-label">Forma de Pagamento</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="forma_pagamento" id="forma_pagamento" data-error="Selecione forma de pagamento" required>
                                        <option value="" selected>Selecione forma de pagamento</option>
                                        <option value="1">Dinheiro</option>
                                        <option value="2">Cheque</option>
                                        <option value="3">Cartão</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Nova venda</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>

    total_linha = 0;
    function adicionar_produto(idproduto) {

        total_linha++;

        // Verifica se produto ja existe
        if ($('#idproduto_' + idproduto).val()) {
            Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Produto já foi inserido na venda."
                    });

            $('#idproduto_' + idproduto).closest('tr').css("background-color", "#2196f3");
            return;
        }

        // Lista detalhes do Produto
        $.ajax({
            url: '<?php echo base_url(); ?>funcionario/venda/get_produto_selecionado/mouse/' + idproduto + '/' + total_linha,
            success: function (result)
            {
                $('#entrada_vendas').append(result);
                calcular_valor_total();
                calcular_pedido(idproduto);
                iniciar();
            }
        });
    }

    function barcode_input(e, codigo_produto) {

        var key;

        if (window.event) {
            key = window.event.keyCode;     //IE
        } else {
            key = e.which;     //firefox
        }

        if (key == 13) {

            total_linha++;

            // Verifica se produto ja existe
            if ($('#codigoproduto_' + codigo_produto).val()) {
                Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Produto já foi inserido na venda."
                        });

                $('#codigoproduto_' + codigo_produto).closest('tr').css("background-color", "#2196f3");
                return;
            }

            // Lista detalhes do Produto
            $.ajax({
                url: '<?php echo base_url(); ?>funcionario/venda/get_produto_selecionado/barcode/' + codigo_produto + '/' + total_linha,
                success: function (result)
                {
                    $('#entrada_vendas').append(result);
                    calcular_valor_total();
                    verifica_pedido_barcode();
                    iniciar();
                    $("#barcode").val("");
                }
            });

            return false;
        }
        else {
            return true;
        }
    }

    function get_produto(tipo, id_categoria) {
        $.ajax({
            url: '<?php echo base_url(); ?>funcionario/venda/get_produtos/' + tipo + '/' + id_categoria,
            success: function (result)
            {
                jQuery('#lista_produtos').html(result);
            }
        });

        if (tipo == 'categoria')
        {
            $.ajax({
                url: '<?php echo base_url(); ?>funcionario/venda/get_subcategoria/' + id_categoria,
                success: function (result)
                {
                    jQuery('#lista_categoria').html(result);
                }
            });
        }
    }

    function iniciar() {
        $('.atributos').on("click", function () {

            var id = this.id;

            if ($(this).is(':checked')) {
                $('#qtde_' + id).prop('disabled', false);
                $('#qtde_' + id).val('');
            } else {
                $('#qtde_' + id).val('');
                $('#qtde_' + id).prop('disabled', true);
            }
        });
    }

    // Desconto Cliente
    jQuery(document).ready(function () {

        $("#id_cliente").change(function () {

            var id_cliente = $('#id_cliente').val();

            $.ajax({
                url: '<?php echo base_url(); ?>funcionario/venda/get_desconto',
                type: 'POST',
                data: {
                    id_cliente: id_cliente
                },
                beforeSend: function () {
                    $("select[name='id_cliente']").after('<i class="fa fa-spinner"></i>');
                },
                complete: function () {
                    $('.fa-spinner').remove();
                },
                success: function (result)
                {
                    jQuery('#percentagem_desconto').val(result);
                }
            });
        });
    });

    function calcular_pedido(entry_number, idprodestoque) {

        var quantidade = parseInt(0);
        $('.clprodestoque').each(function () {
            var proditem = this.id;
            if (proditem.indexOf("qtde_" + entry_number + "_") >= 0) {
                quantidade += Number(this.value);
            }
        });

        quantidade = parseInt(quantidade);
        $("#quantidade_" + entry_number).val(quantidade);

        precovenda = $("#precovenda_" + entry_number).val();
        precovenda = corrigeMask(precovenda);

        total = Number(quantidade * precovenda);
        total = maskMoney(total);

        $("#valor_total_" + entry_number).html(total);
        calcular_valor_total();
        calcular_alterar_valor();

    }

    function verifica_pedido_barcode() {

        var quantidade = parseInt(0);
        $('.clprodestoque').each(function () {
            quantidade += Number(this.value);
        });

        quantidade = parseInt(quantidade);

        $('input[name^="precovenda"]').each(function () {
            precovenda = ($(this).val());
        });

        precovenda = corrigeMask(precovenda);

        total = Number(quantidade * precovenda);
        total = maskMoney(total);

        $(".valor_total").html(total);
        calcular_valor_total();
        calcular_alterar_valor();

    }

    function calcular_valor_total() {

        subtotal = 0;

        $('.list_idproduto').each(function () {

            if ($('#idproduto_' + this.value).val() > 0) {
                if (this.value != '') {
                    //console.log("Produto: " + $('#idproduto_' + this.value).val())

                    valoritem = corrigeMask($("#valor_total_" + this.value).html());
                    //console.log("Valor item : " + valoritem)        
                    subtotal += Number(valoritem);
                }
            }
        });

        // calculo valor total
        percentagem_desconto = Number($("#percentagem_desconto").val())
        percentagem_imposto = Number($("#percentagem_imposto").val())

        subtotal = subtotal - (subtotal * (percentagem_desconto / 100))
        valor_total = subtotal + (subtotal * (percentagem_imposto / 100))

        subtotal = maskMoney(subtotal)
        valor_total = maskMoney(valor_total)

        $("#subtotal").attr("value", subtotal)
        $("#valor_total").attr("value", valor_total)
    }

    function excluir_linha(entry_number) {

        $("#entry_row_" + entry_number).remove();

        for (var i = entry_number; i < total_linha; i++) {

            $("#serial_" + (i + 1)).attr("id", "serial_" + i);
            $("#serial_" + (i)).html(i);

            $("#quantidade_" + (i + 1)).attr("id", "quantidade_" + i);
            $("#quantidade_" + (i)).attr({onkeyup: "calcular_pedido(" + i + ")", onclick: "calcular_pedido(" + i + ")"});

            $("#precovenda_" + (i + 1)).attr("id", "precovenda_" + i);
            $("#precovenda_" + (i)).attr({onkeyup: "calcular_pedido(" + i + ")", onclick: "calcular_pedido(" + i + ")"});

            $("#excluir_btn_" + (i + 1)).attr("id", "excluir_btn_" + i);
            $("#excluir_btn_" + (i)).attr("onclick", "excluir_linha(" + i + ")");

            $("#entry_row_" + (i + 1)).attr("id", "entry_row_" + i);
        }

        total_linha--;
        calcular_valor_total();
        
        if (total_linha == 0) {
            $('#id_cliente').select2("val", "");
            $('#idcategoria').select2("val", "");
            $("#valor_restante").attr("value", 0);
            $("#percentagem_desconto").val("");
        }
    }

    function calcular_alterar_valor() {
        valor_total = Number(corrigeMask($("#valor_total").val()));
        pagamento = Number(corrigeMask($("#pagamento").val()));

        if (pagamento > valor_total) {
            alterar_valor = pagamento - valor_total;
            valor_liquido = pagamento - alterar_valor;

            alterar_valor = maskMoney(alterar_valor);
            valor_liquido = maskMoney(valor_liquido);
            $("#troco_valor").attr("value", alterar_valor);
            $("#pagamento_liquido").attr("value", valor_total);
            $("#valor_restante").attr("value", 0);
        }

        if (pagamento < valor_total) {
            $("#troco_valor").attr("value", 0);
            get_valor_restante = valor_total - pagamento;
            pagamento = maskMoney(pagamento);
            get_valor_restante = maskMoney(get_valor_restante);
            $("#pagamento_liquido").attr("value", pagamento);
            $("#valor_restante").attr("value", get_valor_restante);
        }

        if (pagamento == valor_total) {
            pagamento = maskMoney(pagamento);
            $("#troco_valor").attr("value", 0);
            $("#pagamento_liquido").attr("value", pagamento);
            $("#valor_restante").attr("value", 0);
        }
    }

    function maskMoney(v) {
        v = v.toFixed(2);
        v = v.replace(/\D/g, '');
        v = v.replace(/(\d)(\d{3})(\d{2})$/g, "$1.$2,$3");
        v = v.replace(/(\d)(\d{3})(\.)/g, "$1.$2$3");
        v = v.replace(/^(\d{1,3})(\d{2})$/g, "$1,$2");
        return v;
    }

    function corrigeMask(v) {
        v = v.replace(/\D/g, '');
        v = v.replace(/^(\d{1,})(\d{2})$/g, "$1.$2");
        return v;
    }

    function corrigeMaskPagamento(v) {
        v = v.replace(/\D/g, '');
        v = v.replace(/^(\d{1,})(\d{2})$/g, "$1.$2");
        return v;
    }
</script>