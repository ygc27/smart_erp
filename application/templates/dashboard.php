<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart ERP | Painel de Controle</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/dashboard.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Select 2 -->
        <link href="<?php echo base_url('assets/plugins/select2/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons-2.0.1/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Fileupload -->
        <link href="<?php echo base_url('assets/css/jasny-bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Morris charts -->
        <link href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <!-- DATA TABLES -->
        <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme -->
        <link href="<?php echo base_url('assets/css/skins/skin-blue.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- DataPicker -->
        <link href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Bootstrap  WYSIHTML5 -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/Lobibox.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!--<script>$.noConflict();</script>-->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap 3.3.4 -->
        <script src="<?php echo base_url('assets/js/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap Validator -->
        <script src="<?php echo base_url('assets/js/bootstrapValidator.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>
        <!-- Fileupload -->
        <script src="<?php echo base_url('assets/js/fileinput.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jasny-bootstrap.min.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/js/app.min.js'); ?>" type="text/javascript"></script>
        <!-- AmCharts 3.18.0 -->
        <script src="<?php echo base_url('assets/plugins/amcharts/amcharts.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/pie.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/themes/light.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/serial.js'); ?>"></script>

    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">
                <?php
                $query = $this->db->get('configuracoes');
                foreach ($query->result() as $row):
                    if ($this->session->userdata('admin_login')):
                        ?>
                        <!-- Logo -->
                        <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
                            <!-- mini logo for sidebar mini 50x50 pixels -->
                            <span class="logo-mini"><?php
                                //echo trim(substr($row->nome, -3));
                                $nome = explode(" ", $row->nome);
                                echo $nome[1];
                                ?>
                            </span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">
                                <b>
                                    <?php
                                    echo $nome[0];
                                    ?>
                                </b>
                                <?php
                                echo $nome[1];
                                ?>
                            </span>
                        </a>
                    <?php elseif ($this->session->userdata('cliente_login')):
                        ?>
                        <!-- Logo -->
                        <a href="<?php echo site_url('cliente/dashboard'); ?>" class="logo">
                            <!-- mini logo for sidebar mini 50x50 pixels -->
                            <span class="logo-mini"><?php
                                $nome = explode(" ", $row->nome);
                                echo $nome[1];
                                ?>
                            </span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">
                                <b>
                                    <?php
                                    echo $nome[0];
                                    ?>
                                </b>
                                <?php
                                echo $nome[1];
                                ?>
                            </span>
                        </a>

                    <?php elseif ($this->session->userdata('funcionario_login')):
                        ?>
                        <!--Logo -->
                        <a href = "<?php echo site_url('funcionario/dashboard'); ?>" class = "logo">
                            <!--mini logo for sidebar mini 50x50 pixels -->
                            <span class = "logo-mini"><?php
                                $nome = explode(" ", $row->nome);
                                echo $nome[1];
                                ?>
                            </span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">
                                <b>
                                    <?php
                                    echo $nome[0];
                                    ?>
                                </b>
                                <?php
                                echo $nome[1];
                                ?>
                            </span>
                        </a>
                        <?php
                    endif;
                endforeach;
                ?>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <?php if ($this->session->userdata('tipo_login') == 'admin'): ?>

                                <li>
                                    <a href="<?php echo site_url('admin/documentacao/'); ?>">
                                        <i class="fa fa-file-o"></i> Documentação
                                    </a>

                                </li>

                                <!-- Messages: style can be found in dropdown.less-->
                                <li class="dropdown messages-menu">
                                    <?php
                                    // Total de mensagens não lidas
                                    $total_mensagem = 0;
                                    $usuario = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');

                                    $this->db->where('remetente', $usuario);
                                    $this->db->or_where('destinatario', $usuario);
                                    $fio_mensagem = $this->db->get('fio_mensagem')->result();

                                    foreach ($fio_mensagem as $row):
                                        $mensagens_nao_lidas = $this->MensagemM->contador_mensagem($row->codigo_mensagem);
                                        $total_mensagem += $mensagens_nao_lidas;
                                    endforeach;
                                    ?>

                                    <!-- Menu toggle button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-envelope-o"></i>
                                        <?php if ($total_mensagem > 0): ?>
                                            <span class="label label-success">
                                                <?php echo $total_mensagem; ?>
                                            </span>
                                        <?php endif; ?>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <?php if ($total_mensagem > 0): ?>
                                            <li class="header">Você tem <?php echo $total_mensagem; ?> mensagens</li>
                                        <?php endif; ?>
                                        <li>
                                            <!-- inner menu: contains the messages -->
                                            <ul class="menu">

                                                <?php
                                                $usuario = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');

                                                $this->db->where('remetente', $usuario);
                                                $this->db->or_where('destinatario', $usuario);
                                                $this->db->order_by('cadastro', 'desc');
                                                $fio_mensagem = $this->db->get('fio_mensagem')->result();

                                                foreach ($fio_mensagem as $row):
                                                    // Define o usuário para mostrar
                                                    if ($row->remetente == $usuario)
                                                        $perfil = explode('-', $row->destinatario);
                                                    if ($row->destinatario == $usuario)
                                                        $perfil = explode('-', $row->remetente);
                                                    $tipoPerfil = $perfil[0];
                                                    $usuarioId = $perfil[1];

                                                    $mensagem_nao_lidas = $this->MensagemM->contador_mensagem($row->codigo_mensagem);
                                                    if ($mensagem_nao_lidas == 0)
                                                        continue;

                                                    $query = $this->db->get_where('mensagem', array('codigo_mensagem' => $row->codigo_mensagem))->row();
                                                    $mensagem = $query->mensagem;
                                                    $cadastro = $query->cadastro;
                                                    $cadastro = strtotime($cadastro);
                                                    ?>

                                                    <li><!-- start message -->
                                                        <a href="<?php echo base_url(); ?>admin/mensagem/lida/<?php echo $row->codigo_mensagem; ?>">
                                                            <div class="pull-left">

                                                                <img src="<?php echo $this->PerfilM->get_image_url($tipoPerfil, $usuarioId); ?>" class="img-circle" alt="User Image" />
                                                            </div>
                                                            <!-- Message title and timestamp -->
                                                            <h4>
                                                                <?php
                                                                $nome = $this->db->get_where($tipoPerfil, array('id' . $tipoPerfil => $usuarioId))->row()->nome;

                                                                echo substr($nome, 0, 12);
                                                                ?>
                                                                <small><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date('d/m/Y h:i:s', $cadastro); ?></small>
                                                            </h4>
                                                            <!-- The message -->
                                                            <p><?php echo substr($mensagem, 0, 50); ?></p>
                                                        </a>
                                                    </li><!-- end message -->
                                                <?php endforeach; ?>
                                            </ul><!-- /.menu -->
                                        </li>
                                        <li class="footer"><a href="<?php echo site_url('admin/mensagem'); ?>">Ver todas as mensagens</a></li>
                                    </ul>
                                </li><!-- /.messages-menu -->
                            <?php endif; ?>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"><i class="fa fa-user"></i>&nbsp; 
                                        <?php
                                        if ($this->session->userdata('admin_login')):
                                            $admin = $this->db->get_where('admin', array(
                                                        'idadmin' => $this->session->userdata('idusuario')
                                                    ))->row()->nome;
                                            echo 'Administrador:' . ' ' . ucwords($admin);
                                        endif;
                                        if ($this->session->userdata('cliente_login')):
                                            $cliente = $this->db->get_where('cliente', array(
                                                        'idcliente' => $this->session->userdata('idusuario')
                                                    ))->row()->nome;
                                            echo 'Cliente:' . ' ' . ucwords($cliente);
                                        endif;
                                        if ($this->session->userdata('funcionario_login')):

                                            $departamento = $this->db->get_where('funcionario', array(
                                                        'idfuncionario' => $this->session->userdata('idusuario')
                                                    ))->row()->departamento;

                                            $funcionario = $this->db->get_where('funcionario', array(
                                                        'idfuncionario' => $this->session->userdata('idusuario')
                                                    ))->row()->nome;

                                            if ($departamento == 'C'):
                                                $departamento = 'Compras';
                                                echo 'Funcionário(a) de ' . $departamento . ':' . ' ' . ucwords($funcionario);
                                            endif;
                                            if ($departamento == 'V'):
                                                $departamento = 'Vendas';
                                                echo 'Funcionário(a) de ' . $departamento . ':' . ' ' . ucwords($funcionario);
                                            endif;
                                        endif;
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">

                                    <?php
                                    if ($this->session->userdata('admin_login')) :

                                        $this->db->where('idadmin', $this->session->userdata('idusuario'));
                                        $query = $this->db->get('admin');
                                        foreach ($query->result() as $row):
                                            ?>
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="<?php echo $this->PerfilM->get_image_url('admin', $row->idadmin); ?>" class="img-circle" alt="Admin Imagem" />
                                                <p>
                                                    <?php echo ucfirst($row->nome); ?>
                                                    <small><b>Membro desde: <?php echo dateMySQL2BR($row->cadastro); ?></b></small>
                                                </p>
                                            </li>
                                        <?php endforeach; ?>
                                        <!-- Menu Body -->

                                        <li class="user-body">
                                            <div class="col-xs-6 text-left">
                                                <a href="<?php echo site_url('admin/mensagem'); ?>"><i class="fa fa-envelope-o"></i>&nbsp;Mensagens</a>
                                            </div>
                                            <div class="col-xs-6 text-left">
                                                <a href="<?php echo site_url('admin/sistema'); ?>"><i class="fa fa-cogs"></i>&nbsp;Sistema</a>
                                            </div>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo site_url('admin/perfil'); ?>" class="btn bg-navy margin"><i class="fa fa-user"></i>&nbsp;Perfil</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo site_url('login/logout'); ?>" class="btn bg-navy margin"><i class="fa fa-sign-out"></i>&nbsp;Sair</a>
                                            </div>
                                        </li>
                                        <?php
                                    endif;
                                    if ($this->session->userdata('cliente_login')):

                                        $this->db->where('idcliente', $this->session->userdata('idusuario'));
                                        $query = $this->db->get('cliente');
                                        foreach ($query->result() as $row):
                                            ?>
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="<?php echo $this->ClienteM->get_image_url('cliente', $row->idcliente); ?>" class="img-circle" alt="Cliente Imagem" />
                                                <p>
                                                    <?php echo ucfirst($row->nome); ?>
                                                    <small><b>Membro desde: <?php echo dateMySQL2BR($row->cadastro); ?></b></small>
                                                </p>
                                            </li>
                                        <?php endforeach; ?>
                                        <!-- Menu Body -->

                                        <li class="user-body">
                                            <div class="col-xs-6 text-left">
                                                <a href="<?php echo site_url('cliente/mensagem'); ?>"><i class="fa fa-envelope-o"></i>&nbsp;Mensagens</a>
                                            </div>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo site_url('cliente/perfil'); ?>" class="btn bg-navy margin"><i class="fa fa-user"></i>&nbsp;Perfil</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo site_url('login/logout'); ?>" class="btn bg-navy margin"><i class="fa fa-sign-out"></i>&nbsp;Sair</a>
                                            </div>
                                        </li>
                                        <?php
                                    endif;
                                    if ($this->session->userdata('funcionario_login')):

                                        $this->db->where('idfuncionario', $this->session->userdata('idusuario'));
                                        $query = $this->db->get('funcionario');
                                        foreach ($query->result() as $row):
                                            ?>

                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="<?php echo $this->FuncionarioM->get_image_url('funcionario', $row->idfuncionario); ?>" class="img-circle" alt="Funcionario Imagem" />
                                                <p>
                                                    <?php echo ucfirst($row->nome); ?>
                                                    <small><b>Membro desde: <?php echo dateMySQL2BR($row->cadastro); ?></b></small>
                                                </p>
                                            </li>
                                        <?php endforeach; ?>
                                        <!-- Menu Body -->

                                        <li class="user-body">
                                            <div class="col-xs-6 text-left">
                                                <a href="<?php echo site_url('funcionario/mensagem'); ?>"><i class="fa fa-envelope-o"></i>&nbsp;Mensagens</a>
                                            </div>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo site_url('funcionario/perfil'); ?>" class="btn bg-navy margin"><i class="fa fa-user"></i>&nbsp;Perfil</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo site_url('login/logout'); ?>" class="btn bg-navy margin"><i class="fa fa-sign-out"></i>&nbsp;Sair</a>
                                            </div>
                                        </li>
                                        <?php
                                    endif;
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">

                            <?php
                            if ($this->session->userdata('admin_login')):
                                $this->db->where('idadmin', $this->session->userdata('idusuario'));
                                $query = $this->db->get('admin');
                                foreach ($query->result() as $row):
                                    ?>
                                    <img src="<?php echo $this->PerfilM->get_image_url('admin', $row->idadmin); ?>" class="img-circle" alt="Admin Imagem" />
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php
                            if ($this->session->userdata('cliente_login')):
                                $this->db->where('idcliente', $this->session->userdata('idusuario'));
                                $query = $this->db->get('cliente');
                                foreach ($query->result() as $row):
                                    ?>
                                    <img src="<?php echo $this->ClienteM->get_image_url('cliente', $row->idcliente); ?>" class="img-circle" alt="Cliente Imagem" />
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php
                            if ($this->session->userdata('funcionario_login')):
                                $this->db->where('idfuncionario', $this->session->userdata('idusuario'));
                                $query = $this->db->get('funcionario');
                                foreach ($query->result() as $row):
                                    ?>
                                    <img src="<?php echo $this->FuncionarioM->get_image_url('funcionario', $row->idfuncionario); ?>" class="img-circle" alt="Cliente Imagem" />
                                    <?php
                                endforeach;
                            endif;
                            ?>         
                        </div>
                        <div class="pull-left info">
                            <!-- Status -->
                            <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('admin_login')) : ?>
                        <!-- Sidebar Menu -->
                        <ul class="sidebar-menu">
                            <li class="header">Menú</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li class="<?php if ($pagina_nome == 'dashboard') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/dashboard'); ?>">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Painel de Controle</span>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'cliente') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/cliente'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span>Clientes</span>
                                    <small class="label pull-right bg-green">
                                        <?php
                                        echo $this->db->count_all_results('cliente');
                                        ?>
                                    </small>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'fornecedor') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/fornecedor'); ?>">
                                    <i class="fa fa-truck"></i>
                                    <span>Fornecedores</span>
                                    <small class="label pull-right bg-green">
                                        <?php
                                        echo $this->db->count_all_results('fornecedor');
                                        ?>
                                    </small>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'funcionario') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/funcionario'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span>Funcionários</span>
                                    <small class="label pull-right bg-blue">
                                        <?php
                                        echo $this->db->count_all_results('funcionario');
                                        ?>
                                    </small>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'produto' || $pagina_nome == 'codigo-barra' || $pagina_nome == 'categoria' || $pagina_nome == 'subcategoria' || $pagina_nome == 'produto-danificado' || $pagina_nome == 'tipo-atributo' || $pagina_nome == 'atributo') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-shopping-cart"></i> <span>Gerenciar Produtos</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'produto') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/produto'); ?>">
                                            <i class="fa fa-circle-o"></i> Produtos
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'codigo-barra') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/codigobarra'); ?>">
                                            <i class="fa fa-circle-o"></i> Código de Barra
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'categoria') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/categoria'); ?>">
                                            <i class="fa fa-circle-o"></i> Categoria
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'subcategoria') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/subcategoria'); ?>">
                                            <i class="fa fa-circle-o"></i> Subcategoria
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'tipo-atributo') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/tipoatributo'); ?>">
                                            <i class="fa fa-circle-o"></i> Tipo Atributo
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'atributo') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/atributo'); ?>">
                                            <i class="fa fa-circle-o"></i> Atributos
                                        </a>
                                    </li>
                                    <li class="<?php if ($pagina_nome == 'produto-danificado') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/produtodanificado'); ?>">
                                            <i class="fa fa-circle-o"></i> Produtos Danificados
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php if ($pagina_nome == 'listar-pedido') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-bell"></i> <span>Gerenciar Pedidos</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'listar-pedido') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/pedido'); ?>">
                                            <i class="fa fa-circle-o"></i> Listar Pedidos
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php if ($pagina_nome == 'historico-compra') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-money"></i> <span>Gerenciar Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'historico-compra') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/compra'); ?>">
                                            <i class="fa fa-circle-o"></i> Listar Compras
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php if ($pagina_nome == 'historico-venda') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-dollar"></i> <span>Gerenciar Vendas</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'historico-venda') echo 'active'; ?>"><a href="<?php echo site_url('admin/venda'); ?>"><i class="fa fa-circle-o"></i> Listar Vendas</a></li>
                                </ul>
                            </li>
                            <li class="<?php if ($pagina_nome == 'relatorio-pagamento' || $pagina_nome == 'relatorio-cliente' || $pagina_nome == 'relatorio-fornecedor') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-bar-chart"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'relatorio-pagamento') echo 'active'; ?>"><a href="<?php echo site_url('admin/relatorio/pagamento'); ?>"><i class="fa fa-circle-o"></i> Pagamentos</a></li>
                                    <li class="<?php if ($pagina_nome == 'relatorio-cliente') echo 'active'; ?>"><a href="<?php echo site_url('admin/relatorio/cliente'); ?>"><i class="fa fa-circle-o"></i> Pagamentos de Clientes</a></li>
                                    <li class="<?php if ($pagina_nome == 'relatorio-fornecedor') echo 'active'; ?>"><a href="<?php echo site_url('admin/relatorio/fornecedor'); ?>"><i class="fa fa-circle-o"></i> Pagamentos por Fornecedor</a></li>
                                </ul>
                            </li>
                            <li class="<?php if ($pagina_nome == 'mensagem') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/mensagem'); ?>">
                                    <i class="fa fa-paper-plane"></i>
                                    <span>Mensagens</span>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'perfil') echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/perfil'); ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>

                            <li class="<?php if ($pagina_nome == 'sistema') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-gears"></i> <span>Configurações</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'sistema') echo 'active'; ?>">
                                        <a href="<?php echo site_url('admin/sistema'); ?>">
                                            <i class="fa fa-circle-o"></i> Sistema
                                        </a>
                                    </li>
                                    <li>
                                        <!--<a href="<?php echo site_url('admin/sistema/backup'); ?>">
                                            <i class="fa fa-circle-o"></i> Backup Sistema
                                        </a>-->
                                        <a href="javascript:;" onclick="toastr.info('Recurso desabilitado para demostração.');">
                                            <i class="fa fa-circle-o"></i> Backup Sistema
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo site_url('login/logout'); ?>">
                                    <i class="fa fa-sign-out"></i>
                                    <span>Sair</span>
                                </a>
                            </li>
                        </ul><!-- /.sidebar-menu -->
                        <?php
                    endif;

                    if ($this->session->userdata('cliente_login')):
                        ?>
                        <!-- Sidebar Menu -->
                        <ul class="sidebar-menu">
                            <li class="header">Menú</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li class="<?php if ($pagina_nome == 'dashboard') echo 'active'; ?>">
                                <a href="<?php echo site_url('cliente/dashboard'); ?>">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Painel de Controle</span>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'produto') echo 'active'; ?>">
                                <a href="<?php echo site_url('cliente/produto'); ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Produtos</span>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'listar-pedido') echo 'active'; ?> treeview">
                                <a href="javascript:;"><i class="fa fa-bell"></i> <span>Gerenciar Pedidos</span> <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li class="<?php if ($pagina_nome == 'listar-pedido') echo 'active'; ?>">
                                        <a href="<?php echo site_url('cliente/pedido'); ?>">
                                            <i class="fa fa-circle-o"></i> Listar Pedidos
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="<?php if ($pagina_nome == 'historico-compra') echo 'active'; ?>">
                                <a href="<?php echo site_url('cliente/compra'); ?>">
                                    <i class="fa fa-dollar"></i>
                                    <span>Histórico de Compras</span>
                                </a>
                            </li>

                            <li class="<?php if ($pagina_nome == 'mensagem') echo 'active'; ?>">
                                <a href="<?php echo site_url('cliente/mensagem'); ?>">
                                    <i class="fa fa-paper-plane"></i>
                                    <span>Mensagens</span>
                                </a>
                            </li>
                            <li class="<?php if ($pagina_nome == 'perfil') echo 'active'; ?>">
                                <a href="<?php echo site_url('cliente/perfil'); ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('login/logout'); ?>">
                                    <i class="fa fa-sign-out"></i>
                                    <span>Sair</span>
                                </a>
                            </li>
                        </ul><!-- /.sidebar-menu -->
                    <?php endif; ?>

                    <?php
                    if ($this->session->userdata('funcionario_login')) :

                        $departamento = $this->db->get_where('funcionario', array(
                                    'idfuncionario' => $this->session->userdata('idusuario')
                                ))->row()->departamento;

                        if ($departamento == 'V'):
                            ?>
                            <!-- Sidebar Menu -->
                            <ul class="sidebar-menu">
                                <li class="header">Menú</li>
                                <!-- Optionally, you can add icons to the links -->
                                <li class="<?php if ($pagina_nome == 'dashboard') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/dashboard'); ?>">
                                        <i class="fa fa-dashboard"></i> 
                                        <span>Painel de Controle</span>
                                    </a>
                                </li>
                                <li class="<?php if ($pagina_nome == 'historico-venda') echo 'active'; ?> treeview">
                                    <a href="javascript:;"><i class="fa fa-shopping-cart"></i> <span>Gerenciar Vendas</span> <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li class="<?php if ($pagina_nome == 'historico-venda') echo 'active'; ?>">
                                            <a href="<?php echo site_url('funcionario/venda'); ?>">
                                                <i class="fa fa-circle-o"></i> Listar Venda
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="<?php if ($pagina_nome == 'mensagem') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/mensagem'); ?>">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Mensagens</span>
                                    </a>
                                </li>
                                <li class="<?php if ($pagina_nome == 'perfil') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/perfil'); ?>">
                                        <i class="fa fa-user"></i>
                                        <span>Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('login/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Sair</span>
                                    </a>
                                </li>
                            </ul><!-- /.sidebar-menu -->
                            <?php
                        endif;
                        if ($departamento == 'C'):
                            ?>
                            <!-- Sidebar Menu -->
                            <ul class="sidebar-menu">
                                <li class="header">Menú</li>
                                <!-- Optionally, you can add icons to the links -->
                                <li class="<?php if ($pagina_nome == 'dashboard') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/dashboard'); ?>">
                                        <i class="fa fa-dashboard"></i> 
                                        <span>Painel de Controle</span>
                                    </a>
                                </li>
                                <li class="<?php if ($pagina_nome == 'historico-compra') echo 'active'; ?> treeview">
                                    <a href="javascript:;"><i class="fa fa-money"></i> <span>Gerenciar Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li class="<?php if ($pagina_nome == 'historico-compra') echo 'active'; ?>">
                                            <a href="<?php echo site_url('funcionario/compra'); ?>">
                                                <i class="fa fa-circle-o"></i> Listar Compra
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="<?php if ($pagina_nome == 'mensagem') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/mensagem'); ?>">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Mensagens</span>
                                    </a>
                                </li>
                                <li class="<?php if ($pagina_nome == 'perfil') echo 'active'; ?>">
                                    <a href="<?php echo site_url('funcionario/perfil'); ?>">
                                        <i class="fa fa-user"></i>
                                        <span>Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('login/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Sair</span>
                                    </a>
                                </li>
                            </ul><!-- /.sidebar-menu -->
                            <?php
                        endif;
                    endif;
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            {CONTEUDO}

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    Versão 1.0
                </div>
                <strong>Copyright &copy; - 2015 á <a href="http://www.yasmanygcasanova.com.br/" target="_blank">Yasmany G.Casanova</a></strong>
            </footer>

        </div><!-- ./wrapper -->

        <!-- iCheck 1.0.1 -->
        <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/pwstrength.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mask.js'); ?>"></script>
        <!-- bootstrap-wysihtml5 -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo base_url('assets/js/raphael-min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js'); ?>" type="text/javascript"></script>
        <!-- DatePicker -->
        <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/lobibox.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/toastr.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
        <!---- DELETE MODAL -->
        <script>

            function showDeleteModal(delete_url) {
                // LOADING THE AJAX MODAL
                $('#modal_delete').modal('show', {backdrop: 'true'});
                $("#delete_link").attr("href", delete_url);
            }

            // Jasny Bootstrap | Fileinput
            if ($.isFunction($.fn.fileinput)) {
                $(".fileinput").fileinput();
            }

        </script>

        <div class="modal fade" id="modal_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Tem certeza que deseja excluir este registro?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger m-b-0">
                            <h5><i class="fa fa-info-circle"></i> Informações removidas não podem ser recuperadas !!!</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-sm btn-primary" data-dismiss="modal">Sair</a>
                        <a href="#" id="delete_link" class="btn btn-sm btn-danger">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>