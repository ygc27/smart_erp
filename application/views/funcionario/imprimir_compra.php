<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Smart ERP | Fatura Compra</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons-2.0.1/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body onload="window.print();">
        <div class="wrapper">
            <section class="invoice">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> <?php echo $nome; ?>
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
                                    <th class="text-center">Quantidade</th>
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
                                                    <label>
                                                        <?php echo $nomeAtributo . ' (' . $qtdeCompras . ')'; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?php echo $moeda . ' ' . modificaNumericValor($row->preco_unitario); ?></td>
                                        <td class="text-center"><?php echo $row->quantidade; ?></td>
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
                            <br/><br/>
                            <?php
                            $dados_bancarios = $this->db->get_where('fornecedor', array(
                                        'idfornecedor' => $idfornecedor
                                    ))->result();

                            foreach ($dados_bancarios as $row):
                                ?>
                                <b>Banco:</b> <?php echo strtoupper($row->banco); ?>
                                &nbsp;&nbsp;
                                <b>Agencia:</b> <?php echo $row->agencia; ?>
                                &nbsp;&nbsp;
                                <b>Conta:</b> <?php echo $row->conta; ?>
                            <?php endforeach; ?>
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
        </div>
        <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
    </body>
</html>
