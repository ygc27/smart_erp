<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cliente - Histórico
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Painel de Controle</a>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/cliente'); ?>"><i class="fa fa-users"></i> Clientes</a>
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
                            <img src="<?php echo $this->ClienteM->get_image_url('cliente', $idcliente); ?>" class="img-circle" width="150" height="150">
                        </div>
                        <br/>
                        <div class="box-group" id="accordion">
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Dados do Cliente
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="text-left" style="margin-left: 10px;">
                                            <?php if ($tipo_perfil == 'pf'): ?>
                                                <p><b>Cliente:</b> <?php echo $nome; ?></p>
                                                <p><b>CPF:</b> <?php echo '<span class="cpf">' . $cpf . '</span>'; ?></p>
                                                <p><b><i class="fa fa-envelope"></i></b> <?php echo $email; ?></p>
                                                <p><b><i class="fa fa-phone"></i></b> <?php echo $telefone; ?></p>
                                                <p><b><i class="fa fa-mobile"></i></b> <?php echo $celular; ?></p>
                                                <p><b>Desconto:</b> <?php echo $desconto; ?></p>
                                            <?php else:
                                                ?>
                                                <p><b>Empresa:</b> <?php echo $nome; ?></p>
                                                <p><b>CNPJ:</b> <?php echo '<span class="cnpj">' . $cnpj . '</span>'; ?></p>
                                                <p><b>Razão Social:</b> <?php echo $razao_social; ?></p>
                                                <p><b>Pessoa/Contato:</b> <?php echo $pessoa_contato; ?></p>
                                                <p><b><i class="fa fa-envelope"></i></b> <?php echo $email; ?></p>
                                                <p><b><i class="fa fa-phone"></i></b> <?php echo $telefone; ?></p>
                                                <p><b><i class="fa fa-mobile"></i></b> <?php echo $celular; ?></p>
                                                <p><b>Desconto:</b> <?php echo $desconto; ?></p>
                                            <?php endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-info">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Endereço
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="text-left" style="margin-left: 10px;">
                                            <p><b>Cep:</b> <?php echo $cep; ?></p>
                                            <p><b>Endereço:</b> <?php echo $endereco; ?></p>
                                            <p><b>Nº:</b> <?php echo $numero; ?></p>
                                            <p><b>Complemento:</b>  <?php echo $complemento; ?></p>
                                            <p><b>Bairro:</b> <?php echo $bairro; ?></p>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Endereço para Entrega
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <div class="text-left" style="margin-left: 10px;">
                                            <p><b>Cep:</b> <?php echo $cep_entrega; ?></p>
                                            <p><b>Endereço:</b> <?php echo $endereco_entrega; ?></p>
                                            <p><b>Nº:</b> <?php echo $numero_entrega; ?></p>
                                            <p><b>Complemento:</b>  <?php echo $complemento_entrega; ?></p>
                                            <p><b>Bairro:</b> <?php echo $bairro_entrega; ?></p>
                                            <p><b>Cidade:</b> <?php echo $cidade_entrega; ?></p>
                                            <p><b>UF:</b> 
                                                <?php
                                                if ($uf == 'AC')
                                                    echo 'Acre';
                                                else if ($uf_entrega == 'AL')
                                                    echo ' Alagoas';
                                                else if ($uf_entrega == 'AP')
                                                    echo 'Amapá';
                                                else if ($uf_entrega == 'AM')
                                                    echo 'Amazonas';
                                                else if ($uf_entrega == 'BA')
                                                    echo 'Bahia';
                                                else if ($uf_entrega == 'CE')
                                                    echo 'Ceará';
                                                else if ($uf_entrega == 'DF')
                                                    echo 'Distrito Federal';
                                                else if ($uf_entrega == 'ES')
                                                    echo 'Espírito Santo';
                                                else if ($uf_entrega == 'GO')
                                                    echo 'Goiás';
                                                else if ($uf_entrega == 'MA')
                                                    echo 'Maranhão';
                                                else if ($uf_entrega == 'MT')
                                                    echo 'Mato Grosso';
                                                else if ($uf_entrega == 'MS')
                                                    echo 'Mato Grosso do Sul';
                                                else if ($uf_entrega == 'MG')
                                                    echo 'Minas Gerais';
                                                else if ($uf_entrega == 'PA')
                                                    echo 'Pará';
                                                else if ($uf_entrega == 'PB')
                                                    echo 'Paraíba';
                                                else if ($uf_entrega == 'PR')
                                                    echo 'Paraná';
                                                else if ($uf_entrega == 'PE')
                                                    echo 'Pernambuco';
                                                else if ($uf_entrega == 'PI')
                                                    echo 'Piauí';
                                                else if ($uf_entrega == 'RJ')
                                                    echo 'Rio de Janeiro';
                                                else if ($uf_entrega == 'RN')
                                                    echo 'Rio Grande do Norte';
                                                else if ($uf_entrega == 'RS')
                                                    echo 'Rio Grande do Sul';
                                                else if ($uf_entrega == 'RO')
                                                    echo 'Rondônia';
                                                else if ($uf_entrega == 'RR')
                                                    echo 'Roraima';
                                                else if ($uf_entrega == 'SC')
                                                    echo 'Santa Catarina';
                                                else if ($uf_entrega == 'SP')
                                                    echo 'São Paulo';
                                                else if ($uf_entrega == 'SE')
                                                    echo 'Sergipe';
                                                else
                                                    echo 'Tocantins';
                                                ?>
                                            </p>
                                        </div>
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
                        <h3 class="box-title">Histórico</h3>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab"> Pedidos</a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab"> Compras</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Código do Pedido</th>
                                                        <th>Status do Pedido</th>
                                                        <th>Status do Pagamento</th>
                                                        <th>Data de Emissão</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">

                                                    <?php
                                                    $count = 1;
                                                    $pedidos = $this->db->get_where('pedido', array('idcliente' => $idcliente))->result();

                                                    foreach ($pedidos as $row):
                                                        ?>
                                                        <tr>
                                                            <td class="text-left"><?php echo $count++; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_pedido; ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                if ($row->status_pedido == 1):
                                                                    echo "Pendente";
                                                                elseif ($row->status_pedido == 2):
                                                                    echo "Aprovado";
                                                                elseif ($row->status_pedido == 3):
                                                                    echo "Recusado";
                                                                else:
                                                                    echo "Cancelado";
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php
                                                                if ($row->status_pagamento == 1):
                                                                    echo "Não Pago";
                                                                else:
                                                                    echo "Pago";
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo dateMySQL2BR($row->data_cadastro); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="tooltip-demo">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Código/Venda</th>
                                                        <th>Forma/Pagamento</th>
                                                        <th>Valor Total</th>
                                                        <th>Data</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $count = 1;
                                                    $venda = $this->db->get_where('venda', array('idcliente' => $idcliente))->result();

                                                    foreach ($venda as $row):
                                                        ?>
                                                        <tr>
                                                            <td class="text-left"><?php echo $count; ?></td>
                                                            <td class="text-left"><?php echo $row->codigo_venda; ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                $forma_pagamento = $this->db->get_where('pagamento', array('idvenda' => $row->idvenda))->row()->forma_pagamento;
                                                                if ($forma_pagamento == 1):
                                                                    echo "Dinheiro";
                                                                elseif ($forma_pagamento == 2):
                                                                    echo "Cheque";
                                                                else:
                                                                    echo "Cartão";
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo $moeda . " " . modificaNumericValor($row->valor_total); ?></td>
                                                            <td class="text-left"><?php echo dateMySQL2BR($row->data_cadastro); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>