<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Mensagens
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/mensagem'); ?>"><i class="fa fa-paper-plane"></i> Mensagens</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <a href="{URLADICIONAR}" class="btn btn-primary btn-block margin-bottom">Compor Nova Mensagem</a>
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
                                // define o usuário
                                if ($row->remetente == $usuario)
                                    $perfil = explode('-', $row->destinatario);
                                if ($row->destinatario == $usuario)
                                    $perfil = explode('-', $row->remetente);

                                $tipoPerfil = $perfil[0];
                                $usuarioId = $perfil[1];
                                $codigo_mensagem = $row->codigo_mensagem;
                                $mensagem_nao_lidas = $this->MensagemM->contador_mensagem($row->codigo_mensagem);
                                ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/mensagem/lida/<?php echo $codigo_mensagem; ?>">
                                        <i class="fa fa-circle fa-fw text-success"></i>
                                        <?php
                                        echo $this->db->get_where($tipoPerfil, array('id' . $tipoPerfil => $usuarioId))->row()->nome;

                                        if ($mensagem_nao_lidas > 0):
                                            echo '<span class="badge label-success">' . $mensagem_nao_lidas . '</span>';
                                        endif;
                                        ?>
                                        <span class="label label-primary pull-right">
                                            <?php
                                            switch ($tipoPerfil):
                                                case 'cliente':
                                                    echo "Cliente";
                                                    break;
                                                case 'funcionario':
                                                    echo "Funcionário";
                                                    break;
                                            endswitch;
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
                        <h3 class="box-title">Mensagens</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Buscar ..." />
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div style="width:100%; text-align:center;padding:100px;color: #3c8dbc;">
                            <i class="fa fa-envelope fa-4x"></i>
                            <p class="text-center text-muted" style="font-size: 14px;">Selecione uma mensagem na <strong>Caixa de Entrada</strong> para ler</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
