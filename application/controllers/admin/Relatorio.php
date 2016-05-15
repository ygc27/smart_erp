<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/perfil_model', 'PerfilM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/mensagem_model', 'MensagemM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function cliente() {
        $data = array();
        $data['pagina_nome'] = 'relatorio-cliente';

        if ($this->input->post('data_inicio') != "") {
            $data['data_inicio'] = dateBR2MySQL($this->input->post('data_inicio'));
            $data['data_fim'] = dateBR2MySQL($this->input->post('data_fim'));
        } else {
            $data['data_inicio'] = strtotime('-29 days');
            $data['data_inicio'] = date('Y-m-d', $data['data_inicio']);
            $data['data_fim'] = date('Y-m-d');
        }

        $data['pagamentos'] = $this->db->select('idcliente, tipo, forma_pagamento, valor, cadastro')
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data['data_inicio'])
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data['data_fim'])
                        ->where('idcliente !=', 0)
                        ->group_by('idcliente')
                        ->order_by('cadastro', 'desc')
                        ->get('pagamento')->result();

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $this->load->view('admin/relatorio_cliente', $data);
    }

    public function fornecedor() {
        $data = array();
        $data['pagina_nome'] = 'relatorio-fornecedor';

        if ($this->input->post('data_inicio') != "") {
            $data['data_inicio'] = dateBR2MySQL($this->input->post('data_inicio'));
            $data['data_fim'] = dateBR2MySQL($this->input->post('data_fim'));
        } else {
            $data['data_inicio'] = strtotime('-29 days');
            $data['data_inicio'] = date('Y-m-d', $data['data_inicio']);
            $data['data_fim'] = date('Y-m-d');
        }

        $data['pagamentos'] = $this->db->select('idfornecedor, tipo, forma_pagamento, valor, cadastro')
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data['data_inicio'])
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data['data_fim'])
                        ->where('idfornecedor !=', 0)
                        ->group_by('idfornecedor')
                        ->order_by('cadastro', 'desc')
                        ->get('pagamento')->result();

        //echo "<pre>";
        //print_r($data['pagamentos']);die;

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $this->load->view('admin/relatorio_fornecedor', $data);
    }

    public function pagamento() {
        $data = array();
        $data['pagina_nome'] = 'relatorio-pagamento';

        if ($this->input->post('data_inicio') != "") {
            $data['data_inicio'] = dateBR2MySQL($this->input->post('data_inicio'));
            $data['data_fim'] = dateBR2MySQL($this->input->post('data_fim'));
        } else {
            $data['data_inicio'] = strtotime('-29 days');
            $data['data_inicio'] = date('Y-m-d', $data['data_inicio']);
            $data['data_fim'] = date('Y-m-d');
        }

        $data['pagamentos'] = $this->db->select('idcliente, idfornecedor, tipo, forma_pagamento, valor, cadastro')
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data['data_inicio'])
                        ->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data['data_fim'])
                        ->where('idcliente !=', 0)
                        ->or_where('idfornecedor !=', 0)
                        ->order_by('cadastro', 'desc')
                        ->get('pagamento')->result();

        //echo "<pre>";
        //print_r($data['pagamentos']);
        //die;

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        if ($configuracoes) {
            foreach ($configuracoes as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $data['total_lucro'] = 0;
        $data['total_despesa'] = 0;
        $data['total_pagamentos'] = $this->db->get('pagamento')->result();

        foreach ($data['total_pagamentos'] as $row) {
            if ($row->tipo == 'Credito') {
                $data['total_lucro'] += $row->valor;
            }
            if ($row->tipo == 'Debito') {
                $data['total_despesa'] += $row->valor;
            }
        }

        $this->load->view('admin/relatorio_pagamento', $data);
    }

}
