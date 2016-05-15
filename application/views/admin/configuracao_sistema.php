<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Configurações - Sistema
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-gears"></i> Configurações</li>
            <li class="active">
                <a href="<?php echo site_url('admin/sistema'); ?>">Sistema</a>
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
            <?php echo form_open(base_url('admin/sistema/salvar'), array('data-toggle' => 'validator')); ?>
            <input type="hidden" name="id" id="id" value="{id}" />

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{ACAO}</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome da Empresa <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-align-left"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nome" id="nome" value="{nome}" data-error="O campo nome é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" value="{email}" data-error="O campo email é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="email_paypal">Email Paypal <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email_paypal" id="email_paypal" value="{email_paypal}" data-error="O campo email do paypal é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="endereco">Endereço <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{endereco}" data-error="O campo endereço é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control phones" name="telefone" id="telefone" value="{telefone}" data-error="O campo telefone é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="moeda">Moeda <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="moeda" id="moeda" value="{moeda}" data-error="O campo moeda é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="imposto">% de Imposto</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-balance-scale"></i>
                                    </div>
                                    <input type="text" class="form-control" name="imposto" id="imposto" value="{imposto}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="well">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>


