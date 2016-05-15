<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;"><b>Smart</b>&nbsp;ERP</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><b>Recuperação de Senha</b></p>

        <?php echo form_open(base_url('senha/nova'), array('data-toggle' => 'validator')); ?>

        {MENSAGEM_SISTEMA_ERRO}
        {MENSAGEM_SISTEMA_SUCESSO}

        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-error="O campo email é obrigatorio" placeholder="Email" required autofocus />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
            <label><a href="<?php echo site_url('login'); ?>">Fazer login</a></label>
        </div>   

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-mail-forward fa-fw"></i>&nbsp;Enviar nova senha</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>