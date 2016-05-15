<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public $total;

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/pedido_model', 'PedidoM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/perfil_model', 'PerfilM');
        $this->load->model('admin/mensagem_model', 'MensagemM');
        $this->load->model('email_model', 'EmailM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'listar-pedido';
        $data['URLADICIONAR'] = site_url('admin/pedido/adicionar');
        $data['URLLISTAR'] = site_url('admin/pedido');

        $this->parser->parse('admin/pedido', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'listar-pedido';
        $data['ACAO'] = 'Novo Pedido';
        $data['idpedido'] = '';
        $data['BLC_CLIENTES'] = array();
        $data['BLC_PRODUTOS'] = array();

        $cliente = $this->ClienteM->get_all()->result();

        if ($cliente) {
            foreach ($cliente as $row) {
                $data['BLC_CLIENTES'][] = array(
                    "ID_CLIENTE" => $row->idcliente,
                    "NOMECLIENTE" => $row->nome,
                    "sel_idpai" => null
                );
            }
        }

        $produto = $this->ProdutoM->get_all()->result();

        if ($produto) {
            foreach ($produto as $row) {
                $data['BLC_PRODUTOS'][] = array(
                    "IDPRODUTO" => $row->idproduto,
                    "NOMEPRODUTO" => $row->nome,
                    "sel_idpai" => null
                );
            }
        }

        $resultado = $this->SistemaM->get(array(), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $this->parser->parse('admin/pedido_form', $data);
    }

    // Informações do produto para incluir no pedido via (AJAX)
    public function get_produto($idproduto = '', $total_linha = '') {

        $produto = $this->db->get_where('produto', array(
                    'idproduto' => $idproduto
                ))->row();

        $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($idproduto);

        if (!empty($idproduto) && !empty($total_linha)) {

            $retorno = '<tr id="entry_row_' . $total_linha . '">';
            $retorno .= '<td id="serial_' . $total_linha . '">' . $total_linha . '</td>';
            $retorno .= '<td>' . $produto->codigoproduto . '</td>';
            $retorno .= '<td>' . $produto->nome .
                    '<input type="hidden" name="idproduto[]" value="' . $produto->idproduto . '"id="idproduto_' . $idproduto . '" />'
                    . '</td>';

            // Lista Atributos
            $retorno .= '<td>';

            foreach ($atributosProduto as $atributos) {
                $retorno .= '<div class="form-group">';
                $retorno .= '<div class="col-md-9">
                        <label>
                            <input type="checkbox" name="nome_atributo[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '_' . $atributos->nome . ']" id="' . $idproduto . '_' . $atributos->idprodutoestoque . '" class="atributos" />&nbsp;&nbsp;' . $atributos->nome . "({$atributos->quantidade})" .
                        '</label>
                  </div>
                  
                  <div class="col-md-3">
                            <input type="text" name="quantidade[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . ']" id="qtde_' . $idproduto . '_' . $atributos->idprodutoestoque . '" class="form-control clprodestoque estoque"
                                onchange="calcular_pedido(' . $idproduto . ', ' . $atributos->idprodutoestoque . ')"
                                value="" placeholder="Qtde" disabled />
                            <input type="hidden" value="' . $atributos->quantidade . '" name="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" id="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" />
                  </div>
                ';

                $retorno .= '</div>';
            }
            // End - Listar Atributos
            $retorno .= '</td>';

            $retorno .= '<td>
                    <input type="text" name="precovenda[' . $produto->idproduto . ']" value="' . modificaNumericValor($produto->precovenda) . '"
                        id="precovenda_' . $idproduto . '" readonly>
                </td>';
            $retorno .= '<td id="valor_total_' . $idproduto . '">' . $produto->precovenda . '</td>';
            $retorno .= '<td>
                    <i class="fa fa-trash" onclick="excluir_linha(' . $total_linha . ')"
                    id="excluir_btn_' . $total_linha . '" style="cursor: pointer;" title="Remover" data-toggle="tooltip" data-placement="top"></i>
                </td>';
            $retorno .= '</tr>';

            echo $retorno;
            
            exit;
        } else {
            echo '';
            exit;
        }
    }

    // Retorna desconto do Cliente
    public function get_desconto() {

        $id_cliente = $this->input->post('id_cliente');

        if (!empty($id_cliente)) {
            $cliente_desconto = $this->db->get_where('cliente', array(
                        'idcliente' => $id_cliente
                    ))->row()->desconto;

            echo $cliente_desconto;
            exit;
        } else {
            echo '';
            exit;
        }
    }

    // Retorna status pedido
    public function valida_pedido() {
        $status_pedido = $this->input->post('status_pedido');
        $status_pagamento = $this->input->post('status_pagamento');

        if (isset($status_pedido) && isset($status_pagamento)) {

            echo $status_pedido . "\n";
            echo $status_pagamento . "\n";
            exit;
        } else {
            echo '';
            exit;
        }
    }

    // Retorna endereço 
    public function valida_endereco() {
        $idcliente = $this->input->post('id_cliente');

        if (!empty($idcliente)) {
            $endereco = $this->db->get_where('cliente', array('idcliente' => $idcliente))->row()->endereco_entrega;
            echo $endereco;
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function salvar() {
        $idPedido = $this->input->post('idpedido');
        $idCliente = $this->input->post('id_cliente');
        $idProduto = $this->input->post('idproduto');
        $codigoPedido = $this->input->post('codigo_pedido');
        $dataCadastro = date('Y-m-d h:m:s');
        $dataAlteracao = date('Y-m-d h:m:s');
        $nomeAtributo = $this->input->post('nome_atributo');
        $quantidade = $this->input->post('quantidade');
        $precoVenda = modificaDinheiroBanco($this->input->post('precovenda'));
        $subtotal = modificaDinheiroBanco($this->input->post('subtotal'));
        $desconto = $this->input->post('percentagem_desconto');
        $imposto = $this->input->post('percentagem_imposto');
        $valorTotal = modificaDinheiroBanco($this->input->post('valor_total'));
        $valorRestante = modificaDinheiroBanco($this->input->post('valor_restante'));
        $formaPagamento = $this->input->post('forma_pagamento');
        $statusPedido = $this->input->post('status_pedido');
        $statusPagamento = $this->input->post('status_pagamento');
        $enderecoEntrega = $this->input->post('endereco_entrega');
        $observacoes = $this->input->post('observacoes');

        $erros = FALSE;
        $mensagem = null;

        if (!$erros) {
            $itens = array(
                'codigo_pedido' => $codigoPedido,
                'idcliente' => $idCliente,
                'subtotal' => $subtotal,
                'desconto' => $desconto,
                'percentagem_imposto' => $imposto,
                'valor_total' => $valorTotal,
                'valor_restante' => $valorRestante,
                'forma_pagamento' => $formaPagamento,
                'status_pedido' => $statusPedido,
                'status_pagamento' => $statusPagamento,
                'endereco_entrega' => $enderecoEntrega,
                'observacao' => $observacoes,
                'data_cadastro' => $dataCadastro
            );

            if ($idPedido) {

                $dados = array(
                    'status_pedido' => $statusPedido,
                    'status_pagamento' => $statusPagamento,
                    'endereco_entrega' => $enderecoEntrega,
                    'observacao' => $observacoes,
                    'data_alteracao' => $dataAlteracao
                );

                $this->PedidoM->update($dados, $idPedido);

                // Lista informações do pedido_item
                $pedido_item = $this->db->get_where('pedido_item', array('idpedido' => $idPedido))->result();

                $idProduto = $pedido_item[0]->idproduto;
                $entrada_pedidos = $pedido_item[0]->entrada_pedidos;
                $quantidade = $pedido_item[0]->quantidade;
                $precoVenda = $pedido_item[0]->preco_unitario;

                // Lista informações do pedido
                $pedido = $this->db->get_where('pedido', array('idpedido' => $idPedido))->result();

                $itensVenda = array(
                    //'idvenda' => $idPedido,
                    'codigo_venda' => $pedido[0]->codigo_pedido,
                    'idcliente' => $pedido[0]->idcliente,
                    'subtotal' => $pedido[0]->subtotal,
                    'desconto' => $pedido[0]->desconto,
                    'percentagem_imposto' => $pedido[0]->percentagem_imposto,
                    'valor_total' => $pedido[0]->valor_total,
                    'valor_restante' => $pedido[0]->valor_restante,
                    'data_cadastro' => $dataAlteracao
                );

                //echo "<pre>";
                //print_r($itensVenda);die;

                if ($statusPedido == 2 && $statusPagamento == 2) {
                    // Insere na tabela venda
                    $this->db->insert('venda', $itensVenda);
                }

                $itensPagamento = array(
                    'tipo' => 'Credito',
                    'forma_pagamento' => $pedido[0]->forma_pagamento,
                    'valor' => $pedido[0]->valor_total,
                    'idcliente' => $pedido[0]->idcliente,
                    'idpedido' => $idPedido,
                    'idvenda' => $idPedido,
                    'cadastro' => $dataAlteracao
                );

                if ($statusPedido == 2 && $statusPagamento == 2) {
                    // Insere na tabela pagamento
                    $this->db->insert('pagamento', $itensPagamento);
                }

                $this->db->where('idpedido', $idPedido, FALSE);
                $pedido_item = $this->db->get('pedido_item')->result();
                foreach ($pedido_item as $row) {
                    $pedidos = json_decode($row->entrada_pedidos);

                    foreach ($pedidos as $valor) {

                        $idprodutoestoque = $valor->idprodutoestoque;
                        $qtdePedidos = $valor->qtde;

                        // Atualiza a quantidade na tabela (produto_estoque) se o satus_pedido = 'Aprovado' é status_pagamento = 'Pago'
                        if (($statusPedido == 2) && ($statusPagamento == 2)) {
                            $this->db->where('idproduto', $idProduto);
                            $this->db->where('idprodutoestoque', $idprodutoestoque);
                            $this->db->where('quantidade !=', 0);
                            $this->db->set('quantidade', 'quantidade - ' . $qtdePedidos, FALSE);
                            $this->db->update('produto_estoque');
                        }
                    }
                }

                $vendaItem = array(
                    'idvenda' => $idPedido,
                    'idproduto' => $idProduto,
                    'entrada_vendas' => $entrada_pedidos,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $precoVenda
                );

                if ($statusPedido == 2 && $statusPagamento == 2) {
                    // Insere na tabela venda_item
                    $this->db->insert('venda_item', $vendaItem);
                }

                $this->session->set_flashdata('sucesso', 'Pedido atualizado com sucesso.');

                $email_to = $this->db->get_where('cliente', array('idcliente' => $idCliente))->row()->email;

                if ($statusPedido == 1) {
                    $this->EmailM->alteracao_status_pedido_email('Pendente', $codigoPedido, $email_to);
                } elseif ($statusPedido == 2) {
                    $this->EmailM->alteracao_status_pedido_email('Aprovado', $codigoPedido, $email_to);
                } elseif ($statusPedido == 3) {
                    $this->EmailM->alteracao_status_pedido_email('Rejeitado', $codigoPedido, $email_to);
                } else {
                    $this->EmailM->alteracao_status_pedido_email('Cancelado', $codigoPedido, $email_to);
                }
            } else {

                // Insere na tabela pedido
                $idPedido = $this->PedidoM->post($itens);

                $itensVenda = array(
                    //'idvenda' => $idPedido,
                    'codigo_venda' => $codigoPedido,
                    'idcliente' => $idCliente,
                    'subtotal' => $subtotal,
                    'desconto' => $desconto,
                    'percentagem_imposto' => $imposto,
                    'valor_total' => $valorTotal,
                    'valor_restante' => $valorRestante,
                    'data_cadastro' => $dataCadastro
                );

                if ($statusPedido == 2 && $statusPagamento == 2) {
                    // Insere na tabela venda
                    $this->db->insert('venda', $itensVenda);
                }

                $itensPagamento = array(
                    'tipo' => 'Credito',
                    'forma_pagamento' => $formaPagamento,
                    'valor' => $valorTotal,
                    'idcliente' => $idCliente,
                    'idvenda' => $idPedido,
                    'idpedido' => $idPedido,
                    'cadastro' => $dataCadastro
                );

                if ($statusPedido == 2 && $statusPagamento == 2) {
                    // Insere na tabela pagamento
                    $this->db->insert('pagamento', $itensPagamento);
                }

                foreach ($idProduto as $codProduto) {

                    $aAtributo = array();
                    $somaProduto = 0;
                    foreach ($nomeAtributo as $key => $v) {
                        list($codProdutoSub, $codProdutoEstoqueSub, $nomeAtributoSub) = explode('_', $key);
                        if ($codProdutoSub == $codProduto) {
                            $aAtributo[] = array('atributo' => $nomeAtributoSub, 'qtde' => $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], 'idprodutoestoque' => $codProdutoEstoqueSub);
                            $somaProduto += $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"];

                            // Atualiza a quantidade na tabela (produto_estoque) se o satus_pedido = 'Aprovado' é status_pagamento = 'Pago'
                            if ($statusPedido == 2 && $statusPagamento == 2) {
                                $this->db->where('idproduto', $codProduto);
                                $this->db->where('idprodutoestoque', $codProdutoEstoqueSub);
                                $this->db->set('quantidade', 'quantidade - ' . $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], FALSE);
                                $this->db->update('produto_estoque');
                            }
                        }
                    }

                    $pedidoItem = array(
                        'idpedido' => $idPedido,
                        'idproduto' => $codProduto,
                        'entrada_pedidos' => json_encode($aAtributo),
                        'quantidade' => $somaProduto,
                        'preco_unitario' => $precoVenda[$codProduto]
                    );

                    $vendaItem = array(
                        'idvenda' => $idPedido,
                        'idproduto' => $codProduto,
                        'entrada_vendas' => json_encode($aAtributo),
                        'quantidade' => $somaProduto,
                        'preco_unitario' => $precoVenda[$codProduto]
                    );

                    // Insere na tabela pedido_item
                    $this->db->insert('pedido_item', $pedidoItem);

                    if ($statusPedido == 2 && $statusPagamento == 2) {
                        // Insere na tabela venda_item
                        $this->db->insert('venda_item', $vendaItem);
                    }
                }

                $this->session->set_flashdata('sucesso', 'Pedido realizado com sucesso.');

                $email = $this->db->get_where('cliente', array('idcliente' => $idCliente))->row()->email;

                if ($statusPedido == 1) {
                    $this->EmailM->pedido_criado_by_admin_email('Pendente', $codigoPedido, $email);
                } else if ($statusPedido == 2) {
                    $this->EmailM->pedido_criado_by_admin_email('Aprovado', $codigoPedido, $email);
                } else if ($statusPedido == 3) {
                    $this->EmailM->pedido_criado_by_admin_email('Recusado', $codigoPedido, $email);
                } else {
                    $this->EmailM->pedido_criado_by_admin_email('Cancelado', $codigoPedido, $email);
                }
            }
            if ($idPedido) {
                redirect('admin/pedido');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idPedido)
                    redirect('admin/pedido/editar/' . $idPedido);
                else
                    redirect('admin/pedido/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idPedido)
                redirect('admin/pedido/editar/' . $idPedido);
            else
                redirect('admin/pedido/adicionar');
        }
    }

    public function editar($idpedido) {
        $data = array();
        $data['ACAO'] = 'Editar';
        $data['pagina_nome'] = 'listar-pedido';

        $resultado = $this->PedidoM->get(array("idpedido" => $idpedido), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $k => $v) {
                $data[$k] = $v;
            }
        }

        $this->db->where('idpedido', $idpedido, FALSE);
        $data['itens'] = $this->db->get('pedido_item')->result();

        $this->parser->parse('admin/pedido_form_editar', $data);
    }

    public function visualizar($idpedido) {
        $data = array();
        $data['ACAO'] = 'Visualizar';
        $data['pagina_nome'] = 'listar-pedido';

        $resultado = $this->PedidoM->get(array("idpedido" => $idpedido), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $k => $v) {
                $data[$k] = $v;
            }
        }

        $this->parser->parse('admin/pedido_visualizar', $data);
    }

    public function imprimir($idpedido) {
        $data = array();
        $data['pagina_nome'] = 'listar-pedido';

        $resultado = $this->PedidoM->get(array("idpedido" => $idpedido), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $k => $v) {
                $data[$k] = $v;
            }
        }

        $this->load->view('admin/imprimir_pedido', $data);
    }

}
