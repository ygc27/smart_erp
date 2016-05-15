<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Produtos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('cliente/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('cliente/produto'); ?>"> Produtos</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listando Produtos</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Imagem</th>
                                    <th>Código do Produto</th>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Preço de Venda</th>
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
                                        <td class="text-left"><?php echo $row->codigoproduto; ?></td>
                                        <td class="text-left"><?php echo $row->nome; ?></td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idcategoria > 0)
                                                echo $this->db->get_where('categoria', array('idcategoria' => $row->idcategoria))->row()->nome;
                                            ?>
                                        </td>
                                        <td class="text-left"><?php echo $moeda . ' ' . modificaNumericValor($row->precovenda); ?></td>

                                        <td class="text-center" style="width: 80px;">
                                            <a href="<?php echo site_url('cliente/produto/visualizar/' . $row->idproduto); ?>" class="btn btn-primary btn-sm" title="Visualizar" data-toggle="tooltip" data-placement="top"><i class="fa fa-search"></i></a>
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
