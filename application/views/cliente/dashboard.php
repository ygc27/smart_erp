<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Painel de Controle
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="<?php echo site_url('cliente/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p>Pesquisar Produtos</p>
                    </div>
                    <div class="icon" style="font-size: 45px;">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="<?php echo site_url('cliente/produto'); ?>" class="small-box-footer">
                        Visualizar <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <p> Novo Pedido</p>
                    </div>
                    <div class="icon" style="font-size: 45px;">
                        <i class="fa fa-bell"></i>
                    </div>
                    <a href="<?php echo site_url('cliente/pedido/adicionar'); ?>" class="small-box-footer">
                        Visualizar <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <p>Pedidos</p>
                    </div>
                    <div class="icon" style="font-size: 45px;">
                        <i class="fa fa-opencart"></i>
                    </div>
                    <a href="<?php echo site_url('cliente/pedido'); ?>" class="small-box-footer">
                        Visualizar <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <p>Historico de Compras</p>
                    </div>
                    <div class="icon" style="font-size: 45px;">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="<?php echo site_url('cliente/compra'); ?>" class="small-box-footer">
                        Visualizar <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Últimos pedidos</h3>
                        <!--<div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>-->
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código/Pedido</th>
                                        <th>Status/Pedido</th>
                                        <th>Status/Pagamento</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    if (!empty($pedidos)):
                                        foreach ($pedidos as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row->codigo_pedido; ?></td>
                                                <td>
                                                    <?php if ($row->status_pedido == 1): ?>
                                                        <span class="label label-warning"> Pedente</span>
                                                    <?php elseif ($row->status_pedido == 2): ?>
                                                        <span class="label label-success"> Aprovado</span>
                                                    <?php elseif ($row->status_pedido == 3):
                                                        ?>
                                                        <span class = "label label-danger"> Recusado</span>
                                                    <?php else: ?>
                                                        <span class = "label label-danger"> Cancelado</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row->status_pagamento == 1): ?>
                                                        <span class="label label-warning"> Não pago</span>
                                                    <?php else: ?>
                                                        <span class = "label label-success"> Pago</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $moeda . " " . modificaNumericValor($row->valor_total); ?></td>
                                            </tr>

                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Nenhum registro encontrado.</td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="<?php echo site_url('cliente/pedido'); ?>" class="btn btn-sm btn-default btn-flat pull-right">Visualizar todos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Últimos produtos adicionados</h3>
                        <!--<div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>-->
                    </div>
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">

                            <?php
                            $this->db->order_by('cadastro', 'desc');
                            $this->db->limit(10);
                            $produtos = $this->db->get('produto')->result();

                            if (count($produtos) > 0):
                                foreach ($produtos as $row):
                                    ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?php echo $this->ProdutoM->get_image_url('produto', $row->idproduto); ?>" alt="Produto Imagem" data-toggle="modal" data-target="#myModal" style="cursor: pointer;" onclick="showResumoModal('<?php echo $row->idproduto; ?>');" title="Visualizar">
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript::;" class="product-title"><?php echo $row->nome; ?> <span class="label label-primary pull-right"><?php echo $moeda . " " . modificaNumericValor($row->precovenda); ?></span></a>
                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <li class="text-center">Nenhum produto encontrado.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="<?php echo site_url('cliente/produto'); ?>" class="uppercase">Visualizar todos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function showResumoModal(idproduto)
    {
        var id_produto = idproduto;

        // LOADING THE AJAX MODAL
        jQuery('#modal_resumo').modal('show', {backdrop: 'true'});

        $.ajax({
            url: '<?php echo base_url(); ?>cliente/dashboard/get_resumo',
            type: 'POST',
            data: {
                id_produto: id_produto
            },
            success: function (result)
            {
                jQuery('#produto').empty().append(result);
            }
        });
    }

</script>

<div class="modal fade" id="modal_resumo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Detalhes do Produto</h4>
            </div>
            <div class="modal-body">
                <div id="produto">

                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-primary" data-dismiss="modal">Sair</a>
            </div>
        </div>
    </div>
</div>