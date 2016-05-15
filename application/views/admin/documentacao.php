<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Smart ERP | Documentação</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons-2.0.1/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/_all-skins.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
        <div class="wrapper">

            <header class="main-header">
                <?php
                $query = $this->db->get('configuracoes');
                foreach ($query->result() as $row):
                    if ($this->session->userdata('admin_login')):
                        ?>
                        <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
                            <!-- mini logo for sidebar mini 50x50 pixels -->
                            <span class="logo-mini"> 
                                <?php
                                $nome = explode(" ", $row->nome);
                                echo $nome[1];
                                ?>
                            </span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">
                                <b>
                                    <?php
                                    //echo trim(substr($row->nome, 0, 5)); 
                                    echo $nome[0];
                                    ?>
                                </b>
                                <?php
                                //echo trim(substr($row->nome, -3)); 
                                echo $nome[1];
                                ?>
                            </span>
                        </a>
                        <?php
                    endif;
                endforeach;
                ?>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-chevron-left"></i>&nbsp; Voltar</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <div class="sidebar" id="scrollspy">

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="nav sidebar-menu">
                        <li class="header">Menú</li>
                        <li class="active"><a href="#introducao"><i class="fa fa-circle-o"></i> Introdução</a></li>
                        <li><a href="#indice"><i class="fa fa-circle-o"></i> Índice de Conteúdo</a></li>
                        <li><a href="#administrador"><i class="fa fa-circle-o"></i> Perfil Administrador</a></li>
                        <li><a href="#cliente"><i class="fa fa-circle-o"></i> Perfil Cliente</a></li>
                        <li><a href="#funcionario-compras"><i class="fa fa-circle-o"></i> Perfil Funcionário de Compras</a></li>
                        <li><a href="#funcionario-vendas"><i class="fa fa-circle-o"></i> Perfil Funcionário de Vendas</a></li>
                    </ul>
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <h1>
                        Smart ERP Documentação
                        <small>Versão 1.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">Documentação</li>
                    </ol>
                </div>

                <!-- Main content -->
                <div class="content body">

                    <section id="introducao">
                        <h2 class="page-header"><a href="#introducao">Introdução</a></h2>
                        <p class="lead">
                            <b>Smart ERP Venda</b> é um sistema web para gestão empresarial com módulo de
                            venda avançado.
                        </p>
                    </section><!-- /#introducao -->


                    <!-- ============================================================= -->

                    <section id="indice">
                        <h2 class="page-header"><a href="#indice">Índice de Conteúdo</a></h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-user"></i>
                                        <h3 class="box-title">1-Perfil Administrador</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled">
                                            <li> 1.1 Painel de Controle</li>
                                            <li> 1.2 Clientes</li>
                                            <li>1.3 Fornecedores</li>
                                            <li>1.4 Funcionários</li>
                                            <li>1.5 Gerenciar Produtos
                                                <ul>
                                                    <li>1.5.1 Produtos</li>
                                                    <li>1.5.2 Código de Barra</li>
                                                    <li>1.5.3 Categoria</li>
                                                    <li>1.5.4 Subcategoria</li>
                                                    <li>1.5.5 Tipo de Atributo</li>
                                                    <li>1.5.6 Atributos</li>
                                                    <li>1.5.7 Produtos Danificados</li>
                                                </ul>
                                            </li>
                                            <li>1.6 Gerenciar Pedidos
                                                <ul>
                                                    <li>1.6.1 Listar Pedidos</li>
                                                </ul>
                                            </li>
                                            <li>1.7 Gerenciar Compras
                                                <ul>
                                                    <li>1.7.1 Listar Compras</li>
                                                </ul>
                                            </li>
                                            <li>1.8 Gerenciar Vendas
                                                <ul>
                                                    <li>1.8.1 Listar Vendas</li>
                                                </ul>
                                            </li>
                                            <li>1.9 Relatórios
                                                <ul>
                                                    <li>1.9.1 Pagamentos</li>
                                                    <li>1.9.2 Pagamentos de Clientes</li>
                                                    <li>1.9.2 Pagamentos por Fornecedor</li>
                                                </ul>
                                            </li>
                                            <li>1.10 Mensagens</li>
                                            <li>1.11 Perfil</li>
                                            <li>1.12 Configurações
                                                <ul>
                                                    <li>1.12.1 Sistema</li>
                                                    <li>1.12.2 Backup Sistema</li>
                                                </ul>
                                            </li>
                                            <li>1.13 Sair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-user"></i>
                                        <h3 class="box-title">2-Perfil Cliente</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled">
                                            <li> 2.1 Painel de Controle</li>
                                            <li> 2.2 Produtos</li>
                                            <li>2.3 Gerenciar Pedidos
                                                <ul>
                                                    <li>2.3.1 Listar Pedidos</li>
                                                </ul>
                                            </li>
                                            <li>2.4 Histórico de Compras</li>
                                            <li>2.5 Mensagens</li>
                                            <li>2.6 Perfil</li>
                                            <li>2.7 Sair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-user"></i>
                                        <h3 class="box-title">3-Perfil Funcionário de Compras</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled">
                                            <li> 3.1 Painel de Controle</li>
                                            <li>3.2 Gerenciar Compras
                                                <ul>
                                                    <li>3.2.1 Listar Compras</li>
                                                </ul>
                                            </li>
                                            <li>3.3 Mensagens</li>
                                            <li>3.4 Perfil</li>
                                            <li>3.5 Sair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <i class="fa fa-user"></i>
                                        <h3 class="box-title">4-Perfil Funcionário de Vendas</h3>
                                    </div>
                                    <div class="box-body">
                                        <ul class="list-unstyled">
                                            <li>4.1 Painel de Controle</li>
                                            <li>4.2 Gerenciar Vendas
                                                <ul>
                                                    <li>4.2.1 Listar Vendas</li>
                                                </ul>
                                            </li>
                                            <li>4.3 Mensagens</li>
                                            <li>4.4 Perfil</li>
                                            <li>4.5 Sair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <pre class="hierarchy bring-up">
    <code class="language-bash" data-lang="bash">Hierarquia de arquivos

    smart_erp/
    ├── application/
    │   ├── cache/
    │   ├── config/
    │   ├── controllers/
    │   ├── core/
    │   ├── helpers/
    │   ├── hooks/
    │   ├── language/
    │   ├── libraries/
    │   ├── log/
    │   ├── models/
    │   ├── templates/
    │   ├── third_party/
    │   ├── views/
    │   ├── .htacess
    │   ├── index.html

    ├── assets/
    │   ├── barcode/
    │   ├── css/
    │   ├── img/
    │   ├── js/
    │   ├── plugins/

    ├── system/
    │   ├── core/
    │   ├── database/
    │   ├── fonts/
    │   ├── helpers/
    │   ├── language/
    │   ├── libraries/
    │   ├── .htacess
    │   ├── index.html

    ├── uploads/
    │   ├── admin_imagem/
    │   ├── cliente_imagem/
    │   ├── fornecedor_imagem/
    │   ├── funcionario_imagem/
    │   ├── produto_imagem/

    │   ├── .htacess
    │   ├── composer.json
    │   ├── index.php

    </code>
                        </pre>
                    </section>

                    <!-- ============================================================= -->

                    <section id="administrador">
                        <h2 class="page-header"><a href="#administrador">Perfil Administrador</a></h2>
                        <p class="lead">1.1 Painel de Controle</p>
                        <ul class="bring-up">
                            <li>Visualizar o total de clientes.</li>
                            <li>Visualizar o total de pedidos pendentes.</li>
                            <li>Visualizar o total de lucro mensal.</li>
                            <li>Visualizar o total de compras mensal.</li>
                            <li>Representação gráfica dos produtos em estoque.</li>
                            <li>Representação gráfica do relatório de pagamento para exibir o lucro e despesas nos últimos 30
                                dias.</li>
                            <li>Representação gráfica do relatório de pagamento do cliente nos últimos 30 dias.</li>
                        </ul>

                        <p class="lead">1.2 Clientes</p>
                        <ul class="bring-up">
                            <li>Criar perfil do cliente.</li>
                            <li>Consulte o perfil dos clientes e visualize todas as informações.</li>
                            <li>Visualizar o histórico de pedido e compra do cliente.</li>
                            <li>Edite qualquer informação do cliente.</li>
                            <li>Excluir o perfil do cliente. (Obs. o cliente com pedidos realizados não poderá ser excluído)</li>
                        </ul>

                        <p class="lead">1.3 Fornecedores</p>
                        <ul class="bring-up">
                            <li>Criar perfil do fornecedor.</li>
                            <li>Consulte o perfil dos fornecedores e visualize todas as informações.</li>
                            <li>Visualizar o histórico de compras realizadas.</li>
                            <li>Edite qualquer informação do fornecedor.</li>
                            <li>Excluir o perfil do fornecedor. (Obs. o fornecedor com compras realizadas não poderá ser
                                excluído)</li>
                        </ul>

                        <p class="lead">1.4 Funcionários</p>
                        <ul class="bring-up">
                            <li>Criar perfil do funcionário de compras ou vendas.</li>
                            <li>Consulte o perfil dos funcionários e visualize todas as informações.</li>
                            <li>Edite qualquer informação do funcionário.</li>
                            <li>Excluir o perfil do funcionário.</li>
                        </ul>

                        <p class="lead">1.5 Gerenciar Produtos</p>
                        <ul class="bring-up">
                            <li>1.5.1 Produtos
                                <ul>
                                    <li>Adicionar um novo produto e vincular com o tipo de atributo.</li>
                                    <li>Consulte as informações dos produtos de sua empresa.</li>
                                    <li>Vincular o produto com seus respetivos atributos.</li>
                                    <li>Edite qualquer informação sobre o produto.</li>
                                    <li>Excluir o produto.</li>
                                </ul>
                            </li>
                            <li>1.5.2 Código de Barra
                                <ul>
                                    <li>O produto quando é cadastrado gera automaticamente seu respectivo código de barra o
                                        qual pode ser utilizado para identificar o produto e preencher suas informações na hora da
                                        venda.</li>
                                </ul>
                            </li>
                            <li>1.5.3 Categoria
                                <ul>
                                    <li>Adicionar as categorias que irá a ter cada produto.</li>
                                    <li>Edite as informações da categoria.</li>
                                    <li>Excluir a categoria. (Obs. a categoria vinculada a um produto não poderá ser excluída)</li>
                                </ul>
                            </li>
                            <li>1.5.4 Subcategoria
                                <ul>
                                    <li>Adicionar as subcategorias que irá a ter cada produto e relacionar com sua respectiva
                                        categoria.</li>
                                    <li>Edite as informações da subcategoria.</li>
                                    <li>Excluir a subcategoria. (Obs. a subcategoria vinculada a um produto ou vinculada a uma
                                        categoria não poderá ser excluída)</li>
                                </ul>
                            </li>
                            <li>1.5.5 Tipo de Atributo
                                <ul>
                                    <li>Adicionar os tipos de atributos que irá a ter cada produto.</li>
                                    <li>Edite as informações do tipo de atributo</li>
                                    <li>Excluir o tipo de atributo. (Obs. o tipo de atributo vinculado a um produto não poderá ser
                                        excluído).</li>
                                </ul>
                            </li>
                            <li>1.5.6 Atributos
                                <ul>
                                    <li>Adicionar os atributos que irá a ter cada produto e relacionar com seu tipo de atributo.</li>
                                    <li>Edite as informações do atributo.</li>
                                    <li>Excluir o atributo.</li>
                                </ul>
                            </li>
                            <li>1.5.7 Produtos Danificados
                                <ul>
                                    <li>Adicionar os produtos danificados e selecione quais serão os produtos que deseja
                                        desconsiderar do estoque. Ao finalizar o cadastro o mesmo será descontado do estoque atual.</li>
                                    <li>Também será possível visualizar o resumo do produto danificado.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">1.6 Gerenciar Pedidos</p>
                        <ul class="bring-up">
                            <li>1.6.1 Listar Pedidos
                                <ul>
                                    <li>Criar um pedido para um cliente em específico.</li>
                                    <li>Procurar todos os pedidos em abas separadas (Pendentes, Aprovados, Recusados,
                                        Cancelados).</li>
                                    <li>Quando um cliente realiza um pedido ele automaticamente bem como pendente. O qual
                                        passa por um processo de aprovação (para verificar se o mesmo foi pago). Se o pedido
                                        consta como pago ele pode ser alterado para status do pedido aprovado e status de
                                        pagamento como pago. Caso contrário selecione o status correto.</li>
                                    <li>O status do pedido nunca poderá ser inserido como aprovado e o status do pagamento c
                                        omo não pago. O qual exibira uma alerta informando o erro.</li>
                                    <li>Visualizar a fatura para ver o seu pedido, a qual pode ser impressa somente quando o
                                        status é pendente ou aprovado.</li>
                                    <li>Um pedido quando criado como pendente tem o prazo de um dia para efetuar o
                                        pagamento.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">1.7 Gerenciar Compras</p>
                        <ul class="bring-up">
                            <li>1.7.1 Listar Compras
                                <ul>
                                    <li>Criar uma compra para um fornecedor em específico.</li>
                                    <li>Ao concluir a compra a quantidade de produtos comprados será acrescentada ao estoque
                                        atual.</li>
                                    <li>Visualize a fatura para ver as informações da compra.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">1.8 Gerenciar Vendas</p>
                        <ul class="bring-up">
                            <li>1.8.1 Listar Vendas
                                <ul>
                                    <li>Criar uma venda para um cliente em específico.</li>
                                    <li>Ao concluir a venda a quantidade de produtos vendidos será descontada do estoque atual.</li>
                                    <li>Visualize a fatura para ver as informações da venda.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">1.9 Relatórios</p>
                        <ul class="bring-up">
                            <li>1.9.1 Pagamentos
                                <ul>
                                    <li>Visualizar o total de lucro.</li>
                                    <li>Visualizar o total de despesas.</li>
                                    <li>Escolha o intervalo de datas para visualizar o relatório de pagamentos mensal.</li>
                                </ul>
                            </li>
                            <li>1.9.2 Pagamentos de Clientes
                                <ul>
                                    <li>Escolha o intervalo de datas para visualizar o relatório de pagamentos por cliente.</li>
                                </ul>
                            </li>
                            <li>1.9.3 Pagamentos por Fornecedor
                                <ul>
                                    <li>Escolha o intervalo de datas para visualizar o relatório de pagamentos por fornecedor.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">1.10 Mensagens</p>
                        <ul class="bring-up">
                            <li>Enviar mensagem privada para clientes.</li>
                            <li>Enviar mensagem privada para funcionários de vendas e compras.</li>
                            <li>Receber respostas de mensagens de funcionários e clientes.</li>
                            <li>Responder às suas mensagens.</li>
                        </ul>

                        <p>1.11 Perfil1.10 Mensagens</p>
                        <ul class="bring-up">
                            <li>Edite as suas informações de perfil.</li>
                        </ul>

                        <p class="lead">1.12 Configurações</p>
                        <ul class="bring-up">
                            <li>1.12.1 Sistema
                                <ul>
                                    <li>Edite as informações do sistema.</li>
                                </ul>
                            </li>
                            <li>1.12.2 Backup Sistema
                                <ul>
                                    <li>Efetue o backup do sistema com um simples clique.</li>
                                </ul>
                            </li>
                        </ul>

                        <p>1.13 Sair</p>
                        <ul class="bring-up">
                            <li>Sair do sistema.</li>
                        </ul>
                    </section>

                    <!-- ============================================================= -->

                    <section id="cliente">
                        <h2 class="page-header"><a href="#cliente">Perfil Cliente</a></h2>
                        <p class="lead">2.1 Painel de Controle</p>
                        <ul class="bring-up">
                            <li>Pesquisar Produtos.</li>
                            <li>Pesquisar Pedidos.</li>
                            <li>Criar um pedido.</li>
                            <li>Visualizar Histórico de Compras.</li>
                            <li>Visualizar últimos 10 pedidos.</li>
                            <li>Visualizar os últimos 10 produtos adicionados.</li>
                        </ul>

                        <p class="lead">2.2 Produtos</p>
                        <ul class="bring-up">
                            <li>Listar todos os produtos e visualizar as informações.</li>
                        </ul>

                        <p class="lead">2.3 Gerenciar Pedidos</p>
                        <ul class="bring-up">
                            <li>2.3.1 Listar Pedidos
                                <ul>
                                    <li>Criar um pedido.</li>
                                    <li>Ao finalizar o cadastro poderá visualizar as informações do pedido e efetuar o pagamento.
                                        Lembrando que o pedido será cadastrado como pendente até confirmar o pagamento.</li>
                                    <li>Procurar todos os pedidos em abas separadas (Pendentes, Aprovados, Recusados e Cancelados).</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">2.4 Histórico de Compras</p>
                        <ul class="bring-up">
                            <li>Visualize o histórico de compras.</li>
                        </ul>

                        <p class="lead">2.5 Mensagens</p>
                        <ul class="bring-up">
                            <li>Enviar mensagem privada para administrador.</li>
                            <li>Responder às suas mensagens.</li>
                        </ul>

                        <p class="lead">2.6 Perfil</p>
                        <ul class="bring-up">
                            <li>Edite as suas informações de perfil.</li>
                        </ul>

                        <p class="lead">2.7 Sair</p>
                        <ul class="bring-up">
                            <li>Sair do sistema.</li>
                        </ul>
                    </section>


                    <!-- ============================================================= -->

                    <section id="funcionario-compras">
                        <h2 class="page-header"><a href="#funcionario-compras">Perfil Funcionário de Compras</a></h2>
                        <p class="lead">3.1 Painel de Controle</p>
                        <ul class="bring-up">
                            <li>Criar Compras.</li>
                            <li>Visualizar histórico de compras.</li>
                            <li>Visualizar mensagens.</li>
                            <li>Visualizar o Perfil.</li>
                            <li>Representação gráfica dos produtos em estoque.</li>
                        </ul>

                        <p class="lead">3.2 Produtos</p>
                        <ul class="bring-up">
                            <li>3.2.1 Listar Compras
                                <ul>
                                    <li>Criar uma compra para um fornecedor em específico.</li>
                                    <li>Ao concluir a compra a quantidade de produtos comprados será acrescentada ao estoque
                                        atual.</li>
                                    <li>Visualize a fatura para ver as informações da compra.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">3.3 Mensagens</p>
                        <ul class="bring-up">
                            <li>Enviar mensagem privada para administrador.</li>
                            <li>Responder às suas mensagens.</li>
                        </ul>

                        <p class="lead">3.4 Perfil</p>
                        <ul class="bring-up">
                            <li>Edite as suas informações de perfil.</li>
                        </ul>

                        <p class="lead">3.5 Sair</p>
                        <ul class="bring-up">
                            <li>Sair do sistema.</li>
                        </ul>
                    </section>

                    <!-- ============================================================= -->

                    <section id="funcionario-vendas">
                        <h2 class="page-header"><a href="#funcionario-vendas">Perfil Funcionário de Vendas</a></h2>

                        <p class="lead">4.1 Painel de Controle</p>
                        <ul class="bring-up">
                            <li>Criar uma venda.</li>
                            <li>Visualizar as vendas.</li>
                            <li>Visualizar mensagens.</li>
                            <li>Visualizar o Perfil.</li>
                            <li>Representação gráfica do relatório de pagamento para exibir o lucro e despesas nos últimos 30
                                dias.</li>
                        </ul>

                        <p class="lead">4.2 Gerenciar Vendas</p>
                        <ul class="bring-up">
                            <li>4.2.1 Listar Vendas
                                <ul>
                                    <li>Criar uma venda para um cliente em específico.</li>
                                    <li>Ao concluir a venda a quantidade de produtos vendidos será descontada do estoque atual.</li>
                                    <li>Visualize a fatura para ver as informações da venda.</li>
                                </ul>
                            </li>
                        </ul>

                        <p class="lead">4.3 Mensagens</p>
                        <ul class="bring-up">
                            <li>Enviar mensagem privada para administrador.</li>
                            <li>Responder às suas mensagens.</li>
                        </ul>

                        <p class="lead">4.4 Perfil</p>
                        <ul class="bring-up">
                            <li>Edite as suas informações de perfil.</li>
                        </ul>

                        <p class="lead">4.5 Sair</p>
                        <ul class="bring-up">
                            <li>Sair do sistema.</li>
                        </ul>
                    </section>

                </div><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versão</b> 1.0
                </div>
                <strong>Copyright © - 2015 á <a href="http://www.yasmanygcasanova.com.br">Yasmany G.Casanova</a></strong>
            </footer>

        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url('assets/js/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/run_prettify.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/docs.js'); ?>"></script>
    </body>
</html>