<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CodigoBarra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/codigobarra_model', 'CodigoBarraM');
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
        $data['pagina_nome'] = 'codigo-barra';

        $data['codigos_barra'] = $this->ProdutoM->get_all()->result();
        
        $this->parser->parse('admin/produto_codigobarra', $data);
    }

    public function criar($codigoproduto = '') {
        $data = array();
        $data['pagina_nome'] = 'codigo-barra';

        $this->CodigoBarraM->criar_codigo_barra($codigoproduto);

        $this->parser->parse('admin/produto_codigobarra', $data);
    }

}
