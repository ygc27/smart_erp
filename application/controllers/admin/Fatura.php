<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fatura extends CI_Controller {

    public $total;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/pedido_model', 'PedidoM');
        $this->load->model('admin/compra_model', 'CompraM');
        $this->load->model('admin/venda_model', 'VendaM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/perfil_model', 'PerfilM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function imprimir_pedido($idpedido) {
        $data = array();

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

    public function imprimir_compra($idcompra) {
        $data = array();

        $resultado = $this->CompraM->get(array("idcompra" => $idcompra), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $configuracoes = $this->db->get('configuracoes')->result();

        $data['nome_empresa'] = $configuracoes[0]->nome;
        $data['endereco_empresa'] = $configuracoes[0]->endereco;
        $data['telefone_empresa'] = $configuracoes[0]->telefone;
        $data['email_empresa'] = $configuracoes[0]->email;
        $data['moeda'] = $configuracoes[0]->moeda;

        $this->parser->parse('admin/imprimir_compra', $data);
    }

    public function imprimir_venda($idvenda) {
        $data = array();

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
