<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Visualizar - Produto
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
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Imagem do Produto</h3>
                    </div>

                    <div class="box-body">
                        <div class="text-center">
                            <img src="<?php echo $this->ProdutoM->get_image_url('produto', $idproduto); ?>" class="img-rounded" width="150" height="150">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-left">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Informações</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Código do Produto</b></td>
                                    <td><?php echo $codigoproduto; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Produto</b></td>
                                    <td><?php echo $nome; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Modelo</b></td>
                                    <td><?php echo $modelo; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Categoria</b></td>
                                    <td><?php echo $categoria; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Subcategoria</b></td>
                                    <td><?php echo $subcategoria; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Dimensões</b></td>
                                    <td><?php echo $dimensoes . ' ' . $tipo_comprimento; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Peso</b></td>
                                    <td><?php echo $peso . ' ' . $tipo_peso; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Preço de Venda</b></td>
                                    <td><?php echo $moeda . ' ' . modificaNumericValor($precovenda); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Descrição</b></td>
                                    <td><?php echo $descricao; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>