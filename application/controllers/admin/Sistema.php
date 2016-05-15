<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sistema extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/sistema_model', 'SistemaM');
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
        $data['ACAO'] = 'Informações Gerais';
        $data['pagina_nome'] = 'sistema';
        $data['id'] = '';
        $data['nome'] = '';
        $data['email'] = '';
        $data['email_paypal'] = '';
        $data['endereco'] = '';
        $data['telefone'] = '';
        $data['moeda'] = '';
        $data['imposto'] = '';

        $resultado = $this->SistemaM->get(array(), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $this->parser->parse('admin/configuracao_sistema', $data);
    }

    public function salvar() {
        $id = $this->input->post('id');
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $email_paypal = $this->input->post('email_paypal');
        $endereco = $this->input->post('endereco');
        $telefone = $this->input->post('telefone');
        $moeda = $this->input->post('moeda');
        $imposto = $this->input->post('imposto');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        }
        if (!$email) {
            $erros = TRUE;
            $mensagem .= "O campo email é obrigatorio.\n";
        }
        if (!$email_paypal) {
            $erros = TRUE;
            $mensagem .= "O campo email do paypal é obrigatorio.\n";
        }
        if (!$endereco) {
            $erros = TRUE;
            $mensagem .= "O campo endereço é obrigatorio.\n";
        }
        if (!$telefone) {
            $erros = TRUE;
            $mensagem .= "O campo telefone é obrigatorio.\n";
        }
        if (!$moeda) {
            $erros = TRUE;
            $mensagem .= "O campo moeda é obrigatorio.\n";
        }
        if (!$imposto) {
            $erros = TRUE;
            $mensagem .= "O campo % de imposto é obrigatorio.\n";
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "email" => $email,
                "email_paypal" => $email_paypal,
                "endereco" => $endereco,
                "telefone" => $telefone,
                "moeda" => $moeda,
                "imposto" => $imposto
            );

            $this->SistemaM->update($itens);

            $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso.');
            redirect('admin/sistema');
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            redirect('admin/sistema');
        }
    }

    public function backup() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        write_file('/path/to/bk_smart_erp.gz', $backup);
        $this->load->helper('download');
        force_download('bk_smart_erp.gz', $backup);
    }

}
