<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Produtos - Produtos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-shopping-cart"></i> Gerenciar Produtos</li>
            <li class="active">
                <a href="<?php echo site_url('admin/produto'); ?>"> Produtos</a>
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
                <h3 class="box-title">Listando Produtos</h3>

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
                                    <th>Imagem</th>
                                    <th style="width: 20px;">Atributos</th>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Preço Compra</th>
                                    <th>Preço Venda</th>
                                    <th class="text-center">Atributos/Qtde</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                foreach ($produtos as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?php echo $this->ProdutoM->get_image_url('produto', $row->idproduto); ?>" class="img-rounded" width="40px" height="40px">
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/produto/atributos/' . $row->idproduto); ?>" class="btn btn-info btn-sm" title="Vincular Atributos" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-list"></i>
                                            </a>
                                        </td>
                                        <td class="text-left"><?php echo $row->codigoproduto; ?></td>
                                        <td class="text-left"><?php echo $row->nome; ?></td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idcategoria > 0)
                                                echo $this->db->get_where('categoria', array('idcategoria' => $row->idcategoria))->row()->nome;
                                            ?>
                                        </td>
                                        <td class="text-left"><?php echo $moeda . ' ' . modificaNumericValor($row->precocompra); ?></td>
                                        <td class="text-left"><?php echo $moeda . ' ' . modificaNumericValor($row->precovenda); ?></td>
                                        <td class="text-left">
                                            <div class="form-group">
                                                <?php
                                                $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($row->idproduto);

                                                foreach ($atributosProduto as $atributos):
                                                    ?>
                                                <span style="padding-right: 10px;"><?php echo $atributos->nome; ?></span>
                                                    
                                                        <?php
                                                        if ($atributos->quantidade <= 5)
                                                            echo '<span class="label label-danger" title="Estoque Baixo" data-toggle="tooltip" data-placement="top">' . $atributos->quantidade . '</span>'; 
                                                        else
                                                            echo '<span class="label label-success">' . $atributos->quantidade . '</span>';
                                                        ?>
                                                  
                                                    <br/>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td class="text-center" style="width: 80px;">
                                            <a href="<?php echo site_url('admin/produto/editar/' . $row->idproduto); ?>" class="btn btn-primary btn-sm" title="Editar" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>&nbsp;
                                            <button onclick="showDeleteModal('<?php echo base_url(); ?>admin/produto/excluir/<?php echo $row->idproduto; ?>');" 
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
