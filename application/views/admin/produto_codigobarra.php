<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Gerenciar Produtos - Código de Barra
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-shopping-cart"></i> Gerenciar Produtos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/codigobarra'); ?>"> Código de Barra</a>
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Código de Barras</h3>

                <div class="pull-right">
                    <a href="<?php echo site_url('admin/codigos/imprimir'); ?>" data-toggle="tooltip" class="btn btn-success" data-original-title="Imprimir" target="_blank">
                        <i class="fa fa-print"></i>
                    </a>
                </div>

            </div>
            <div class="box-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Código do Produto</th>
                                <th>Nome</th>
                                <th class="text-center">Código de Barra</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($codigos_barra as $row):
                                ?>

                                <tr>
                                    <td class="text-left"><?php echo $row->codigoproduto; ?></td>
                                    <td class="text-left"><?php echo $row->nome; ?></td>
                                    <td class="text-center">
                                        <img src="<?php echo base_url(); ?>admin/codigobarra/criar/<?php echo $row->codigoproduto ?>" style="height: 60px;">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>
