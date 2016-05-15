<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Vendas - Listar Vendas
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-dollar"></i> Gerenciar Vendas</li>
            <li class="active">
                <a href="<?php echo site_url('admin/venda'); ?>"> Listar Vendas</a>
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <br/>
                {MENSAGEM_SISTEMA_ERRO}
                {MENSAGEM_SISTEMA_SUCESSO}
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">

                <h3 class="box-title">Listando Vendas</h3>

                <div class="pull-right">
                    <div class="tooltip-demo">
                        <a href="{URLLISTAR}" title="Listar" data-toggle="tooltip" data-placement="top" class="btn btn-primary">
                            <i class="fa fa-refresh fa-fw"></i>
                        </a>&nbsp;

                        <a href="{URLADICIONAR}" title="Novo" data-toggle="tooltip" data-placement="top" class="btn btn-primary">
                            <i class="fa fa-plus"></i> 
                        </a>
                    </div>
                </div>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $count = 1;
                                foreach ($vendas as $row):
                                    $data_cadastro = strtotime($row->data_cadastro);
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td class="text-left"><?php echo $row->codigo_venda; ?></td>
                                        <td class="text-left">
                                            <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>
                                        </td>
                                        <td class="text-left"><?php echo date('d/m/y h:m:i', $data_cadastro); ?></td>
                                        <td class="text-center" style="width: 20px;">
                                            <a href="<?php echo site_url('admin/venda/visualizar/' . $row->idvenda); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
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
