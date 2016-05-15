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

        <div class="row">
            <?php echo form_open(base_url('admin/subcategoria/salvar'), array('data-toggle' => 'validator')); ?>
            <input type="hidden" name="idsubcategoria" id="idsubcategoria" value="{idsubcategoria}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Subcategoria - {ACAO}</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nome">Nome <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-text-width fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nome" id="nome" value="{nome}" data-error="O campo nome é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">

                                <label class="control-label" for="categoria">Categoria <span class="required">*</span></label>
                                <select name="idcategoria" id="idcategoria" class="form-control select2" data-error="Selecione uma categoria" required>
                                    <option value="">Selecione uma categoria</option>
                                    {BLC_CATEGORIAS}
                                    <option value="{IDCATEGORIA}" {sel_idpai}>{NOMECATEGORIA}</option>
                                    {/BLC_CATEGORIAS}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição <span class="required"></span></label>
                                <textarea class="form-control textarea" name="descricao" id="descricao" placeholder="Descrição da Subcategoria ...">{descricao}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="well">
                    <div class="tooltip-demo">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save fa-fw"></i></button>&nbsp;&nbsp;

                        <a href="{URLLISTAR}" title="Voltar" data-toggle="tooltip" data-placement="top" class="btn btn-primary"><i class="fa fa-mail-reply-all fa-fw"></i></a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
