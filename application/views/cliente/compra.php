<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Histórico de Compras
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('cliente/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('cliente/compra'); ?>"> Histórico de Compras</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listando Compras</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Código da Compra</th>
                                    <th class="text-center" style="width: 100px;">Data</th>
                                    <th class="text-center" style="width: 20px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($compras as $row):
                                    $data_cadastro = strtotime($row->data_cadastro);
                                    ?>
                                    <tr>
                                        <td class="text-left"><?php echo $row->codigo_venda; ?></td>
                                        <td class="text-center"><?php echo date('d/m/y h:m:s', $data_cadastro); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('cliente/compra/visualizar/' . $row->idvenda); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
