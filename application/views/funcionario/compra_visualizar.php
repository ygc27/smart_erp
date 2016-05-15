<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Histórico da Compra
            <small><strong>#<?php echo $codigo_compra; ?></strong></small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-money"></i> Gerenciar Compras</li>
            <li class="active">
                <a href="<?php echo site_url('funcionario/compra'); ?>"> Listar Compras</a>
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
                        <a href="<?php echo site_url('funcionario/fatura/imprimir_compra/' . $idcompra); ?>" target="_blank" class="btn btn-success" title="Imprimir" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-print"></i> 
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
                    $fornecedor = $this->db->get_where('fornecedor', array(
                                'idfornecedor' => $idfornecedor
                            ))->result();

                    foreach ($fornecedor as $row):
                        ?>
                        <strong><?php echo $row->fornecedor; ?></strong>
                        <br/>
                        <?php echo $row->cep; ?>
                        <br/>
                        <?php echo $row->endereco; ?>
                        <br/>
                        <?php echo $row->cidade . " - " . $row->uf ?><br/>
                        Telefone: <?php echo $row->telefone; ?>
                        <br/>
                        Email: <?php echo $row->email; ?>
                    <?php endforeach; ?>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Código da Compra:</b> <?php echo $codigo_compra; ?><br/>
                <b>Data da Compra:</b> <?php echo dateMySQL2BR($cadastro); ?><br/>
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
                            <th>Atributos (Nome/Quantidade)</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->db->where('idcompra', $idcompra, FALSE);
                        $itens = $this->db->get('compra_item')->result();

                        $count = 1;
                        foreach ($itens as $row):

                            $compras = json_decode($row->entrada_compras);
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->codigoproduto; ?></td>
                                <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->nome; ?></td>
                                <td><?php
                                    foreach ($compras as $valor):

                                        $nomeAtributo = $valor->atributo;
                                        $qtdeCompras = $valor->qtde;
                                        ?>
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label>
                                                    <?php echo $nomeAtributo; ?>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" class="form-control" value="<?php echo $qtdeCompras; ?>" readonly />
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                </td>
                                <td><?php echo $moeda . ' ' . modificaNumericValor($row->preco_unitario); ?></td>
                                <td><?php echo $row->quantidade; ?></td>
                                <td class="text-right">
                                    <?php
                                    echo $moeda . ' ' . modificaNumericValor($row->preco_unitario * $row->quantidade);
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

        <div class="row">
            <div class="col-md-8">
                <p class="lead">Forma de Pagamento:</p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">

                    <?php
                    $formaPagamento = $this->db->get_where('pagamento', array('idcompra' => $idcompra))->row()->forma_pagamento;

                    switch ($formaPagamento):
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
                </p>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Valor Total:</th>
                            <td class="text-right">
                                <strong>
                                    <?php
                                    $valor = $this->db->get_where('pagamento', array('idcompra' => $idcompra))->row()->valor;
                                    echo $moeda . ' ' . modificaNumericValor($valor);
                                    ?>
                                </strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>