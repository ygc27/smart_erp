<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Mensagens Lidas
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('cliente/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('cliente/mensagem'); ?>"><i class="fa fa-paper-plane"></i> Mensagens</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo site_url('cliente/mensagem/nova'); ?>" class="btn btn-primary btn-block margin-bottom">Compor Nova Mensagem</a>
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
                                    <a href="<?php echo base_url(); ?>cliente/mensagem/lida/<?php echo $codigo_mensagem; ?>">
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
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{TITULO}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        {MENSAGEM_SISTEMA_ERRO}
                        {MENSAGEM_SISTEMA_SUCESSO}

                        <?php
                        $mensagem = $this->db->get_where('mensagem', array('codigo_mensagem' => $codigo_mensagem))->result();
                        foreach ($mensagem as $row):

                            $remetente = explode('-', $row->remetente);
                            $remetentePerfil = $remetente[0];
                            $remetenteId = $remetente[1];
                            ?>
                            <div class="mailbox-read-info" style="border-left: 3px solid #3c8dbc;border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">

                                <?php
                                $nome = $this->db->get_where($remetentePerfil, array('id' . $remetentePerfil => $remetenteId))->row()->nome;

                                $data = strtotime($row->cadastro);
                                ?>

                                <a href="#" class="user-header">
                                    <img src="<?php echo $this->PerfilM->get_image_url($remetentePerfil, $remetenteId); ?>" class="img-circle" height="40" width="40"/>
                                </a>

                                <span class="text-muted">&nbsp;<?php echo ucfirst($nome); ?></span> 

                                <span class="mailbox-read-time pull-right"><?php echo date("d/m/Y h:i:s", $data); ?></span>

                                <br/><br/>

                                <h5><?php echo $row->mensagem; ?></h5>
                            </div><!-- /.mailbox-read-info -->
                        <?php endforeach; ?>
                        <br/>
                        <?php echo form_open(base_url('cliente/mensagem/responder/' . $codigo_mensagem), array('enctype' => 'multipart/form-data')); ?>
                        <div class = "form-group">
                            <textarea class = "form-control textarea" name = "mensagem" id = "mensagem" rows = "15" placeholder = "Responder mensagem..."></textarea>
                        </div>

                        <div class = "box-footer">
                            <div class = "pull-right">
                                <button type = "submit" class = "btn btn-primary"><i class = "fa fa-envelope-o"></i> Enviar</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
