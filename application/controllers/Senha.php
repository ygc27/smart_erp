<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Senha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_LOGIN;
        $this->load->model('email_model', 'EmailM');
    }

    public function index() {

        $this->load->view('senha');
    }

    public function nova() {
        $email = $this->input->post('email');
        $tipo_conta = '';
        // Redefinir a senha
        $nova_senha = substr(md5(rand(100000000, 20000000000)), 0, 7);
        $senha_criptografada = sha1($nova_senha);

        // Verificar as credenciais do admin
        $admin = $this->db->get_where('admin', array(
            'email' => $email
        ));

        if ($admin->num_rows() > 0) {
            $tipo_conta = 'admin';
            $this->db->where('email', $email);
            $this->db->update('admin', array(
                'senha' => $senha_criptografada
            ));
            $this->session->set_flashdata('sucesso', 'Por favor, verifique seu email. Nova senha enviada.');
            // Envia mensagem para o admin com nova senha
            $email_to = $email;
            $nova_senha = $nova_senha;
            $this->EmailM->redefinir_senha_email($nova_senha, $email_to);
            redirect('login');
        }
        //  // Verificar as credenciais do cliente
        $cliente = $this->db->get_where('cliente', array(
            'email' => $email
        ));
        if ($cliente->num_rows() > 0) {
            $tipo_conta = 'cliente';
            $this->db->where('email', $email);
            $this->db->update('cliente', array(
                'senha' => $senha_criptografada
            ));
            $this->session->set_flashdata('sucesso', 'Por favor, verifique seu email. Nova senha enviada.');
            // Envia mensagem para o cliente com nova senha
            $email_to = $email;
            $nova_senha = $nova_senha;
            $this->EmailM->redefinir_senha_email($nova_senha, $email_to);
            redirect('login');
        }
        //  // Verificar as credenciais do funcionario
        $funcionario = $this->db->get_where('funcionario', array(
            'email' => $email
        ));
        if ($funcionario->num_rows() > 0) {
            $tipo_conta = 'funcionario';
            $this->db->where('email', $email);
            $this->db->update('funcionario', array(
                'senha' => $senha_criptografada
            ));
            $this->session->set_flashdata('sucesso', 'Por favor, verifique seu email. Nova senha enviada.');
            // Envia mensagem para o funcionário com nova senha
            $email_to = $email;
            $nova_senha = $nova_senha;
            $this->EmailM->redefinir_senha_email($nova_senha, $email_to);
            redirect('login');
        } else {
            $this->session->set_flashdata('erro', 'Este email não possui cadastro no sistema !!!');
            redirect('senha');
        }
    }

}
