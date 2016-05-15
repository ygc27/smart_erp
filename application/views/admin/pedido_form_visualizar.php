<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Histórico do Pedido
            <small><strong>#<?php echo $codigo_pedido; ?></strong></small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-money"></i> Gerenciar Pedidos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/pedido'); ?>"> Listar Pedidos</a>
            </li>
        </ol>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="pad margin no-print">
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Nota:</h4>
                    Clique no botão &nbsp;<i class="fa fa-print" style="color: #000;"></i>&nbsp; para imprimir a fatura.
                </div>
            </div>
        </div>
    </div>

    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> <?php echo $nome; ?>

                    <div class="pull-right no-print" style="margin-top: -10px;">
                        <a href="javascript:;" target="_blank" class="btn btn-success">
                            <i class="fa fa-print" title="Imprimir" data-toggle="tooltip" data-placement="top"></i> 
                        </a>
                    </div>
                </h2>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                De
                <address>
                    <strong><?php echo $nome; ?></strong>
                    <br/>
                    <?php
                    $endereco = explode('-', $endereco);
                    echo $endereco[0];
                    ?>
                    <br/>
                    <?php echo $endereco[1] . '-' . $endereco[2] ?>
                    <br/>
                    Telefone: <?php echo $telefone; ?>
                    <br/>
                    Email: <?php echo $email; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Para
                <address>
                    <?php
                    $fornecedor = $this->db->get_where('cliente', array(
                                'idcliente' => $idcliente
                            ))->result_array();

                    foreach ($fornecedor as $row):
                        ?>
                        <strong><?php echo $row['cliente']; ?></strong>
                        <br/>
                        <?php echo $row['cep']; ?>
                        <br/>
                        <?php echo $row['endereco']; ?>
                        <br/>
                        <?php echo $row['cidade'] . " - " . $row['uf'] ?><br/>
                        Telefone: <?php echo $row['telefone']; ?>
                        <br/>
                        Email: <?php echo $row['email']; ?>
                    <?php endforeach; ?>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Código do Pedido:</b> <?php echo $codigo_pedido; ?><br/>
                <b>Data do Pedido:</b> <?php echo dateMySQL2BR($data_cadastro); ?><br/>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código do Produto</th>
                            <th>Produtos</th>
                            <th>Atributos</th>
                            <th>Preço Unitário</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->db->where('idpedido', $idpedido, FALSE);
                        $itens = $this->db->get('pedido_item')->result();

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
                                <td><?php echo $moeda . ' ' . $row->preco_unitario; ?></td>
                                <td class="text-center"><?php echo $row->quantidade; ?></td>
                                <td class="text-right"><?php echo $moeda . ' ' . number_format($row->preco_unitario * $row->quantidade, 2, ',', '.'); ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="5"></td>
                            <td class="text-right"><strong>Valor Total:</strong></td>
                            <td class="text-right"><strong><?php echo $moeda . ' ' . $valor_total; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pagamentos</th>
                            <th>Data</th>
                            <th>Valor Total</th>
                            <th>Forma de Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $pagamento = $this->db->get_where('pagamento', array(
                                    'idpedido' => $idpedido
                                ))->result_array();
                        foreach ($pagamento as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo dateMySQL2BR($row['cadastro']); ?></td>
                                <td><?php echo $moeda . ' ' . $row['valor']; ?></td>
                                <td>
                                    <?php
                                    switch ($row['forma_pagamento']):
                                        case 1:
                                            echo '<b><i class="fa fa-money"></i> Dinheiro</b>';
                                            break;
                                        case 2:
                                            echo '<b><i class="fa fa-envelope-o"></i> Cheque</b>';
                                            break;
                                        case 3:
                                            echo '<b><i class="fa fa-credit-card"></i> Cartão</b>';
                                            break;
                                    endswitch;
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
    </section>
    <div class="clearfix"></div>
</div>