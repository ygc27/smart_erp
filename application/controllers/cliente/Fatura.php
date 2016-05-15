<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fatura extends CI_Controller {

    public $total;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/venda_model', 'VendaM');
        $this->load->model('admin/pedido_model', 'PedidoM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('cliente/perfil_model', 'PerfilM');
        if (!$this->session->userdata('cliente_login')) {
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

        $this->load->view('cliente/imprimir_pedido', $data);
    }

    public function imprimir_compra($idcompra) {
        $data = array();

        $resultado = $this->VendaM->get(array("idvenda" => $idcompra), TRUE);

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

        $this->load->view('cliente/imprimir_compra', $data);
    }

}
