<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/funcionario_model', 'FuncionarioM');
        $this->load->model('funcionario/perfil_model', 'PerfilM');
        if (!$this->session->userdata('funcionario_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'dashboard';

        // Lista produtos em estoque (Nome, Quantidade)
        $this->db->select('p.idproduto, SUM(pe.quantidade) as estoque , p.nome');
        $this->db->from('produto p');
        $this->db->join('produto_estoque pe', 'pe.idproduto = p.idproduto');
        $this->db->group_by("p.idproduto, p.nome");
        $data['produtos'] = $this->db->get()->result();

        // Exibe o valor total de pagamento dos ultimos 30 dias pelo (Lucro/Despesa)
        $data_inicio = strtotime('-29 days');
        $data_inicio = date('Y-m-d', $data_inicio);
        $data_fim = date("Y-m-d");
        $data['lucro'] = 0;
        $data['despesa'] = 0;
        $this->db->order_by('cadastro', 'desc');
        $this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data_inicio);
        $this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data_fim);
        $data['pagamentos'] = $this->db->get('pagamento')->result();

        foreach ($data['pagamentos'] as $row) {
            if ($row->tipo == 'Credito') {
                $valor = str_replace(".", "", $row->valor);
                $data['lucro'] += $valor;
            }
            if ($row->tipo == 'Debito') {
                $valor = str_replace(".", "", $row->valor);
                $data['despesa'] += $valor;
            }
        }

        $this->parser->parse('funcionario/dashboard', $data);
    }

}
