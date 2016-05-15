<script>
    var chart = AmCharts.makeChart("pagamentos", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [
<?php
$lucro = 0;
$despesa = 0;
$query = $this->db->select('tipo, forma_pagamento,valor, cadastro')
                ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data_inicio)
                ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data_fim)
                ->order_by('cadastro', 'desc')
                ->get('pagamento')->result();

foreach ($query as $row) :
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

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Relatórios - Pagamentos
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li><i class="fa fa-bar-chart"></i> Relatórios</li>
            <li class="active">
                <a href="<?php echo site_url('admin/relatorio/pagamento'); ?>">  Pagamentos</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <br/>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Lucro</span>
                        <span class="info-box-number"><?php echo $moeda . " " . modificaNumericValor($total_lucro); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Escolha um intervalo de datas</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        echo form_open(base_url('admin/relatorio/pagamento'), array('enctype' => 'multipart/form-data'));
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
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-cash"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Despesas</span>
                        <span class="info-box-number"><?php echo $moeda . " " . modificaNumericValor($total_despesa); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lucro - Despesas (Mensal)</h3>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="pagamentos" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listando pagamentos</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="tooltip-demo">
                        <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
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
                                            if ($row->idcliente != 0):
                                                echo $this->db->get_where('cliente', array(
                                                    'idcliente' => $row->idcliente
                                                ))->row()->nome;
                                            endif;
                                            if ($row->idfornecedor != 0):
                                                echo $this->db->get_where('fornecedor', array(
                                                    'idfornecedor' => $row->idfornecedor
                                                ))->row()->fornecedor;
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->idcliente != 0):
                                                echo 'Cliente';
                                            endif;
                                            if ($row->idfornecedor != 0):
                                                echo 'Fornecedor';
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if ($row->forma_pagamento == 1):
                                                echo "Dinheiro";
                                            elseif ($row->forma_pagamento == 2):
                                                echo "Cheque";
                                            elseif($row->forma_pagamento == 3):
                                                echo "Cartão";
                                            else:
                                                echo "Boleto";
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
