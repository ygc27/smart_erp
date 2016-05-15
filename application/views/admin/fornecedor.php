<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Fornecedor
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/fornecedor'); ?>"><i class="fa fa-truck"></i> Fornecedores</a>
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
                <h3 class="box-title">Listando Fornecedores</h3>

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
                                <th>Fornecedor</th>
                                <th>Pessoa/Contato</th>
                                <th>Endereço</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($fornecedor as $row):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?php echo $this->FornecedorM->get_image_url('fornecedor', $row->idfornecedor); ?>" class="img-circle" width="40px" height="40px">
                                    </td>
                                    <td class="text-left"><?php echo $row->fornecedor; ?></td>
                                    <td class="text-left"><?php echo $row->nome; ?></td>
                                    <td class="text-left"><?php echo $row->endereco; ?></td>
                                    <td class="text-left"><?php echo $row->email; ?></td>
                                    <td class="text-left"><?php echo $row->telefone; ?></td>
                                    <td class="text-center" style="width: 120px;">
                                        <a href="<?php echo site_url('admin/fornecedor/visualizar/' . $row->idfornecedor); ?>" class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top"><i class="fa fa-user"></i></a>&nbsp;
                                        <a href="<?php echo site_url('admin/fornecedor/editar/' . $row->idfornecedor); ?>" class="btn btn-success btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                        <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/fornecedor/excluir/<?php echo $row->idfornecedor; ?>');" 
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