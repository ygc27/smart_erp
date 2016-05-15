<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'dashboard';

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

        //echo "<pre>";
        //print_r($data['pagamentos']);die;

        foreach ($data['pagamentos'] as $row) {
            if ($row->tipo == 'Credito') {
                $data['lucro'] += $row->valor;
            }
            if ($row->tipo == 'Debito') {
                $data['despesa'] += $row->valor;
            }
        }

        // Lista configurações do Sistema (MOEDA)
        $resultado = $this->SistemaM->get(array(), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        // Lista produtos em estoque (Nome, Quantidade)
        $this->db->select('p.idproduto, SUM(pe.quantidade) as estoque , p.nome');
        $this->db->from('produto p');
        $this->db->join('produto_estoque pe', 'pe.idproduto = p.idproduto');
        $this->db->group_by("p.idproduto, p.nome");
        $data['produtos'] = $this->db->get()->result();

        // Lista Pagamento de Clientes ultimos 30 dias
        $data_inicio = strtotime('-29 days');
        $data_inicio = date('Y-m-d', $data_inicio);
        $data_fim = date("Y-m-d");
        $this->db->select_sum('valor');
        $this->db->select('idcliente, cadastro');
        $this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") >=', $data_inicio);
        $this->db->where('DATE_FORMAT(cadastro, "%Y-%m-%d") <=', $data_fim);
        $this->db->where('idcliente !=', 0);
        $this->db->group_by('idcliente');
        $this->db->order_by('cadastro', 'desc');
        $data['pagamento_cliente'] = $this->db->get('pagamento')->result();

        $this->parser->parse('admin/dashboard', $data);
    }

}
