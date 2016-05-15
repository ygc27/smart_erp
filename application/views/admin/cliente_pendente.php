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
                <h3 class="box-title">Listando Clientes Pendentes X Aprovação</h3>
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
                                                        <th>Cliente</th>
                                                        <th>CPF</th>
                                                        <th>Email</th>
                                                        <th>Telefone</th>
                                                        <th class="text-center">Cadastro</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    foreach ($clientes as $row):

                                                        if ($row->ativo == 'N' && $row->tipo_perfil == 'pf'):
                                                            ?>
                                                            <tr>
                                                                <td class="text-left"><?php echo $row->nome; ?></td>
                                                                <td class="text-left cpf"><?php echo $row->cpf; ?></td>
                                                                <td class="text-left"><?php echo $row->email; ?></td>
                                                                <td class="text-left"><?php echo $row->telefone; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $data = strtotime($row->cadastro);
                                                                    echo date('d/m/Y H:i:s', $data);
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" style="width: 120px;">
                                                                    <a href="<?php echo site_url('admin/cliente/aprovar/' . $row->idcliente); ?>" class="btn btn-success btn-sm" title="Acesso ao Sistema" data-toggle="tooltip" data-placement="top">Aprovar</a>
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
                                                        <th>Empresa</th>
                                                        <th>CNPJ</th>
                                                        <th>Pessoa/Contato</th>
                                                        <th>Email</th>
                                                        <th>Telefone</th>
                                                        <th class="text-center">Cadastro</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    foreach ($clientes as $row):

                                                        if ($row->ativo == 'N' && $row->tipo_perfil == 'pj'):
                                                            ?>
                                                            <tr>
                                                                <td class="text-left"><?php echo $row->nome; ?></td>
                                                                <td class="text-left cpf"><?php echo $row->cnpj; ?></td>
                                                                <td class="text-left"><?php echo $row->pessoa_contato; ?></td>
                                                                <td class="text-left"><?php echo $row->email; ?></td>
                                                                <td class="text-left"><?php echo $row->telefone; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $data = strtotime($row->cadastro);
                                                                    echo date('d/m/Y H:i:s', $data);
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" style="width: 120px;">
                                                                    <a href="<?php echo site_url('admin/cliente/aprovar/' . $row->idcliente); ?>" class="btn btn-success btn-sm" title="Acesso ao Sistema" data-toggle="tooltip" data-placement="top">Aprovar</a>
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