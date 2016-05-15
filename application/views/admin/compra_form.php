<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Compras - {ACAO}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-money"></i> Gerenciar Compras</li>
            <li class="active">
                <a href="<?php echo site_url('admin/compra'); ?>"> Listar Compras</a>
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
            <?php echo form_open(base_url('admin/compra/salvar'), array('data-toggle' => 'validator')); ?>
            <input type="hidden" name="idcompra" id="idcompra" value="{idcompra}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Básicas - Compra</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4>Instruções</h4>
                                <ul>
                                    <li>Verificar as informações antes de criar a compra. A compra uma vez realizada não poderá ser alterada.</li>
                                    <li>Você pode adicionar vários produtos de qualquer valor durante a compra.</li>
                                    <li>O número entre parênteses no campo atributos representa a quantidade em estoque do produto.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="codigo_compra">Código da Compra</label>

                                <input class="form-control" type="text" name="codigo_compra" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" readonly />
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="id_fornecedor">Fornecedor <span class="required">*</span></label>

                                <select class="form-control select2" name="id_fornecedor" id="id_fornecedor" data-error="Selecione um fornecedor" required>
                                    <option value="" selected>Selecione um fornecedor</option>
                                    {BLC_FORNECEDOR}
                                    <option value="{ID_FORNECEDOR}">{NOMEFORNECEDOR}</option>
                                    {/BLC_FORNECEDOR}
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
                                        <th>Nome</th>
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

            <div class="col-md-6"></div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Pagamento</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
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
                                    <input type="text" class="form-control text-right money" name="pagamento" id="pagamento" value="" placeholder="Digite o valor do pagamento" data-error="O campo pagamento é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
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
                                    <button type="submit" class="btn btn-success">Nova compra</button>
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
            url: '<?php echo base_url(); ?>admin/compra/get_produto/' + idproduto + '/' + total_linha,
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
                jQuery('#entrada_pedido').append(result);
                calcular_valor_total();
                calcular_compra(idproduto);
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

    function calcular_compra(entry_number, idprodestoque) {

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
            }
        });
        quantidade = parseInt(quantidade);

        $("#quantidade_" + entry_number).val(quantidade);

        precocompra = $("#precocompra_" + entry_number).val();
        precocompra = corrigeMask(precocompra);

        total = Number(quantidade * precocompra);
        total = maskMoney(total);

        $("#valor_total_" + entry_number).html(total);
        calcular_valor_total();
    }

    function calcular_valor_total() {

        // calculo subtotal
        valorTotal = 0;
        $("#idproduto > option").each(function () {

            if ($('#idproduto_' + this.value).val() > 0) {
                if (this.value != '') {
                    valoritem = corrigeMask($("#valor_total_" + this.value).html());
                    valorTotal += Number(valoritem);
                }
            }
        });

        valorTotal = maskMoney(valorTotal);
        $("#valor_total").attr("value", valorTotal);
    }

    function excluir_linha(entry_number) {

        $("#idproduto").val('');

        $("#entry_row_" + entry_number).remove();

        for (var i = entry_number; i < total_linha; i++) {

            $("#serial_" + (i + 1)).attr("id", "serial_" + i);
            $("#serial_" + (i)).html(i);

            $("#quantidade_" + (i + 1)).attr("id", "quantidade_" + i);
            $("#quantidade_" + (i)).attr({onkeyup: "calcular_compra(" + i + ")", onclick: "calcular_compra(" + i + ")"});

            $("#precocompra_" + (i + 1)).attr("id", "precocompra_" + i);
            $("#precocompra_" + (i)).attr({onkeyup: "calcular_compra(" + i + ")", onclick: "calcular_compra(" + i + ")"});

            $("#excluir_btn_" + (i + 1)).attr("id", "excluir_btn_" + i);
            $("#excluir_btn_" + (i)).attr("onclick", "excluir_linha(" + i + ")");

            $("#entry_row_" + (i + 1)).attr("id", "entry_row_" + i);
        }

        total_linha--;
        calcular_valor_total();
        $('#id_fornecedor').select2("val", "");
        $('#idproduto').select2("val", "");
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