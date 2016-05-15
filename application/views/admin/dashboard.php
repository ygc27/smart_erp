<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Painel de Controle
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 style="font-size: 20px;"> 
                            <?php
                            echo $this->db->count_all_results('cliente');
                            ?>
                        </h3>
                        <p>Total de Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion-person"></i>
                    </div>
                    <a href="<?php echo site_url('admin/cliente'); ?>" class="small-box-footer">
                        Visualizar Clientes <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">

                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 style="font-size: 20px;">
                            <?php
                            $this->db->like('status_pedido', 1);
                            $this->db->from('pedido');
                            echo $this->db->count_all_results();
                            ?>
                        </h3>
                        <p>Pedidos Pendentes</p>
                    </div>
                    <div class="icon">
                        <i class="ion-android-notifications-none"></i>
                    </div>
                    <a href="<?php echo site_url('admin/pedido'); ?>" class="small-box-footer">
                        Visualizar Pedidos <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 style="font-size: 20px;"><?php echo $moeda . " " . modificaNumericValor($lucro); ?></h3>
                        <p>Total de Lucro (Mensal)</p>
                    </div>
                    <div class="icon">
                        <i class="ion-social-usd-outline"></i>
                    </div>
                    <a href="<?php echo site_url('admin/venda'); ?>" class="small-box-footer">
                        Visualizar Vendas <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-size: 20px;"><?php echo $moeda . " " . modificaNumericValor($despesa); ?></h3>
                        <p>Total de Compras (Mensal)</p>
                    </div>
                    <div class="icon">
                        <i class="ion-cash"></i>
                    </div>
                    <a href="<?php echo site_url('admin/compra'); ?>" class="small-box-footer">
                        Visualizar Compras <i class="fa fa-arrow-circle-right"></i>
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
                        <div id="pagamentos" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pagamentos por Clientes (Últimos 30 dias)</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="clientes" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
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
            // Pagamentos
            var chart = AmCharts.makeChart("pagamentos", {
            "type": "pie",
                    "theme": "light",
                    "dataProvider": [
<?php
$data_inicio = strtotime('-29 days');
$data_inicio = date('Y-m-d h:m:s', $data_inicio);
$data_fim = date("Y-m-d h:m:s");
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
            // Clientes
            var chart = AmCharts.makeChart("clientes", {
            "type": "serial",
                    "theme": "light",
                    "dataProvider": [
<?php foreach ($pagamento_cliente as $row):
    ?>
                        {
                        "cliente": "<?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>",
                                "valor": <?php echo $row->valor; ?>
                        },
<?php endforeach; ?>
                    ],
                    "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                            "gridAlpha": 0.2,
                            "dashLength": 0
                    } ],
                    "gridAboveGraphs": true,
                    "startDuration": 1,
                    "graphs": [ {
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                            "fillAlphas": 0.8,
                            "lineAlpha": 0.2,
                            "type": "column",
                            "valueField": "valor"
                    } ],
                    "chartCursor": {
                    "categoryBalloonEnabled": false,
                            "cursorAlpha": 0,
                            "zoomable": false
                    },
                    "categoryField": "cliente",
                    "categoryAxis": {
                    "gridPosition": "start",
                            "gridAlpha": 0,
                            "tickPosition": "start",
                            "tickLength": 20
                    },
                    "export": {
                    "enabled": true
                    }

            });
</script>