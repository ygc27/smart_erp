<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/cliente_model', 'ClienteM');
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
        $data['pagina_nome'] = 'produto';

        $data['produtos'] = $this->ProdutoM->get_all()->result();
        
        // Exibir o valor da (MOEDA)
        $configuracoes = $this->db->get('configuracoes')->result();

        $data['moeda'] = $configuracoes[0]->moeda;

        $this->parser->parse('cliente/produto', $data);
    }

    public function visualizar($idproduto) {
        $data = array();
        $data['pagina_nome'] = 'produto';
        $data['ACAO'] = 'Visualizar';

        $resultado = $this->ProdutoM->get(array("idproduto" => $idproduto), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        // Exibir o valor da (MOEDA)
        $configuracoes = $this->db->get('configuracoes')->result();

        $data['moeda'] = $configuracoes[0]->moeda;

        $categoria = $this->ProdutoM->get_all()->result();

        foreach ($categoria as $row) {
            if ($row->idcategoria > 0)
                $data['categoria'] = $this->db->get_where('categoria', array('idcategoria' => $row->idcategoria))->row()->nome;
        }

        $subcategoria = $this->ProdutoM->get_all()->result();

        foreach ($subcategoria as $row) {
            if ($row->idsubcategoria > 0)
                $data['subcategoria'] = $this->db->get_where('subcategoria', array('idsubcategoria' => $row->idsubcategoria))->row()->nome;
        }

        $this->parser->parse('cliente/produto_visualizar', $data);
    }

}
