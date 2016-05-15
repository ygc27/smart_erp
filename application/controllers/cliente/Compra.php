<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra extends CI_Controller {

    public $total;

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/venda_model', 'VendaM');
        $this->load->model('admin/sistema_model', 'SistemaM');
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

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'historico-compra';
        $data['URLADICIONAR'] = site_url('cliente/compra/adicionar');
        $data['URLLISTAR'] = site_url('cliente/compra');

        $data['compras'] = $this->db->get_where('venda', array(
                    'idcliente' => $this->session->userdata('idusuario')
                ))->result();


        $this->parser->parse('cliente/compra', $data);
    }

    public function visualizar($idvenda) {
        $data = array();
        $data['ACAO'] = 'Visualizar';
        $data['pagina_nome'] = 'historico-compra';

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

        $this->parser->parse('cliente/compra_visualizar', $data);
    }

}
