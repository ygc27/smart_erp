<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/cliente_model', 'ClienteM');
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
        $data['pagina_nome'] = 'dashboard';

        // Exibir o valor da (MOEDA)
        $configuracoes = $this->db->get('configuracoes')->result();
        $data['moeda'] = $configuracoes[0]->moeda;

        // Lista os ultimos 10 pedidos
        $this->db->where('idcliente', $this->session->userdata('idusuario'));
        $this->db->order_by('data_cadastro', 'desc');
        $this->db->limit(10);
        $data['pedidos'] = $this->db->get('pedido')->result();

        $this->parser->parse('cliente/dashboard', $data);
    }

    public function get_resumo() {
        $id_produto = $this->input->post('id_produto');

        $this->db->where('idproduto', $id_produto);
        $produto = $this->db->get('produto')->result();

        // Exibir o valor da (MOEDA)
        $configuracoes = $this->db->get('configuracoes')->result();

        $categoria = $this->ProdutoM->get_all()->result();

        foreach ($categoria as $row) {
            if ($row->idcategoria > 0)
                $categoria = $this->db->get_where('categoria', array('idcategoria' => $produto[0]->idcategoria))->row()->nome;
        }

        $subcategoria = $this->ProdutoM->get_all()->result();

        foreach ($subcategoria as $row) {
            if ($row->idsubcategoria > 0)
                $subcategoria = $this->db->get_where('subcategoria', array('idsubcategoria' => $produto[0]->idsubcategoria))->row()->nome;
        }


        echo '<img src="' . $this->ProdutoM->get_image_url("produto", $produto[0]->idproduto) . '" width="150" height="150">';
        echo '<br /><br />';
        echo '<table class="table table-bordered">
                <tr>
                    <td><b>Código do Produto</b></td>
                    <td>' . $produto[0]->codigoproduto . '</td>
                </tr>
                <tr>
                    <td><b>Produto</b></td>
                    <td>' . $produto[0]->nome . '</td>
                </tr>
                 <tr>
                    <td><b>Modelo</b></td>
                    <td>' . $produto[0]->modelo . '</td>
                </tr>
                <tr>
                    <td><b>Categoria</b></td>
                    <td>' . $categoria . '</td>
                </tr>
                <tr>
                    <td><b>Subcategoria</b></td>
                    <td>' . $subcategoria . '</td>
                </tr>
                <tr>
                    <td><b>Dimensões</b></td>
                    <td>' . $produto[0]->dimensoes . " " . $produto[0]->tipo_comprimento . '</td>
                </tr>
                <tr>
                    <td><b>Peso</b></td>
                    <td>' . $produto[0]->peso . " " . $produto[0]->tipo_peso . '</td>
                </tr>
                <tr>
                    <td><b>Preço de Venda</b></td>
                    <td>' . $configuracoes[0]->moeda . " " . modificaNumericValor($produto[0]->precovenda) . '</td>
                </tr>
                <tr>
                    <td><b>Descrição</b></td>
                    <td>' . $produto[0]->descricao . '</td>
                </tr>
            </table>';

        exit;
    }

}
