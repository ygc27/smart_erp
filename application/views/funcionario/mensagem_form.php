<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Mensagens
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('funcionario/mensagem'); ?>"><i class="fa fa-paper-plane"></i> Mensagens</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <a href="<?php echo site_url('funcionario/mensagem/nova'); ?>" class="btn btn-primary btn-block margin-bottom">Compor Nova Mensagem</a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Caixa de Entrada</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            $usuario = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');

                            $this->db->where('remetente', $usuario);
                            $this->db->or_where('destinatario', $usuario);
                            $fio_mensagem = $this->db->get('fio_mensagem')->result();
                            foreach ($fio_mensagem as $row):
                                // Define o usuário para mostrar
                                if ($row->remetente == $usuario)
                                    $perfil = explode('-', $row->destinatario);
                                if ($row->destinatario == $usuario)
                                    $perfil = explode('-', $row->remetente);

                                $tipoPerfil = $perfil[0];

                                $usuarioId = $perfil[1];
                                $codigo_mensagem = $row->codigo_mensagem;
                                ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>funcionario/mensagem/lida/<?php echo $codigo_mensagem; ?>">
                                        <i class="fa fa-circle fa-fw text-success"></i>
                                        <?php
                                        $nome = $this->db->get_where($tipoPerfil, array('id' . $tipoPerfil => $usuarioId))->row()->nome;

                                        echo ucfirst($nome);
                                        ?>
                                        <span class="label label-primary pull-right">
                                            <?php
                                            echo ucfirst($tipoPerfil);
                                            ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{TITULO}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php echo form_open(base_url('funcionario/mensagem/salvar'), array('enctype' => 'multipart/form-data')); ?>

                        {MENSAGEM_SISTEMA_ERRO}
                        {MENSAGEM_SISTEMA_SUCESSO}

                        <div class="form-group">
                            <select name="destinatario" id="destinatario" class="form-control select2">
                                <option value="admin-1" selected>
                                    <?php
                                    $nome = $this->db->get_where('admin', array(
                                                'idadmin' => 1
                                            ))->row()->nome;

                                    echo ucfirst($nome);
                                    ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control textarea" name="mensagem" id="mensagem" rows="15" placeholder="Escreva sua mensagem..."></textarea>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
