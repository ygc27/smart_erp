<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Codigos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/produto_model', 'ProdutoM');
        if (!$this->session->userdata('admin_login')) {
            redirect('login');
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function imprimir() {
        $data = array();

        $data['codigos_barra'] = $this->ProdutoM->get_all()->result();

        $this->load->view('admin/imprimir_codigo_barra', $data);
    }

}
