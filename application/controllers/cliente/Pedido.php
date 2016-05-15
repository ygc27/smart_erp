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
        $this->load->model('cliente/perfil_model', 'PerfilM');
        $this->load->model('email_model', 'EmailM');
        if (!$this->session->userdata('cliente_login')) {
            redirect('login');
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'listar-pedido';
        $data['URLADICIONAR'] = site_url('cliente/pedido/adicionar');
        $data['URLLISTAR'] = site_url('cliente/pedido');

        $this->parser->parse('cliente/pedido', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'listar-pedido';
        $data['ACAO'] = 'Novo Pedido';
        $data['BLC_PRODUTOS'] = array();

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

        $data['endereco_entrega'] = $this->db->get_where('cliente', array('idcliente' => $this->session->userdata('idusuario')))->row()->endereco_entrega;

        // Exibir o valor da (MOEDA)
        $configuracoes = $this->db->get('configuracoes')->result();

        $data['imposto'] = $configuracoes[0]->imposto;

        $this->parser->parse('cliente/pedido_form', $data);
    }

    // Informações do produto para incluir no pedido via (AJAX)
    public function get_produto($idproduto = '', $total_linha = '') {

        $produto = $this->db->get_where('produto', array(
                    'idproduto' => $idproduto
                ))->row();

        $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($idproduto);

        if (!empty($idproduto) && !empty($total_linha)) {

            echo '<tr id="entry_row_' . $total_linha . '">';

            echo '<td id="serial_' . $total_linha . '">' . $total_linha . '</td>';

            echo '<td>' . $produto->codigoproduto . '</td>';

            echo '<td>' . $produto->nome . '
                    <input type="hidden" name="idproduto[]" value="' . $produto->idproduto . '"
                        id="idproduto_' . $idproduto . '">
                </td>';

            // Lista Atributos
            echo '<td>';

            foreach ($atributosProduto as $atributos) {
                echo '<div class="form-group">';
                echo '<div class="col-md-9">
                        <label>
                            <input type="checkbox" name="nome_atributo[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '_' . $atributos->nome . ']" id="' . $idproduto . '_' . $atributos->idprodutoestoque . '" class="atributos">&nbsp;&nbsp;' . $atributos->nome . "({$atributos->quantidade})" .
                '</label>
                  </div>
                  
                  <div class="col-md-3">
                            <input type="text" name="quantidade[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . ']" id="qtde_' . $idproduto . '_' . $atributos->idprodutoestoque . '" class="form-control clprodestoque estoque"
                                onchange="calcular_pedido(' . $idproduto . ', ' . $atributos->idprodutoestoque . ')"
                                value="" placeholder="Qtde" disabled>
                            <input type="hidden" value="' . $atributos->quantidade . '" name="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" id="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" />
                  </div>
                ';

                echo '</div>';
            }
            // End - Listar Atributos
            echo '</td>';

            echo '<td>
                    <input type="text" name="precovenda[' . $produto->idproduto . ']" readonly="true" value="' . modificaNumericValor($produto->precovenda) . '"
                        id="precovenda_' . $idproduto . '">
                </td>';
            echo '<td id="valor_total_' . $idproduto . '">' . $produto->precovenda . '</td>';
            echo '<td>
                    <i class="fa fa-trash" onclick="excluir_linha(' . $total_linha . ')"
                    id="excluir_btn_' . $total_linha . '" style="cursor: pointer;" title="Remover" data-toggle="tooltip" data-placement="top"></i>
                </td>';
            echo '</tr>';

            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function salvar() {
        $idProduto = $this->input->post('idproduto');
        $codigoPedido = $this->input->post('codigo_pedido');
        $dataCadastro = date('Y-m-d h:m:s');
        $nomeAtributo = $this->input->post('nome_atributo');
        $quantidade = $this->input->post('quantidade');
        $precoVenda = modificaDinheiroBanco($this->input->post('precovenda'));
        $subtotal = modificaDinheiroBanco($this->input->post('subtotal'));
        $desconto = $this->input->post('percentagem_desconto');
        $imposto = $this->input->post('percentagem_imposto');
        $valorTotal = modificaDinheiroBanco($this->input->post('valor_total'));
        $formaPagamento = $this->input->post('forma_pagamento');
        $statusPedido = 1;
        $statusPagamento = 1;
        $enderecoEntrega = $this->input->post('endereco_entrega');
        $observacoes = $this->input->post('observacoes');

        $itens = array(
            'codigo_pedido' => $codigoPedido,
            'idcliente' => $this->session->userdata('idusuario'),
            'subtotal' => $subtotal,
            'desconto' => $desconto,
            'percentagem_imposto' => $imposto,
            'valor_total' => $valorTotal,
            'forma_pagamento' => $formaPagamento,
            'status_pedido' => $statusPedido,
            'status_pagamento' => $statusPagamento,
            'endereco_entrega' => $enderecoEntrega,
            'observacao' => $observacoes,
            'data_cadastro' => $dataCadastro
        );

        // Insere na tabela pedido
        $idPedido = $this->PedidoM->post($itens);

        foreach ($idProduto as $codProduto) {
            $aAtributo = array();
            $somaProduto = 0;
            foreach ($nomeAtributo as $key => $v) {
                list($codProdutoSub, $codProdutoEstoqueSub, $nomeAtributoSub) = explode('_', $key);
                if ($codProdutoSub == $codProduto) {
                    $aAtributo[] = array('atributo' => $nomeAtributoSub, 'qtde' => $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], 'idprodutoestoque' => $codProdutoEstoqueSub);
                    $somaProduto += $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"];

                    // Atualiza a quantidade na tabela (produto_estoque) se o satus_pedido = 'Aprovado' é status_pagamento = 'Pago'
                    if (($statusPedido == 2) && ($statusPagamento == 2)) {
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

            // Insere na tabela pedido_item
            $this->db->insert('pedido_item', $pedidoItem);
        }

        $this->session->set_flashdata('sucesso', 'Pedido realizado com sucesso.');

        $cliente = $this->db->get_where('cliente', array('idcliente' => $this->session->userdata('idusuario')))->row()->nome;

        $email_from = $this->db->get_where('cliente', array('idcliente' => $this->session->userdata('idusuario')))->row()->email;

        $this->EmailM->pedido_criado_by_cliente_email($email_from, $cliente, $codigoPedido, 'Pendente');

        redirect('cliente/pedido');
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

        $this->parser->parse('cliente/pedido_visualizar', $data);
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

        $this->load->view('cliente/imprimir_pedido', $data);
    }

    // Verificação de redirecionamento após terminal de paypal
    public function cancelado($codigo_pedido = '') {

        $this->session->set_flashdata('sucesso', "Pagamento do pedido {$codigo_pedido} cancelado.");

        redirect('cliente/pedido', 'refresh');
    }

    public function sucesso($codigo_pedido = '') {

        if (isset($codigo_pedido)) {
            $this->session->set_flashdata('sucesso', "Pagamento do pedido {$codigo_pedido} concluído com sucesso.");

            $this->db->select('cliente.nome, cliente.email');
            $this->db->from('pedido');
            $this->db->where('codigo_pedido', $codigo_pedido);
            $this->db->join('cliente', 'pedido.idcliente = cliente.idcliente');
            $cliente = $this->db->get()->result();

            $this->EmailM->pagamento_efetuado($cliente[0]->email, $cliente[0]->nome, $codigo_pedido, 'Pago');
        }
        redirect('cliente/pedido', 'refresh');
    }

}
