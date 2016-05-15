<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfil extends CI_Controller {

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
        $data['ACAOPERFIL'] = 'Informações Básicas';
        $data['ACAOSENHA'] = 'Alterar Senha';
        $data['pagina_nome'] = 'perfil';
        $data['id'] = '';
        $data['nome'] = '';
        $data['email'] = '';

        $this->parser->parse('funcionario/perfil', $data);
    }

    public function salvar() {

        $id = $this->input->post('idfuncionario');
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');

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

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "email" => $email
            );

            $this->db->where('idfuncionario', $id, FALSE);
            $this->PerfilM->update($itens);

            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/funcionario_imagem/" . $id . '.jpg');

            $this->session->set_flashdata('sucesso', 'Perfil atualizado com sucesso.');
            redirect('funcionario/perfil');
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            redirect('funcionario/perfil');
        }
    }

    public function salvar_senha() {
        $id = $this->input->post('idfuncionario');

        $data['senha'] = sha1($this->input->post('senha'));
        $data['nova_senha'] = sha1($this->input->post('nova_senha'));
        $data['confirme_senha'] = sha1($this->input->post('confirme_senha'));

        $senha_atual = $this->db->get_where('funcionario', array(
                    'idfuncionario' => $id
                ))->row()->senha;
        if ($senha_atual == $data['senha'] && $data['nova_senha'] == $data['confirme_senha']) {

            $this->db->where('idfuncionario', $id, FALSE);
            $this->db->update('funcionario', array(
                'senha' => $data['nova_senha']
            ));
            $this->session->set_flashdata('sucesso', 'Senha alterada com sucesso.');

            redirect('funcionario/perfil');
        } else {
            $this->session->set_flashdata('erro', 'Senhas não coincidem.');
            if ($id) {
                redirect('funcionario/perfil');
            }
        }
    }

}
