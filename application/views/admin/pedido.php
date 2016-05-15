<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Pedidos - Listar Pedidos
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
                <h3 class="box-title">Listando Pedidos</h3>

                <div class="pull-right">
                    <div class="tooltip-demo">
                        <a href="{URLLISTAR}" title="Listar" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-refresh fa-fw"></i></a>&nbsp;

                        <a href="{URLADICIONAR}" title="Novo" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab"><i class="fa fa-spinner"></i> Pendentes</a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Aprovados</a>
                                </li>
                                <li>
                                    <a href="#tab_3" data-toggle="tab"><i class="fa fa-thumbs-down"></i> Recusados</a>
                                </li>
                                <li>
                                    <a href="#tab_4" data-toggle="tab"><i class="fa fa-remove"></i> Cancelados</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Código do Pedido</th>
                                                        <th>Cliente</th>
                                                        <th>Email</th>
                                                        <th>Data de Emissão</th>
                                                        <th>Última Alteração</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $count = 1;
                                                    $this->db->order_by('data_cadastro', 'DESC');
                                                    $pedidoPendente = $this->db->get_where('pedido', array(
                                                                'status_pedido' => 1 // Pendente
                                                            ))->result();

                                                    foreach ($pedidoPendente as $row):
                                                        $data_cadastro = strtotime($row->data_cadastro);
                                                        $data_alteracao = strtotime($row->data_alteracao);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_pedido; ?></td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->email; ?>
                                                            </td>
                                                            <td class="text-left"><?php echo date('d/m/y h:m:s', $data_cadastro); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if (isset($row->data_alteracao)):
                                                                    echo date('d/m/y h:m:s', $data_alteracao);
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/pedido/visualizar/' . $row->idpedido); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>&nbsp;
                                                                <a href="<?php echo site_url('admin/pedido/editar/' . $row->idpedido); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Código do Pedido</th>
                                                        <th>Cliente</th>
                                                        <th>Email</th>
                                                        <th>Data de Emissão</th>
                                                        <th>Última Alteração</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $count = 1;
                                                    $this->db->order_by('data_cadastro', 'DESC');
                                                    $pedidoAprovado = $this->db->get_where('pedido', array(
                                                                'status_pedido' => 2 // Aprovado
                                                            ))->result();

                                                    foreach ($pedidoAprovado as $row):
                                                        $data_cadastro = strtotime($row->data_cadastro);
                                                        $data_alteracao = strtotime($row->data_alteracao);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_pedido; ?></td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->email; ?>
                                                            </td>
                                                            <td class="text-left"><?php echo date('d/m/y h:m:s', $data_cadastro); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if (isset($row->data_alteracao)):
                                                                    echo date('d/m/y h:m:s', $data_alteracao);
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/pedido/visualizar/' . $row->idpedido); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>&nbsp;
                                                                <a href="<?php echo site_url('admin/pedido/editar/' . $row->idpedido); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Código do Pedido</th>
                                                        <th>Cliente</th>
                                                        <th>Email</th>
                                                        <th>Data de Emissão</th>
                                                        <th>Última Alteração</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $count = 1;
                                                    $this->db->order_by('data_cadastro', 'DESC');
                                                    $pedidoRecusado = $this->db->get_where('pedido', array(
                                                                'status_pedido' => 3 // Recusado
                                                            ))->result();

                                                    foreach ($pedidoRecusado as $row):
                                                        $data_cadastro = strtotime($row->data_cadastro);
                                                        $data_alteracao = strtotime($row->data_alteracao);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_pedido; ?></td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->email; ?>
                                                            </td>
                                                            <td class="text-left"><?php echo date('d/m/y h:m:s', $data_cadastro); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if (isset($row->data_alteracao)):
                                                                    echo date('d/m/y h:m:s', $data_alteracao);
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/pedido/visualizar/' . $row->idpedido); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>&nbsp;
                                                                <!--<a href="<?php echo site_url('admin/pedido/editar/' . $row->idpedido); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>-->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_4">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Código do Pedido</th>
                                                        <th>Cliente</th>
                                                        <th>Email</th>
                                                        <th>Data de Emissão</th>
                                                        <th>Última Alteração</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $count = 1;
                                                    $this->db->order_by('data_cadastro', 'DESC');
                                                    $pedidoPendente = $this->db->get_where('pedido', array(
                                                                'status_pedido' => 4 // Cancelado
                                                            ))->result();

                                                    foreach ($pedidoPendente as $row):
                                                        $data_cadastro = strtotime($row->data_cadastro);
                                                        $data_alteracao = strtotime($row->data_alteracao);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_pedido; ?></td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->email; ?>
                                                            </td>
                                                            <td class="text-left"><?php echo date('d/m/y h:m:s', $data_cadastro); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if (isset($row->data_alteracao)):
                                                                    echo date('d/m/y h:m:s', $data_alteracao);
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/pedido/visualizar/' . $row->idpedido); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>&nbsp;
                                                                <!--<a href="<?php echo site_url('admin/pedido/editar/' . $row->idpedido); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>-->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
</div>
