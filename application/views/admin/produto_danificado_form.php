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

        <div class="row">
            <?php echo form_open(base_url('admin/produtodanificado/salvar'), array('data-toggle' => 'validator')); ?>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <i class="fa fa-search"></i> Filtrar pelo Produto</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-3">

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">

                                    <select class="form-control select2" name="id_produto" id="id_produto" data-error="Selecione um produto" required>
                                        <option value="" selected>Selecione um produto</option>
                                        {BLC_PRODUTOS}
                                        <option value="{IDPRODUTO}">{NOMEPRODUTO}</option>
                                        {/BLC_PRODUTOS}
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome do Atributo</th>
                                            <th style="width: 50px;">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody id="atributos">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Informações Gerais</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descricao">Descrição <span class="required"></span></label>
                                <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do Produto Danificado ..." rows="10" data-error="O campo descrição é obrigatorio" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="ative">
                                    <input type="checkbox" class="minimal" name="remover_estoque" id="remover_estoque" value="S">&nbsp;&nbsp; Desconsiderar do Estoque
                                </label>
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

    function validaqtde(qtde, id) {
        var total = $('#item_' + id).val();
        if (total > qtde) {
            Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: 'Estoque máximo é de ' + qtde + ' para esse item do produto.'
                    });
            $('#item_' + id).val(qtde)
        }
    }

    jQuery(document).ready(function () {
        $("#id_produto").change(function () {

            var id_produto = $('#id_produto').val();

            $.ajax({
                url: '<?php echo base_url(); ?>admin/produtodanificado/get_atributo',
                type: 'POST',
                data: {
                    id_produto: id_produto
                },
                beforeSend: function () {
                    $("select[name='id_produto']").after('<i class="fa fa-spinner"></i>');
                },
                complete: function () {
                    $('.fa-spinner').remove();
                },
                success: function (result)
                {
                    jQuery('#atributos').empty().append(result);

                }
            });
        });
    });

</script>
