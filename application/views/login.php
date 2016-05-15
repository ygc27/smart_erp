<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;"><b>Smart</b>&nbsp;ERP</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><b>Digite seus dados de acesso</b></p>

        <?php echo form_open(base_url('login/acesso'), array('data-toggle' => 'validator')); ?>

        {MENSAGEM_SISTEMA_SUCESSO}
        {MENSAGEM_SISTEMA_ERRO}

        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="email" data-error="O campo email é obrigatorio" placeholder="Email" required autofocus />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" data-error="O campo senha é obrigatorio" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-key"></i>&nbsp;Acessar</button>
            </div>
        </div>
        <?php echo form_close(); ?>
        <br/>
        <a href="<?php echo site_url('senha'); ?>" style="font-weight: bold;">Esqueci minha senha ?</a>&nbsp; <i class="fa fa-minus"></i> &nbsp;<a href="<?php echo site_url('cadastro_cliente'); ?>" style="font-weight: bold;"> Criar Nova Conta</a>
    </div>

    <!--<br/>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="active">
                    <th>Acesso</th>
                    <th>Login</th>
                    <th>Senha</th>
                    <th>Copiar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Admin</td>
                    <td>ygc_21@hotmail.com</td>
                    <td>admin!@</td>
                    <td class="text-center">
                        <i class="fa fa-copy" onclick="copiar('ygc_21@hotmail.com', 'admin!@')"
                           data-toggle="tooltip" data-placement="top" title="Copiar"></i>
                    </td>
                </tr>
                <tr>
                    <td>Funcionário/Vendas</td>
                    <td>yasmany.casanova@outlook.com</td>
                    <td>1234</td>
                    <td class="text-center">
                        <i class="fa fa-copy" onclick="copiar('yasmany.casanova@outlook.com', '1234')"
                           data-toggle="tooltip" data-placement="top" title="Copiar"></i>
                    </td>
                </tr>
                <tr>
                    <td>Funcionário/Compras</td>
                    <td>ygc19@yahoo.es</td>
                    <td>1234</td>
                    <td class="text-center">
                        <i class="fa fa-copy" onclick="copiar('ygc19@yahoo.es', '1234')"
                           data-toggle="tooltip" data-placement="top" title="Copiar"></i>
                    </td>
                </tr>
                <tr>
                    <td>Cliente</td>
                    <td>grijalba21@gmail.com</td>
                    <td>1234</td>
                    <td class="text-center">
                        <i class="fa fa-copy" onclick="copiar('grijalba21@gmail.com', '1234')"
                           data-toggle="tooltip" data-placement="top" title="Copiar"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>-->
</div>