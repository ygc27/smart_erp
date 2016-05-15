<script>
    var chart = AmCharts.makeChart("pagamentos_clientes", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [
<?php
$this->db->select_sum('valor');
$this->db->select('idcliente, tipo, forma_pagamento, cadastro');
$this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data_inicio);
$this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data_fim);
$this->db->where('idcliente !=', 0);
$this->db->group_by('idcliente');
$this->db->order_by('cadastro', 'desc');
$pagamento_cliente = $this->db->get('pagamento')->result();
foreach ($pagamento_cliente as $row):
    ?>
                {
                    "cliente": "<?php echo $this->db->get_where('cliente', array('idcliente' => $row->idcliente))->row()->nome; ?>",
                    "valor": <?php echo $row->valor; ?>
                },
<?php endforeach; ?>
        ],
        "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "valor"
            }],
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

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Relatórios - Pagamentos de Clientes
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-bar-chart"></i> Relatórios</li>
            <li class="active">
                <a href="<?php echo site_url('admin/relatorio/cliente'); ?>">  Pagamentos de Clientes</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <br/>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Escolha um intervalo de datas</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        echo form_open(base_url('admin/relatorio/cliente'), array('enctype' => 'multipart/form-data'));
                        ?>
                        <br/>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control text-center datepicker" name="data_inicio" value="<?php echo dateMySQL2BR($data_inicio); ?>" />
                                <span class="input-group-addon" style="background-color: #001F3F; color: #fff;">á</span>
                                <input type="text" class="form-control text-center datepicker" name="data_fim" value="<?php echo dateMySQL2BR($data_fim); ?>" />
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;Filtrar</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pagamentos por Clientes</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="pagamentos_clientes" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listando pagamentos por clientes</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Cliente</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $count = 1;

                                foreach ($pagamentos as $row):
                                    $cadastro = strtotime($row->cadastro);
                                    ?>
                                    <tr>
                                        <td class="text-left"><?php echo $count++; ?></td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->db->get_where('cliente', array(
                                                'idcliente' => $row->idcliente
                                            ))->row()->nome;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->forma_pagamento == 1):
                                                echo "Dinheiro";
                                            elseif ($row->forma_pagamento == 2):
                                                echo "Cheque";
                                            else:
                                                echo "Cartão";
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php if ($row->tipo == 'Credito'): ?>
                                                <span style="padding-left: 10px; padding-right: 10px; background-color: #00c0ef; font-weight: bold;"> <?php echo "Lucro"; ?> </span>
                                            <?php else: ?>
                                                <span style="padding-left: 10px; padding-right: 10px; background-color: #f39c12; font-weight: bold;"><?php echo "Despesa"; ?> </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-left"><?php echo $moeda . " " . modificaNumericValor($row->valor); ?></td>
                                        <td class="text-left"><?php echo date('d/m/y h:m:s', $cadastro); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
