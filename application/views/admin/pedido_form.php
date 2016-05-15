<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Pedidos - {ACAO}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-bell"></i> Gerenciar Pedidos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/pedido'); ?>"> Listar Pedidos</a>
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
            <?php echo form_open(base_url('admin/pedido/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>
            <input type="hidden" name="idpedido" id="idpedido" value="{idpedido}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Básicas - Pedido</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4>Instruções</h4>
                                <ul>
                                    <li>Verificar os produtos adicionados antes de criar o pedido. O produto que foi adicionado não pode ser editado mais tarde, mas outras informações são editáveis.
                                        Você pode adicionar vários produtos em um único pedido.
                                    </li>
                                    <li>O número entre parênteses no campo atributos representa a quantidade em estoque do produto.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="codigo_pedido">Código do Pedido</label>

                                <input class="form-control" type="text" name="codigo_pedido" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" readonly />
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
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>-->
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Adicionar Produtos para Compra</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <select onchange="return adicionar_produto(this.value)" class="form-control select2" name="idproduto" id="idproduto" data-error="Selecione um produto" required>
                                    <option value="" selected>Adicionar Produtos</option>
                                    {BLC_PRODUTOS}
                                    <option value="{IDPRODUTO}">{NOMEPRODUTO}</option>
                                    {/BLC_PRODUTOS}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
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
                                <tbody id="entrada_pedido">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Adicionais</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label class="control-label">Status do Pedido <span class="required">*</span></label>

                            <select class="form-control" name="status_pedido" id="status_pedido" data-error="Selecione um status" required>
                                <option value="" selected>Selecione um status</option>
                                <option value="1">Pendente</option>
                                <option value="2">Aprovado</option>
                                <option value="3">Recusado</option>
                                <option value="4">Cancelado</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Status do Pagamento <span class="required">*</span></label>
                            <div class="">
                                <select class="form-control" name="status_pagamento" id="status_pagamento" data-error="Selecione um status" required>
                                    <option value="" selected>Selecione um status</option>
                                    <option value="1">Não Pago</option>
                                    <option value="2">Pago</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Endereço - Entrega <span class="required">*</span></label>

                            <textarea class="form-control" name="endereco_entrega" id="endereco_entrega" rows="3" readonly></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observações</label>

                            <textarea class="form-control" name="observacoes" placeholder="Observações" rows="3"></textarea>
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
                                    <input type="text" class="form-control text-right" name="valor_total" id="valor_total" value="" />
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="pagamento" class="col-sm-4 control-label">Pagamento</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right money" name="pagamento" id="pagamento" value="" onkeyup="return calcular_alterar_valor()" placeholder="Digite o valor do pagamento" data-error="O campo pagamento é obrigatorio" required />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="alterar" class="col-sm-4 control-label">Troco</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-right" id="troco_valor" value="" />
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
                                        <option value="3">Cartão</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Novo pedido</button>
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

<script type="text/javascript">

    var total_linha = 0;
    function adicionar_produto(idproduto) {

        total_linha++;

        // Verifica se produto ja existe
        if ($('#idproduto_' + idproduto).val()) {
            Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Produto já foi inserido no pedido"
                    });

            $('#idproduto_' + idproduto).closest('tr').css("background-color", "#2196f3");
            return;
        }

        $.ajax({
            url: '<?php echo base_url(); ?>admin/pedido/get_produto/' + idproduto + '/' + total_linha,
            beforeSend: function () {
                $("select[name='idproduto']").after('<i class="fa fa-spinner"></i>');
                if (idproduto == '') {
                    $('.fa-spinner').remove();
                }
            },
            complete: function () {
                $('.fa-spinner').remove();
            },
            success: function (result)
            {
                $('#entrada_pedido').append(result);

                calcular_valor_total();
                calcular_pedido(idproduto);
                iniciar();
            }
        });
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
                url: '<?php echo base_url(); ?>admin/pedido/get_desconto',
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

    // Valida Endereço Entrega
    jQuery(document).ready(function () {

        $("#id_cliente").change(function () {

            var idcliente = $('#id_cliente').val();
            //var endereco_entrega = $('#endereco_entrega').val();

            $.ajax({
                url: '<?php echo base_url(); ?>admin/pedido/valida_endereco',
                type: 'POST',
                data: {
                    id_cliente: idcliente
                            //endereco_entrega: endereco_entrega
                },
                success: function (result)
                {
                    jQuery('#endereco_entrega').val(result);
                }
            });
        });
    });

    // Valida status pedido
    jQuery(document).ready(function () {

        $("#status_pedido, #status_pagamento").change(function () {

            var status_pedido = $('#status_pedido').val();
            var status_pagamento = $('#status_pagamento').val();

            $.ajax({
                url: '<?php echo base_url(); ?>admin/pedido/valida_pedido',
                type: 'POST',
                data: {
                    status_pedido: status_pedido,
                    status_pagamento: status_pagamento
                },
                success: function (result)
                {
                    if (status_pedido == 1 && status_pagamento == 2) {
                        Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                                {
                                    msg: 'Status do pagamento será válido quando' + '\n' + 'o status do pedido seja aprovado.'
                                });
                        $('#status_pedido').val('');
                        $('#status_pagamento').val('');
                    }
                    if (status_pedido == 2 && status_pagamento == 1) {
                        Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                                {
                                    msg: 'Status do pagamento será válido quando' + '\n' + 'o status do pedido seja aprovado.'
                                });
                        $('#status_pedido').val('');
                        $('#status_pagamento').val('');
                    }
                    if (status_pedido == 3 && status_pagamento == 2) {
                        Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                                {
                                    msg: 'Status do pagamento será válido quando' + '\n' + 'o status do pedido seja aprovado.'
                                });
                        $('#status_pedido').val('');
                        $('#status_pagamento').val('');
                    }
                    if (status_pedido == 4 && status_pagamento == 2) {
                        Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                                {
                                    msg: 'Status do pagamento será válido quando' + '\n' + 'o status do pedido seja aprovado.'
                                });
                        $('#status_pedido').val('');
                        $('#status_pagamento').val('');
                    }
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

        $("#idproduto > option").each(function () {

            if (this.value == entry_number) {
                var hiddenProd = $("#prod_" + entry_number + '_' + idprodestoque).val();
                var hiddenQtde = $("#qtde_" + entry_number + '_' + idprodestoque).val();

                hiddenQtde = parseInt(hiddenQtde);
                if (hiddenQtde > hiddenProd) {
                    quantidade = quantidade - parseInt(hiddenQtde) + parseInt(hiddenProd);
                    $("#qtde_" + entry_number + '_' + idprodestoque).val(hiddenProd);

                    Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: 'Estoque máximo é de ' + hiddenProd + ' para esse item do produto.'
                            });
                }
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

    function calcular_valor_total() {
        subtotal = 0;

        $("#idproduto > option").each(function () {

            if ($('#idproduto_' + this.value).val() > 0) {
                if (this.value != '') {
                    valoritem = corrigeMask($("#valor_total_" + this.value).html());
                    subtotal += Number(valoritem);
                }
            }
        });

        // calculo valor total
        percentagem_desconto = Number($("#percentagem_desconto").val());
        percentagem_imposto = Number($("#percentagem_imposto").val());

        subtotal = subtotal - (subtotal * (percentagem_desconto / 100));
        valor_total = subtotal + (subtotal * (percentagem_imposto / 100));

        subtotal = maskMoney(subtotal);
        valor_total = maskMoney(valor_total);

        $("#subtotal").attr("value", subtotal);
        $("#valor_total").attr("value", valor_total);
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
        $('#id_cliente').select2("val", "");
        $('#idproduto').select2("val", "");
        $("#valor_restante").attr("value", 0);
        $("#percentagem_desconto").val("");
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
            //$("#pagamento_liquido").attr("value", valor_liquido);
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

