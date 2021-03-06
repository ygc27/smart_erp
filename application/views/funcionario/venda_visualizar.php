<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Histórico da Venda
            <small><strong>#<?php echo $codigo_venda; ?></strong></small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-money"></i> Gerenciar Vendas</li>
            <li class="active">
                <a href="<?php echo site_url('funcionario/venda'); ?>"> Listar Vendas</a>
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
                        <a href="<?php echo site_url('funcionario/fatura/imprimir_venda/' . $idvenda); ?>" target="_blank" class="btn btn-success" title="Imprimir" data-toggle="tooltip" data-placement="top">
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
            </div>
            <div class="col-sm-4 invoice-col">
                Para
                <address>
                    <?php
                    $cliente = $this->db->get_where('cliente', array(
                                'idcliente' => $idcliente
                            ))->result();

                    foreach ($cliente as $row):
                        ?>
                        <strong><?php echo $row->nome; ?></strong>
                        <br />
                        Cep: <?php echo $row->cep_entrega; ?>
                        <br />
                        Endereço: <?php echo $row->endereco_entrega; ?>
                        <br />
                        Nº: <?php echo $row->numero_entrega; ?>
                        <br />
                        Complemento: <?php echo $row->complemento_entrega; ?>
                        <br />
                        Bairro: <?php echo $row->bairro_entrega; ?>
                        <br />
                        <?php echo $row->cidade_entrega . " - " . $row->uf_entrega; ?><br/>
                        Telefone: <?php echo $row->telefone; ?>
                        <br />
                        Email: <?php echo $row->email; ?>
                    <?php endforeach; ?>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Código da Venda:</b> <?php echo $codigo_venda; ?><br/>
                <b>Data da Venda:</b> <?php echo dateMySQL2BR($data_cadastro); ?><br/>
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
                        $this->db->where('idvenda', $idvenda, FALSE);
                        $itens = $this->db->get('venda_item')->result();

                        $count = 1;
                        foreach ($itens as $row):

                            $vendas = json_decode($row->entrada_vendas);
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->codigoproduto; ?></td>
                                <td><?php echo $this->db->get_where('produto', array('idproduto' => $row->idproduto))->row()->nome; ?></td>
                                <td><?php
                                    foreach ($vendas as $valor):

                                        $nomeAtributo = $valor->atributo;
                                        $qtdeVendas = $valor->qtde;
                                        ?>
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label>
                                                    <?php echo $nomeAtributo; ?>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" class="form-control" value="<?php echo $qtdeVendas; ?>" readonly />
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                </td>
                                <td><?php echo $moeda . ' ' . modificaNumericValor($row->preco_unitario); ?></td>
                                <td class="text-center"><?php echo $row->quantidade; ?></td>
                                <td class="text-right">
                                    <?php
                                    echo $moeda . ' ' . modificaNumericValor($row->preco_unitario * $row->quantidade);

                                    $this->total += $row->preco_unitario * $row->quantidade;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="5"></td>
                            <td class="text-right"><strong>Subtotal:</strong></td>
                            <td class="text-right">
                                <strong>
                                    <?php echo $moeda . ' ' . modificaNumericValor($this->total); ?>
                                </strong>
                            </td>
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
                                    'idvenda' => $idvenda
                                ))->result();
                        foreach ($pagamento as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo dateMySQL2BR($row->cadastro); ?></td>
                                <td><?php echo $moeda . ' ' . modificaNumericValor($row->valor); ?></td>
                                <td>
                                    <?php
                                    switch ($row->forma_pagamento):
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
        <br/>
        <div class="row" style="background-color: #f4f4f4;">
            <div class="col-md-2" style="padding-top: 5px;">
                <small><strong>Subtotal</strong></small>
                <br/>
                <strong style="font-size: 18px;"><?php echo $moeda . ' ' . modificaNumericValor($this->total); ?></strong>
            </div>
            <div class="col-md-1" style="padding: 15px; margin-top: 10px;">
                <i class="fa fa-plus"></i>
            </div>

            <div class="col-md-2">
                <br/>
                <strong style="font-size: 18px;"><?php echo $imposto; ?><small>&nbsp;<strong>% Imposto</strong></small></strong>
            </div>

            <div class="col-md-1" style="padding: 15px; margin-top: 10px;">
                <i class="fa fa-minus"></i>
            </div>

            <div class="col-md-2 text-left">
                <br/>
                <strong style="font-size: 18px;"><?php echo $desconto; ?><small>&nbsp;<strong>% Desconto</strong></small></strong>
            </div>

            <div class="col-md-4" style="background-color: #001f3f; color: #fff; padding: 15px;">
                <strong>Valor Total</strong>
                <br/>
                <strong style="font-size: 18px;"><?php echo $moeda . ' ' . modificaNumericValor($valor_total); ?></strong>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>