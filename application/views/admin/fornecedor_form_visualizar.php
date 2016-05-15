<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Fornecedor - Histórico
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/fornecedor'); ?>"><i class="fa fa-truck"></i> Fornecedores</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Informações Básicas</h3>
                    </div>

                    <div class="box-body">
                        <div class="text-center">
                            <img src="<?php echo $this->FornecedorM->get_image_url('fornecedor', $idfornecedor); ?>" class="img-circle" width="150" height="150">
                        </div>
                        <br/>

                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Dados do Fornecedor
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="text-left" style="margin-left: 10px;">
                                            <p><b>Fornecedor:</b> <?php echo $fornecedor; ?></p>
                                            <p><b>Pessoa/Contato:</b> <?php echo $nome; ?></p>
                                            <p><i class="fa fa-envelope"></i> <?php echo $email; ?></p>
                                            <p><b>Cep:</b> <?php echo $cep; ?></p>
                                            <p><b>Endereço:</b> <?php echo $cep; ?></p>
                                            <p><b>Cidade:</b> <?php echo $cidade; ?></p>
                                            <p><b>UF:</b> 
                                                <?php
                                                if ($uf == 'AC')
                                                    echo 'Acre';
                                                else if ($uf == 'AL')
                                                    echo ' Alagoas';
                                                else if ($uf == 'AP')
                                                    echo 'Amapá';
                                                else if ($uf == 'AM')
                                                    echo 'Amazonas';
                                                else if ($uf == 'BA')
                                                    echo 'Bahia';
                                                else if ($uf == 'CE')
                                                    echo 'Ceará';
                                                else if ($uf == 'DF')
                                                    echo 'Distrito Federal';
                                                else if ($uf == 'ES')
                                                    echo 'Espírito Santo';
                                                else if ($uf == 'GO')
                                                    echo 'Goiás';
                                                else if ($uf == 'MA')
                                                    echo 'Maranhão';
                                                else if ($uf == 'MT')
                                                    echo 'Mato Grosso';
                                                else if ($uf == 'MS')
                                                    echo 'Mato Grosso do Sul';
                                                else if ($uf == 'MG')
                                                    echo 'Minas Gerais';
                                                else if ($uf == 'PA')
                                                    echo 'Pará';
                                                else if ($uf == 'PB')
                                                    echo 'Paraíba';
                                                else if ($uf == 'PR')
                                                    echo 'Paraná';
                                                else if ($uf == 'PE')
                                                    echo 'Pernambuco';
                                                else if ($uf == 'PI')
                                                    echo 'Piauí';
                                                else if ($uf == 'RJ')
                                                    echo 'Rio de Janeiro';
                                                else if ($uf == 'RN')
                                                    echo 'Rio Grande do Norte';
                                                else if ($uf == 'RS')
                                                    echo 'Rio Grande do Sul';
                                                else if ($uf == 'RO')
                                                    echo 'Rondônia';
                                                else if ($uf == 'RR')
                                                    echo 'Roraima';
                                                else if ($uf == 'SC')
                                                    echo 'Santa Catarina';
                                                else if ($uf == 'SP')
                                                    echo 'São Paulo';
                                                else if ($uf == 'SE')
                                                    echo 'Sergipe';
                                                else
                                                    echo 'Tocantins';
                                                ?>
                                            </p>
                                            <p><i class="fa fa-phone"></i> <?php echo $telefone; ?></p>
                                            <p><i class="fa fa-mobile"></i> <?php echo $celular; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-info">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        Dados Bancários
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="box-body">
                                    <div class="text-left" style="margin-left: 10px;">
                                        <p><b>Banco:</b> <?php echo strtoupper($banco); ?></p>
                                        <p><b>Agencia:</b> <?php echo $agencia; ?></p>
                                        <p><b>Conta:</b> <?php echo $conta; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Histórico de Compras</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Código da Compra</th>
                                        <th>Valor Total</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $count = 1;
                                    $compras = $this->db->get_where('compra', array('idfornecedor' => $idfornecedor))->result();

                                    foreach ($compras as $row):
                                        ?>
                                        <tr>
                                            <td class="text-left"><?php echo $count++; ?></td>
                                            <td class="text-left"><?php echo $row->codigo_compra; ?></td>
                                            <td class="text-left">
                                                <?php
                                                $valor = $this->db->get_where('pagamento', array('idcompra' => $row->idcompra))->row()->valor;

                                                echo $moeda . ' ' . modificaNumericValor($valor);
                                                ?>
                                            </td>
                                            <td class="text-left"><?php echo dateMySQL2BR($row->cadastro); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>