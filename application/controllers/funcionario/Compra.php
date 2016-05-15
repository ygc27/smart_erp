<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/funcionario_model', 'FuncionarioM');
        $this->load->model('admin/compra_model', 'CompraM');
        $this->load->model('admin/fornecedor_model', 'FornecedorM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/perfil_model', 'PerfilM');
        if (!$this->session->userdata('funcionario_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'historico-compra';
        $data['URLADICIONAR'] = site_url('funcionario/compra/adicionar');
        $data['URLLISTAR'] = site_url('funcionario/compra');

        $data['compras'] = $this->CompraM->get_all()->result();

        $this->parser->parse('funcionario/compra', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'historico-compra';
        $data['ACAO'] = 'Nova Compra';
        $data['BLC_FORNECEDOR'] = array();
        $data['BLC_FORNECEDOR'] = array();
        $data['BLC_PRODUTOS'] = array();

        $fornecedor = $this->FornecedorM->get_all()->result();

        if ($fornecedor) {
            foreach ($fornecedor as $row) {
                $data['BLC_FORNECEDOR'][] = array(
                    "ID_FORNECEDOR" => $row->idfornecedor,
                    "NOMEFORNECEDOR" => $row->fornecedor,
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

        $this->parser->parse('funcionario/compra_form', $data);
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

            $retorno .= '<td>' . $produto->nome . '
                    <input type="hidden" name="idproduto[]" value="' . $produto->idproduto . '"
                        id="idproduto_' . $idproduto . '" />
                </td>';

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
                                onchange="calcular_compra(' . $idproduto . ', ' . $atributos->idprodutoestoque . ')"
                                value="" placeholder="Qtde" disabled />
                            <input type="hidden" value="' . $atributos->quantidade . '" name="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" id="prod_' . $idproduto . '_' . $atributos->idprodutoestoque . '" />
                  </div>
                ';

                $retorno .= '</div>';
            }
            // End - Listar Atributos
            $retorno .= '</td>';

            $retorno .= '<td>
                    <input type="text" name="preco_compra[' . $produto->idproduto . ']" readonly="true" value="' . modificaNumericValor($produto->precocompra) . '"
                        id="precocompra_' . $idproduto . '" />
                </td>';
            $retorno .= '<td id="valor_total_' . $idproduto . '">' . $produto->precocompra . '</td>';
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

    public function salvar() {
        $idFornecedor = $this->input->post('id_fornecedor');
        $idProduto = $this->input->post('idproduto');
        $codigoCompra = $this->input->post('codigo_compra');
        $dataCadastro = date('Y-m-d h:m:s');
        $quantidade = $this->input->post('quantidade');
        $nomeAtributo = $this->input->post('nome_atributo');
        $precoCompra = modificaDinheiroBanco($this->input->post('preco_compra'));
        $valorTotal = modificaDinheiroBanco($this->input->post('valor_total'));
        $pagamento = $this->input->post('pagamento');
        $formaPagamento = $this->input->post('forma_pagamento');

        $erros = FALSE;
        $mensagem = null;

        if (!$erros) {
            $itens = array(
                'codigo_compra' => $codigoCompra,
                'idfornecedor' => $idFornecedor,
                'cadastro' => $dataCadastro
            );

            // Insere na tabela compra
            $idCompra = $this->CompraM->post($itens);

            $itensPagamento = array(
                'tipo' => 'Debito',
                'forma_pagamento' => $formaPagamento,
                'valor' => $valorTotal,
                'idfornecedor' => $idFornecedor,
                'idcompra' => $idCompra,
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
                        $aAtributo[] = array('atributo' => $nomeAtributoSub, 'qtde' => $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"]);
                        $somaProduto += $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"];

                        $this->db->where('idproduto', $codProduto);
                        $this->db->where('idprodutoestoque', $codProdutoEstoqueSub);
                        $this->db->set('quantidade', 'quantidade + ' . $quantidade["{$codProduto}_{$codProdutoEstoqueSub}"], FALSE);
                        $this->db->update('produto_estoque');
                    }
                }

                $compraItem = array(
                    'idcompra' => $idCompra,
                    'idproduto' => $codProduto,
                    'entrada_compras' => json_encode($aAtributo),
                    'quantidade' => $somaProduto,
                    'preco_unitario' => $precoCompra[$codProduto]
                );

                // Insere na tabela compra_item
                $this->db->insert('compra_item', $compraItem);
            }

            $this->session->set_flashdata('sucesso', 'Compra efetuada com sucesso.');

            redirect('funcionario/compra');
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));

            redirect('funcionario/compra/adicionar');
        }
    }

    public function visualizar($idcompra) {
        $data = array();
        $data['ACAO'] = 'Visualizar';
        $data['pagina_nome'] = 'historico-compra';

        $resultado = $this->CompraM->get(array("idcompra" => $idcompra), TRUE);

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

        $this->parser->parse('funcionario/compra_visualizar', $data);
    }

}
