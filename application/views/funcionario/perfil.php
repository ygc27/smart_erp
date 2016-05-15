<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Perfil
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('funcionario/perfil'); ?>"><i class="fa fa-user"></i> Perfil</a>
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                {MENSAGEM_SISTEMA_ERRO}
                {MENSAGEM_SISTEMA_SUCESSO}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> {ACAOPERFIL}</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open(base_url('funcionario/perfil/salvar'), array('data-toggle' => 'validator', 'enctype' => 'multipart/form-data')); ?>

                        <input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo $this->session->userdata('idusuario'); ?>" />

                        <?php
                        $this->db->where('idfuncionario', $this->session->userdata('idusuario'));
                        $query = $this->db->get('funcionario');
                        foreach ($query->result() as $row):
                            ?>

                            <div class="form-group">
                                <label for="nome">Nome <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $row->nome; ?>" data-error="O campo nome é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row->email; ?>" data-error="O campo email é obrigatorio" required />
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <label>Imagem</label>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->PerfilM->get_image_url('funcionario', $row->idfuncionario); ?>" alt="...">
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
                        <?php endforeach; ?>

                        <div class="well">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> {ACAOSENHA}</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open(base_url('funcionario/perfil/salvar_senha'), array('data-toggle' => 'validator')); ?>
                        <input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo $this->session->userdata('idusuario'); ?>" />

                        <div class="form-group">
                            <label for="senha">Senha Atual <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" data-error="O campo senha atual é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="senha">Nova Senha <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="nova_senha" id="nova_senha" data-error="O campo nova senha é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="senha">Confirme/Nova Senha <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock fa-fw"></i>
                                </div>
                                <input type="password" class="form-control" name="confirme_senha" id="confirme_senha" data-error="O campo confirme nova senha é obrigatorio" required />               
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="well">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>