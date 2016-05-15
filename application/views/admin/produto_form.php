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
                <a href="<?php echo site_url('admin/produto'); ?>"> Produtos - {ACAO}</a>
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
            <?php echo form_open(base_url('admin/produto/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>
            <input type="hidden" name="idproduto" id="idproduto" value="{idproduto}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Geral</h3>
                    </div>

                    <div class="box-body">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nome">Produto <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-text-width fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nome" id="nome" data-error="O campo nome é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição <span class="required"></span></label>
                                <textarea class="form-control textarea" name="descricao" id="descricao" placeholder="Descrição do Produto ..."></textarea>
                            </div>

                            <label>Imagem</label>
                            <div class="form-group">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="http://placehold.it/200x150" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">Selecione imagem</span>
                                            <span class="fileinput-exists">Alterar</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigoproduto">Código do Produto</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-code-working"></i>
                                    </div>
                                    <input type="text" class="form-control" name="codigoproduto" id="codigoproduto" value="{codigoproduto}" readonly />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="idfornecedor">Fornecedor <span class="required">*</span></label>
                                <select name="idfornecedor" id="idfornecedor" class="form-control select2" data-error="Selecione um fornecedor" required>
                                    <option value="">Selecione um fornecedor</option>
                                    {BLC_FORNECEDORES}
                                    <option value="{IDFORNECEDOR}">{FORNECEDOR}</option>
                                    {/BLC_FORNECEDORES}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="idcategoria">Categoria <span class="required">*</span></label>
                                <select name="idcategoria" id="idcategoria" class="form-control select2" data-error="Selecione uma categoria" required>
                                    <option value="">Selecione uma categoria</option>
                                    {BLC_CATEGORIAS}
                                    <option value="{IDCATEGORIA}">{NOMECATEGORIA}</option>
                                    {/BLC_CATEGORIAS}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="idsubcategoria">SubCategoria <span class="required">*</span></label>
                                <select name="idsubcategoria" id="idsubcategoria" class="form-control select2" data-error="Selecione uma subcategoria" required>
                                    <option value="">Selecione uma subcategoria</option>
                                    {BLC_SUBCATEGORIAS}
                                    <option value="{IDSUBCATEGORIA}">{NOMESUBCATEGORIA}</option>
                                    {/BLC_SUBCATEGORIAS}
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="modelo">Modelo <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-text-width fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="modelo" id="modelo" data-error="O campo modelo é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="dimensoes">Dimensões</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-text-width fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="dimensoes" id="dimensoes" placeholder="(AxLxP)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="tipo_comprimento">Tipo de Comprimento</label>
                                <select name="tipo_comprimento" id="tipo_comprimento" class="form-control select2">
                                    <option value="">Selecione um tipo de comprimento</option>

                                    <option value="cm">Centímetro</option>
                                    <option value="mm">Milímetro</option>
                                    <option value="in">Polegada</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="peso">Peso</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-balance-scale fa-fw"></i>
                                    </div>
                                    <input type="text" class="form-control" name="peso" id="peso">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="tipo_peso">Tipo de Peso</label>
                                <select name="tipo_peso" id="tipo_peso" class="form-control select2">
                                    <option value="">Selecione um tipo de peso</option>

                                    <option value="kg">Kilograma</option>
                                    <option value="gr">Grama</option>
                                    <option value="lb">Libra</option>
                                    <option value="oz">Onça</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="precocompra">Preco de Compra <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input type="text" class="form-control money" name="precocompra" id="precocompra" data-error="O campo preço de compra é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="precovenda">Preço de Venda <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input type="text" class="form-control money" name="precovenda" id="precovenda" data-error="O campo preço de venda é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Atributos</h3>
                    </div>

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="idtipoatributo">Tipo de Atributo <span class="required">*</span></label>
                                <select name="idtipoatributo" id="idtipoatributo" class="form-control select2" data-error="Selecione um tipo de atributo" required>
                                    <option value="">Selecione um tipo de atributo</option>
                                    {BLC_TIPOATRIBUTO}
                                    <option value="{IDTIPOATRIBUTO}">{NOMETIPOATRIBUTO}</option>
                                    {/BLC_TIPOATRIBUTO}
                                </select>
                                <div class="help-block with-errors"></div>
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

<script>
    // Valida Nome
    $("#nome").change(function () {

        var nome = $('#nome').val();

        $.ajax({
            url: '<?php echo base_url(); ?>admin/produto/get_valida_nome',
            type: 'POST',
            data: {
                nome: nome
            },
            success: function (result)
            {
                if (result == 1) {
                    Lobibox.alert('error', //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Este produto já está cadastrado."
                            });
                }
            }
        });
    });
</script>