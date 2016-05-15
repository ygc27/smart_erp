<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Painel de Controle
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="<?php echo site_url('funcionario/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <?php
        if ($this->session->userdata('funcionario_login')) :

            $departamento = $this->db->get_where('funcionario', array(
                        'idfuncionario' => $this->session->userdata('idusuario')
                    ))->row()->departamento;

            if ($departamento == 'V'):
                ?>

                <div class="row">
                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <p>Nova Venda</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/venda/adicionar'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-green">
                            <div class="inner">
                                <p>Visualizar Vendas</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/venda'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Mensagens</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/mensagem'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <p>Perfil</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/perfil'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- DONUT CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lucro - Despesas(Últimos 30 dias)</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <!--<div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>-->
                                <div id="pagamentos" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endif;
            if ($departamento == 'C'):
                ?>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <p>Nova Compra</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/compra/adicionar'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <p> Histórico de Compras</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/compra'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Mensagens</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/mensagem'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-blue">
                            <div class="inner">
                                <p>Perfil</p>
                            </div>
                            <div class="icon" style="font-size: 45px;">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="<?php echo site_url('funcionario/perfil'); ?>" class="small-box-footer">
                                Visualizar <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Produtos em Estoque</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="bar-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        endif;
        ?>
    </section>
</div>

<script>
    $(function () {
    "use strict";
            //BAR CHART
            var bar = new Morris.Bar({
            element: 'bar-chart',
                    resize: true,
                    data: [
<?php foreach ($produtos as $row): ?>
                        {y: '<?php echo $row->nome ?>', a: <?php echo $row->estoque; ?>},
<?php endforeach; ?>
                    ],
                    barColors: ['#00a65a'],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Estoque'],
                    hideHover: 'auto'
            });
    });
            var chart = AmCharts.makeChart("pagamentos", {
            "type": "pie",
                    "theme": "light",
                    "dataProvider": [
<?php
$data_inicio = strtotime('-29 days');
$data_inicio = date('Y-m-d', $data_inicio);
$data_fim = date("Y-m-d");
$lucro = 0;
$despesa = 0;
$this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data_inicio);
$this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data_fim);
$this->db->order_by('cadastro', 'desc');
$query = $this->db->get('pagamento')->result();

foreach ($query as $row):
    if ($row->tipo == 'Credito'):
        $lucro += $row->valor;
    endif;
    if ($row->tipo == 'Debito'):
        $despesa += $row->valor;
    endif;
endforeach;
?>
                    {
                    "title": "Lucro",
                            "value": <?php echo $lucro; ?>
                    },
                    {
                    "title": "Despesa",
                            "value": <?php echo $despesa; ?>
                    }],
                    "titleField": "title",
                    "valueField": "value",
                    "labelRadius": 20,
                    "radius": "42%",
                    "innerRadius": "60%",
                    "labelText": "[[title]]",
                    "export": {
                    "enabled": true
                    }
            });
</script>