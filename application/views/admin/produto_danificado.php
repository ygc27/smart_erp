<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Produtos - Produtos Danificados
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-shopping-cart"></i> Gerenciar Produtos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/produtodanificado'); ?>"> Produtos Danificados</a>
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
                <h3 class="box-title">Listando Produtos Danificados</h3>

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
                                    <th>Categoria</th>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Resumo</th>
                                    <th>Desconsiderar/Estoque</th>
                                    <th>Cadastro</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                foreach ($produto_danificado as $row):
                                    ?>
                                    <tr>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idproduto > 0):
                                                $idCategoria = $this->db->get_where('produto', array(
                                                            'idproduto' => $row->idproduto
                                                        ))->row()->idcategoria;

                                                echo $this->db->get_where('categoria', array(
                                                    'idcategoria' => $idCategoria
                                                ))->row()->nome;
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idproduto > 0):
                                                echo $this->db->get_where('produto', array(
                                                    'idproduto' => $row->idproduto
                                                ))->row()->codigoproduto;
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idproduto > 0):
                                                echo $this->db->get_where('produto', array(
                                                    'idproduto' => $row->idproduto
                                                ))->row()->nome;
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left"><?php echo $row->descricao; ?></td>
                                        <td class="text-center">
                                            <button onclick="showResumoModal('<?php echo $row->idprodutodanificado; ?>');" 
                                                    class="btn btn-info btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($row->remover_estoque == 'S'):
                                                $row->remover_estoque = 'Sim';
                                                echo ' <span class="label label-success">' . $row->remover_estoque . '</span>';
                                            else:
                                                if ($row->remover_estoque == 'N'):
                                                    $row->remover_estoque = 'Não';
                                                    echo ' <span class="label label-danger">' . $row->remover_estoque . '</span>';
                                                endif;
                                            endif;
                                            ?>
                                        </td>
                                        <td><?php echo dateMySQL2BR($row->cadastro); ?></td>
                                        <td class="text-center" style="width: 50px;">
                                            <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/produtodanificado/excluir/<?php echo $row->idprodutodanificado; ?>');" 
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

<script>
    function showResumoModal(iddanificado)
    {
        var id_danificado = iddanificado;

        // LOADING THE AJAX MODAL
        jQuery('#modal_resumo').modal('show', {backdrop: 'true'});

        $.ajax({
            url: '<?php echo base_url(); ?>admin/produtodanificado/get_resumo',
            type: 'POST',
            data: {
                id_danificado: id_danificado
            },
            success: function (result)
            {
                jQuery('#atributos').empty().append(result);
            }
        });
    }

</script>

<div class="modal fade" id="modal_resumo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Resumo</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome (Atributo)</th>
                                <th style="width:50px;">Quantidade</th>
                            </tr>
                        </thead>

                        <tbody id="atributos">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-primary" data-dismiss="modal">Sair</a>
            </div>
        </div>
    </div>
</div>