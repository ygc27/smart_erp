<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Compras - Listar Compras
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
                <h3 class="box-title">Listando Compras</h3>

                <div class="pull-right">
                    <div class="tooltip-demo">
                        <a href="{URLLISTAR}" title="Listar" data-toggle="tooltip" data-placement="top" class="btn btn-primary">
                            <i class="fa fa-refresh fa-fw"></i>
                        </a>&nbsp;

                        <a href="{URLADICIONAR}" title="Nova Compra" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">#</th>
                                    <th>Código</th>
                                    <th>Fornecedor</th>
                                    <th class="text-center">Cadastro</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $count = 1;
                                foreach ($compras as $row):
                                    $cadastro = strtotime($row->cadastro);
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td class="text-left" style="width: 30px;"><?php echo $row->codigo_compra; ?></td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->db->get_where('fornecedor', array('idfornecedor' => $row->idfornecedor))->row()->fornecedor;
                                            ?>
                                        </td>
                                        <td class="text-center" style="width: 120px;"><?php echo date('d/m/y h:m:s', $cadastro); ?></td>
                                        <td class="text-center" style="width: 20px;">
                                            <a href="<?php echo site_url('funcionario/compra/visualizar/' . $row->idcompra); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
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
