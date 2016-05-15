<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_LOGIN;
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        if ($this->session->userdata('tipo_login') == 'admin')
            redirect(base_url('admin/dashboard'), 'refresh');
        if ($this->session->userdata('tipo_login') == 'cliente')
            redirect(base_url('cliente/dashboard'), 'refresh');
        if ($this->session->userdata('tipo_login') == 'funcionario')
            redirect(base_url('funcionario/dashboard'), 'refresh');
        $this->load->view('login');
    }

    public function acesso() {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        // Autenticação do Admin
        $query = $this->db->get_where('admin', array(
            'email' => $email,
            'senha' => sha1($senha)
        ));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('tipo_login', 'admin');
            $this->session->set_userdata('idusuario', $row->idadmin);
            $this->session->set_userdata('nome', $row->nome);
            redirect(base_url('admin/dashboard'), 'refresh');
        }
        // Autenticação do Cliente
        $query = $this->db->get_where('cliente', array(
            'email' => $email,
            'senha' => sha1($senha),
            'ativo' => 'S'
        ));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('cliente_login', '1');
            $this->session->set_userdata('tipo_login', 'cliente');
            $this->session->set_userdata('idusuario', $row->idcliente);
            $this->session->set_userdata('cliente', $row->nome);
            redirect(base_url('cliente/dashboard'), 'refresh');
        }
        // Autenticação do Funcionário
        $query = $this->db->get_where('funcionario', array(
            'email' => $email,
            'senha' => sha1($senha),
            'ativo' => 'S'
        ));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('funcionario_login', '1');
            $this->session->set_userdata('tipo_login', 'funcionario');
            $this->session->set_userdata('idusuario', $row->idfuncionario);
            $this->session->set_userdata('nome', $row->nome);
            redirect(base_url('funcionario/dashboard'), 'refresh');
        } else {
            $this->session->set_flashdata('erro', 'Login ou senha inválidos.');
            redirect(base_url("login"));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }

}
