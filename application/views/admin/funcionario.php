<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Funcionários
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/funcionario'); ?>"><i class="fa fa-users"></i> Funcionários</a>
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
                <h3 class="box-title">Listando Funcionários</h3>

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
                    <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 90px;">Imagem</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($funcionario as $row):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?php echo $this->FuncionarioM->get_image_url('funcionario', $row->idfuncionario); ?>" class="img-circle" width="40px" height="40px">
                                    </td>
                                    <td class="text-left"><?php echo $row->nome; ?></td>
                                    <td class="text-left"><?php echo $row->email; ?></td>
                                    <td class="text-left"><?php echo $row->endereco; ?></td>
                                    <td class="text-left"><?php echo $row->telefone; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($row->departamento == 'V'):
                                            $row->departamento = 'Vendas';
                                            echo '<span class="label label-success">' . $row->departamento . '</span>';
                                        else:
                                            $row->departamento = 'Compras';
                                            echo '<span class="label label-primary">' . $row->departamento . '</span>';
                                        endif;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($row->ativo == 'S'):
                                            $row->ativo = "Ativo";
                                            echo '<span class="label label-success">' . $row->ativo . '</span>';
                                        else:
                                            $row->ativo = "Inativo";
                                            echo '<span class="label label-danger">' . $row->ativo . '</span>';
                                        endif;
                                        ?>
                                    </td>
                                    <td class="text-center" style="width: 120px;">
                                        <a href="<?php echo site_url('admin/funcionario/editar/' . $row->idfuncionario); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                        <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/funcionario/excluir/<?php echo $row->idfuncionario; ?>');" 
                                                class="btn btn-danger btn-sm" title="Excluir" data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-trash"></i>
                                        </button>
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