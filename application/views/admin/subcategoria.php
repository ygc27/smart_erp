<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Produtos - Subcategoria
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-shopping-cart"></i> Gerenciar Produtos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/subcategoria'); ?>"> Subcategoria</a>
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
                <h3 class="box-title">Listando Subcategoria</h3>

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
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($subcategoria as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row->nome; ?></td>
                                        <td>
                                            <?php
                                            if ($row->idcategoria > 0)
                                                echo $this->db->get_where('categoria', array('idcategoria' => $row->idcategoria))->row()->nome;
                                            ?>
                                        </td>
                                        <td><?php echo $row->descricao; ?></td>
                                        <td class="text-center" style="width: 80px;">
                                            <a href="<?php echo site_url('admin/subcategoria/editar/' . $row->idsubcategoria); ?>" class="btn btn-primary btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                            <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/subcategoria/excluir/<?php echo $row->idsubcategoria; ?>');" 
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
        </div>
    </section>
</div>
