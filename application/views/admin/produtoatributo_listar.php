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
                <a href="<?php echo site_url('admin/produto'); ?>"> Produtos - Vincular Atributos</a>
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
                <h3 class="box-title" style="margin-top: 5px;"> Atributos do Produto: {NOME}</h3>
                <div class="pull-right">
                    <a href="{URLLISTAR}" title="Listar produtos" class="btn btn-primary" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div>

            <?php echo form_open(base_url('admin/produto/salvaatributo'), array('role' => 'form')); ?>
            <div class="box-body">
                <input type="hidden" name="idproduto" value="{IDPRODUTO}">

                <h4 class="text-green">Atributos Vinculados</h4>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome (Atributo)</th>
                                <th style="width:50px;">Quantidade</th>
                                <th class="text-center">Remover</th>
                            </tr>
                        </thead>

                        {BLC_SEMVINCULADOS}
                        <tr>
                            <td colspan="3" class="text-center">Não há atributos vinculados.</td>
                        </tr>
                        {/BLC_SEMVINCULADOS}

                        {BLC_VINCULADOS}
                        <tr>
                            <td>{DESCRICAO}</td>
                            <td>
                                <input type="text" class="form-control" name="produto[{IDPRODUTOESTOQUE}][quantidade]" value="{QUANTIDADE}">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" class="minimal" name="produto[{IDPRODUTOESTOQUE}][remover]" value="S">
                            </td>
                        </tr>
                        {/BLC_VINCULADOS}
                    </table>
                </div>

                <h4 class="text-info">Atributos Disponíveis</h4>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome (Atributo)</th>
                                <th style="width:50px;">Quantidade</th>
                            </tr>
                        </thead>

                        {BLC_SEMDISPONIVEIS}
                        <tr>
                            <td colspan="2">Não há atributos disponíveis para este produto.</td>
                        </tr>
                        {/BLC_SEMDISPONIVEIS}
                        {BLC_DISPONIVEIS}
                        <tr>
                            <td>{DESCRICAO}</td>
                            <td>
                                <input type="text" class="form-control estoque" name="atributo[{IDATRIBUTO}][quantidade]" value="">
                            </td>
                        </tr>
                        {/BLC_DISPONIVEIS}
                    </table>
                </div>
                <br/>
                <div class="well">
                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Salvar">
                        <i class="fa fa-save fa-fw"></i>
                    </button>&nbsp;&nbsp;
                    <a href="{URLLISTAR}" title="Voltar" data-toggle="tooltip" data-placement="top" class="btn btn-primary">
                        <i class="fa fa-mail-reply-all fa-fw"></i>
                    </a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
