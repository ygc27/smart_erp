<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venda extends CI_Controller {

    public $total;

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/Venda_model', 'VendaM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/perfil_model', 'PerfilM');
        $this->load->model('admin/mensagem_model', 'MensagemM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'historico-venda';
        $data['URLADICIONAR'] = site_url('admin/venda/adicionar');
        $data['URLLISTAR'] = site_url('admin/venda');

        $data['vendas'] = $this->VendaM->get_all()->result();

        $this->parser->parse('admin/venda', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'historico-venda';
        $data['ACAO'] = 'Nova Venda';
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

        $this->parser->parse('admin/venda_form', $data);
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

    public function get_produto_selecionado($tipo = '', $idproduto = '', $total_linha = '') {
        if ($tipo == 'mouse') {
            $produto = $this->db->get_where('produto', array(
                        'idproduto' => $idproduto
                    ))->row();

            $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($idproduto);

            if (!empty($idproduto) && !empty($total_linha)) {

                $retorno = '<tr id="entry_row_' . $total_linha . '">';

                $retorno .= '<td id="serial_' . $total_linha . '">' . $total_linha . '</td>';

                $retorno .= '<td>' . $produto->codigoproduto . '</td>';

                $retorno .= '<td>' . $produto->nome . '
                    <input type="hidden" name="idproduto[]" value="' . $produto->idproduto . '"
                        id="idproduto_' . $idproduto . '">
                </td>';

                // Lista Atributos
                $retorno .= '<td>';

                foreach ($atributosProduto as $atributos) {
                    $retorno .= '<div class="form-group">';
                    $retorno .= '<div class="col-md-9">
                                <label>
                                    <input type="checkbox" name="nome_atributo[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '_' . $atributos->nome . ']" id="' . $idproduto . '_' . $atributos->idprodutoestoque . '" class="atributos">&nbsp;&nbsp;' . $atributos->nome . "({$atributos->quantidade})" .
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
                    <input type="text" name="precovenda[' . $produto->idproduto . ']" readonly="true" value="' . modificaNumericValor($produto->precovenda) . '"
                        id="precovenda_' . $idproduto . '">
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
        } else if ($tipo == 'barcode') {

            $produto = $this->db->get_where('produto', array('codigoproduto' => $idproduto))->row();

            $atributosProduto = $this->ProdutoAtributoM->get_produto_barcode($idproduto);

            if (!empty($idproduto) && !empty($total_linha)) {

                $retorno = '<tr id="entry_row_' . $total_linha . '">';

                $retorno .= '<td id="serial_' . $total_linha . '">' . $total_linha . '</td>';

                $retorno .= '<td>' . $produto->codigoproduto . '
                        <input type="hidden" name="codigoproduto[]" class="codigo_produto" value="' . $produto->codigoproduto . '"
                        id="codigoproduto_' . $produto->codigoproduto . '"> 
                     </td>';

                $retorno .= '<td>' . $produto->nome . '
                        <input type="hidden" name="idproduto[]" class="list_idproduto" value="' . $produto->idproduto . '"
                        id="idproduto_' . $produto->idproduto . '">
                </td>';

                // Lista Atributos
                $retorno .= '<td>';

                foreach ($atributosProduto as $atributos) {
                    $retorno .= '<div class="form-group">';
                    $retorno .= '<div class="col-md-9">
                        <label>
                            <input type="checkbox" name="nome_atributo[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '_' . $atributos->nome . ']" id="' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '" class="atributos">&nbsp;&nbsp;' . $atributos->nome . "({$atributos->quantidade})" .
                            '</label>
                  </div>
                  
                  <div class="col-md-3">
                            <input type="text" name="quantidade[' . $produto->idproduto . '_' . $atributos->idprodutoestoque . ']" id="qtde_' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '" class="form-control clprodestoque estoque"
                                onchange="calcular_pedido(' . $produto->idproduto . ', ' . $atributos->idprodutoestoque . ')"
                                value="" placeholder="Qtde" disabled>
                            <input type="hidden" value="' . $atributos->quantidade . '" name="prod_' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '" id="prod_' . $produto->idproduto . '_' . $atributos->idprodutoestoque . '" />
                  </div>
                ';
                    $retorno .= '</div>';
                }
                // End - Listar Atributos
                $retorno .= '</td>';

                $retorno .= '<td>
                    <input type="text" name="precovenda[' . $produto->idproduto . ']" readonly="true" value="' . modificaNumericValor($produto->precovenda) . '"
                        id="precovenda_' . $produto->idproduto . '">
                </td>';
                $retorno .= '<td id="valor_total_' . $produto->idproduto . '" class="valor_total">' . $produto->precovenda . '</td>';
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
    }

    public function get_produtos($tipo = '', $idcategoria = '') {
        if ($tipo == 'categoria')
            $produtos = $this->db->get_where('produto', array('idcategoria' => $idcategoria))->result();
        if ($tipo == 'subcategoria')
            $produtos = $this->db->get_where('produto', array('idsubcategoria' => $idcategoria))->result();

        if (!empty($tipo) && !empty($idcategoria)) {
            foreach ($produtos as $row) {
                echo '<p onclick="adicionar_produto(' . $row->idproduto . ')" style="cursor: pointer;">
                            <span class="fa-stack fa-2x text-primary">
                                <i class="fa fa-circle-o fa-stack-2x"></i>
                                <i class="fa fa-plus fa-stack-1x"></i>
                            </span>' . $row->nome . ' 
                      </p>
                      <input type="hidden" class="list_idproduto" value="' . $row->idproduto . '">';
            }

            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_subcategoria($idcategoria = '') {
        if (!empty($idcategoria)) {
            $retorno = "<br/><br/>";
            $retorno .= '<div class="form-group">
                    <div class="col-md-12 col-sm-12">
                        <select onchange="get_produto(\'subcategoria\' , this.value)" class="form-control" name="idsubcategoria">
                            <option value="">Selecione uma subcategoria</option>';

            $subcategorias = $this->db->get_where('subcategoria', array(
                        'idcategoria' => $idcategoria
                    ))->result();

            foreach ($subcategorias as $row) {
                $retorno .= '<option value="' . $row->idsubcategoria . '">' . $row->nome . '</option>';
            };
            $retorno .= '</select>';
            $retorno .= '</div>';
            $retorno .= '</div>';

            echo $retorno;

            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function salvar() {
        $idCliente = $this->input->post('id_cliente');
        $idProduto = $this->input->post('idproduto');
        $codigoVenda = $this->input->post('codigo_venda');
        $dataCadastro = date('Y-m-d h:m:s');
        $nomeAtributo = $this->input->post('nome_atributo');
        $quantidade = $this->input->post('quantidade');
        $precoVenda = modificaDinheiroBanco($this->input->post('precovenda'));
        $subtotal = modificaDinheiroBanco($this->input->post('subtotal'));
        $desconto = $this->input->post('percentagem_desconto');
        $imposto = $this->input->post('percentagem_imposto');
        $valorTotal = modificaDinheiroBanco($this->input->post('valor_total'));
        $valorRestante = modificaDinheiroBanco($this->input->post('valor_restante'));
        $formaPagamento = $this->input->post('forma_pagamento');
        //$dataCadastro = dateBR2MySQL($dataCadastro);

        $erros = FALSE;
        $mensagem = null;

        if (!$erros) {
            $itens = array(
                'codigo_venda' => $codigoVenda,
                'idcliente' => $idCliente,
                'subtotal' => $subtotal,
                'desconto' => $desconto,
                'percentagem_imposto' => $imposto,
                'valor_total' => $valorTotal,
                'valor_restante' => $valorRestante,
                'data_cadastro' => $dataCadastro
            );

            // Insere na tabela venda
            $idVenda = $this->VendaM->post($itens);

            $itensPagamento = array(
                'tipo' => 'Credito',
                'forma_pagamento' => $formaPagamento,
                'valor' => $valorTotal,
                'idcliente' => $idCliente,
                'idvenda' => $idVenda,
                'cadastro' => $dataCadastro
            );

            // Insere na tabela pagamento
            $this->db->insert('pagamento', $itensPagamento);

            foreach ($idProduto as $codProduto) {

                $aAtributo = array();
                $somaProduto = 0;
                foreach ($nomeAtributo as $key => $v) {
                    list($codProdutoSub, $codProdutoEstoqueSub, $nomeAtributoSub) = explode('_', $key);
                    if ($codProdutoSub == $codProduto) {
                        $aAtributo[] = array('atributo' => $nomeAtributoSub, 'qtde' => $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], 'idprodutoestoque' => $codProdutoEstoqueSub);
                        $somaProduto += $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"];

                        // Atualiza a quantidade na tabela (produto_estoque)
                        $this->db->where('idproduto', $codProduto);
                        $this->db->where('idprodutoestoque', $codProdutoEstoqueSub);
                        $this->db->set('quantidade', 'quantidade - ' . $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], FALSE);
                        $this->db->update('produto_estoque');
                    }
                }

                $pedidoItem = array(
                    'idvenda' => $idVenda,
                    'idproduto' => $codProduto,
                    'entrada_vendas' => json_encode($aAtributo),
                    'quantidade' => $somaProduto,
                    'preco_unitario' => $precoVenda[$codProduto]
                );

                // Insere na tabela venda_item
                $this->db->insert('venda_item', $pedidoItem);
            }

            $this->session->set_flashdata('sucesso', 'Venda efetuada com sucesso.');

            redirect('admin/venda');
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));

            redirect('admin/venda/adicionar');
        }
    }

    public function visualizar($idvenda) {
        $data = array();
        $data['ACAO'] = 'Visualizar';
        $data['pagina_nome'] = 'historico-venda';

        $resultado = $this->VendaM->get(array("idvenda" => $idvenda), TRUE);

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

        $this->parser->parse('admin/venda_visualizar', $data);
    }

    public function imprimir($idvenda) {
        $data = array();
        $data['pagina_nome'] = 'historico-venda';

        $resultado = $this->VendaM->get(array("idvenda" => $idvenda), TRUE);

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

        $this->load->view('admin/imprimir_venda', $data);
    }

}
