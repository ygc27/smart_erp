<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/cliente'); ?>"><i class="fa fa-users"></i> Clientes</a>
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
                <h3 class="box-title">Listando Clientes</h3>

                <div class="pull-right">
                    <div class="tooltip-demo">
                        <a href="<?php echo site_url('admin/cliente/pendente'); ?>" title="Clientes Pendentes por Aprovação" data-toggle="tooltip" data-placement="top" class="btn btn-warning">
                            <i class="fa fa-user-plus fa-fw"></i>
                        </a>&nbsp;

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab"><i class="fa fa-user"></i> CPF</a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab"><i class="fa fa-building-o"></i> CNPJ</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 30px;">Imagem</th>
                                                        <th>Cliente</th>
                                                        <th>CPF</th>
                                                        <th>Endereço</th>
                                                        <th>Email</th>
                                                        <th>Telefone</th>
                                                        <th class="text-center">Status</th>
                                                        <th>Cadastro</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    foreach ($clientes as $row):
                                                        if ($row->ativo == 'S' && $row->tipo_perfil == 'pf'):
                                                            ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <img src="<?php echo $this->ClienteM->get_image_url('cliente', $row->idcliente); ?>" class="img-circle" width="40px" height="40px">
                                                                </td>
                                                                <td class="text-left"><?php echo $row->nome; ?></td>
                                                                <td class="text-left cpf"><?php echo $row->cpf; ?></td>
                                                                <td class="text-left"><?php echo $row->endereco; ?></td>
                                                                <td class="text-left"><?php echo $row->email; ?></td>
                                                                <td class="text-left"><?php echo $row->telefone; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($row->ativo == 'S'):
                                                                        $row->ativo = 'Ativo';
                                                                        echo '<span class="label label-success">' . $row->ativo . '</span>';
                                                                    else:
                                                                        $row->ativo = 'Inativo';
                                                                        echo '<span class="label label-danger">' . $row->ativo . '</span>';
                                                                    endif;
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $data = strtotime($row->cadastro);
                                                                    echo date('d/m/Y H:i:s', $data);
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" style="width: 120px;">
                                                                    <a href="<?php echo site_url('admin/cliente/visualizar/' . $row->idcliente); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top"><i class="fa fa-user"></i></a>&nbsp;
                                                                    <a href="<?php echo site_url('admin/cliente/editar/' . $row->idcliente); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                                                    <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/cliente/excluir/<?php echo $row->idcliente; ?>');" 
                                                                            class="btn btn-danger btn-sm" title="Excluir" data-toggle="tooltip" data-placement="top">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        endif;
                                                    endforeach;
                                                    ?>
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
                                                        <th class="text-center" style="width: 30px;">Imagem</th>
                                                        <th>Empresa</th>
                                                        <th>CNPJ</th>
                                                        <th>Endereço</th>
                                                        <th>Email</th>
                                                        <th>Telefone</th>
                                                        <th class="text-center">Status</th>
                                                        <th>Cadastro</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    foreach ($clientes as $row):
                                                        if ($row->ativo == 'S' && $row->tipo_perfil == 'pj'):
                                                            ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <img src="<?php echo $this->ClienteM->get_image_url('cliente', $row->idcliente); ?>" class="img-circle" width="40px" height="40px">
                                                                </td>
                                                                <td class="text-left"><?php echo $row->nome; ?></td>
                                                                <td class="text-left cpf"><?php echo $row->cnpj; ?></td>
                                                                <td class="text-left"><?php echo $row->endereco; ?></td>
                                                                <td class="text-left"><?php echo $row->email; ?></td>
                                                                <td class="text-left"><?php echo $row->telefone; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($row->ativo == 'S'):
                                                                        $row->ativo = 'Ativo';
                                                                        echo '<span class="label label-success">' . $row->ativo . '</span>';
                                                                    else:
                                                                        $row->ativo = 'Inativo';
                                                                        echo '<span class="label label-danger">' . $row->ativo . '</span>';
                                                                    endif;
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $data = strtotime($row->cadastro);
                                                                    echo date('d/m/Y H:i:s', $data);
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" style="width: 120px;">
                                                                    <a href="<?php echo site_url('admin/cliente/visualizar/' . $row->idcliente); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top"><i class="fa fa-user"></i></a>&nbsp;
                                                                    <a href="<?php echo site_url('admin/cliente/editar/' . $row->idcliente); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                                                    <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/cliente/excluir/<?php echo $row->idcliente; ?>');" 
                                                                            class="btn btn-danger btn-sm" title="Excluir" data-toggle="tooltip" data-placement="top">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        endif;
                                                    endforeach;
                                                    ?>
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