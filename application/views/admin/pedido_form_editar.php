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
            <?php echo form_open(base_url('admin/pedido/salvar'), array('data-toggle' => 'validator')); ?>
            <input type="hidden" name="idpedido" id="idpedido" value="{idpedido}" />
            <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $idcliente; ?>" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Básicas - Pedido</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="codigo_pedido">Código do Pedido</label>

                                <input class="form-control" type="text" name="codigo_pedido" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" readonly />
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="idcliente">Cliente</label>

                                <select class="form-control select2" name="id_cliente" id="id_cliente" disabled>
                                    <option value="<?php echo $idcliente; ?>">
                                        <?php
                                        echo $this->db->get_where('cliente', array(
                                            'idcliente' => $idcliente
                                        ))->row()->nome;
                                        ?>
                                    </option>
                                </select>
                            </div>

                            <!--<div class="form-group">
                                <label class="control-label" for="data_alteracao">Data <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="data_alteracao" id="data_alteracao" placeholder="Selecione uma data" value="<?php echo date('d/m/Y'); ?>" data-error="O campo data é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>-->
                        </div>
                        <div class="col-md-6">
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
                                        <th class="text-center">Quantidade</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;

                                    foreach ($itens as $row):

                                        $pedidos = json_decode($row->entrada_pedidos);
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->codigoproduto; ?></td>
                                            <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->nome; ?></td>
                                            <td><?php
                                                foreach ($pedidos as $valor):

                                                    $nomeAtributo = $valor->atributo;
                                                    $qtdePedidos = $valor->qtde;
                                                    ?>
                                                    <div class="form-group">
                                                        <div class="col-md-9">
                                                            <label>
                                                                <?php echo $nomeAtributo; ?>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" value="<?php echo $qtdePedidos; ?>" readonly />
                                                        </div>

                                                    </div>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?php echo $moeda . ' ' . modificaNumericValor($row->preco_unitario); ?></td>
                                            <td class="text-center"><?php echo $row->quantidade; ?></td>
                                            <td>
                                                <?php
                                                echo $moeda . ' ' . modificaNumericValor($row->preco_unitario * $row->quantidade);

                                                $this->total += $row->preco_unitario * $row->quantidade;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
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
                                <option value="1" <?php echo ($status_pedido == 1) ? 'selected' : null; ?>>Pendente</option>
                                <option value="2" <?php echo ($status_pedido == 2) ? 'selected' : null; ?>>Aprovado</option>
                                <option value="3" <?php echo ($status_pedido == 3) ? 'selected' : null; ?>>Recusado</option>
                                <option value="4" <?php echo ($status_pedido == 4) ? 'selected' : null; ?>>Cancelado</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Status do Pagamento <span class="required">*</span></label>

                            <select class="form-control" name="status_pagamento" id="status_pagamento" data-error="Selecione um status" required> 
                                <option value="" selected>Selecione um status</option>
                                <option value="1" <?php echo ($status_pagamento == 1) ? 'selected' : null; ?>>Não Pago</option>
                                <option value="2" <?php echo ($status_pagamento == 2) ? 'selected' : null; ?>>Pago</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Forma de Pagamento <span class="required">*</span></label>

                            <select class="form-control" name="forma_pagamento" id="status_pagamento" data-error="Selecione um status" required disabled> 
                                <option value="" selected>Selecione forma de pagamento</option>
                                <option value="1" <?php echo ($forma_pagamento == 1) ? 'selected' : null; ?>>Dinheiro</option>
                                <option value="2" <?php echo ($forma_pagamento == 2) ? 'selected' : null; ?>>Cheque</option>
                                <option value="3" <?php echo ($forma_pagamento == 3) ? 'selected' : null; ?>>Cartão</option>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>

                        <div class="form-group">
                            <label class="control-label">Endereço - Entrega <span class="required">*</span></label>
                            <textarea class="form-control" name="endereco_entrega" id="endereco_entrega" placeholder="Endereço para entrega" rows="3" readonly><?php echo $this->db->get_where('cliente', array('idcliente' => $idcliente))->row()->endereco_entrega; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Observações</label>

                            <textarea class="form-control" name="observacoes" placeholder="Observações" rows="3"><?php echo $observacao; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <div class="tooltip-demo">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save fa-fw"></i></button>&nbsp;&nbsp;

                        <a href="{URLLISTAR}" title="Voltar" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-mail-reply-all fa-fw"></i></a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>
    // Valida Endereço Entrega
    /*jQuery(document).ready(function () {
     
     $("#endereco_entrega").blur(function () {
     
     var idcliente = $('#id_cliente').val();
     var endereco_entrega = $('#endereco_entrega').val();
     
     $.ajax({
     url: '<?php echo base_url(); ?>admin/pedido/valida_endereco',
     type: 'POST',
     data: {
     id_cliente: idcliente,
     endereco_entrega: endereco_entrega
     },
     success: function (result)
     {
     if (result != endereco_entrega) {
     Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
     {
     msg: 'Endereço de entrega diferente do cadastrado. Por favor forneça o endereço válido.'
     });
     $('#endereco_entrega').val();
     }
     }
     
     });
     });
     });*/

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
</script>
