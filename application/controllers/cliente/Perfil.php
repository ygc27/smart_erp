<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
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
        $data['ACAOPERFIL'] = 'Informações Básicas';
        $data['ACAOSENHA'] = 'Alterar Senha';
        $data['pagina_nome'] = 'perfil';

        $this->db->where('idcliente', $this->session->userdata('idusuario'));
        $data['usuario'] = $this->db->get('cliente')->result();

        $this->parser->parse('cliente/perfil', $data);
    }

    public function salvar() {
        $idcliente = $this->input->post('idcliente');
        $tipo_perfil = $this->input->post('tipo_perfil');
        $pessoa_contato = $this->input->post('pessoa_contato');
        $sexo = $this->input->post('sexo');
        $telefone = $this->input->post('telefone');
        $celular = $this->input->post('celular');
        $email = $this->input->post('email');
        $cep = $this->input->post('cep');
        $cep_entrega = $this->input->post('cep_entrega');
        $endereco = $this->input->post('endereco');
        $endereco_entrega = $this->input->post('endereco_entrega');
        $numero = $this->input->post('numero');
        $numero_entrega = $this->input->post('numero_entrega');
        $complemento = $this->input->post('complemento');
        $complemento_entrega = $this->input->post('complemento_entrega');
        $bairro = $this->input->post('bairro');
        $bairro_entrega = $this->input->post('bairro_entrega');
        $cidade = $this->input->post('cidade');
        $cidade_entrega = $this->input->post('cidade_entrega');
        $uf = $this->input->post('uf');
        $uf_entrega = $this->input->post('uf_entrega');

        if ($tipo_perfil == 'pf') {
            $itens = array(
                "email" => $email,
                "sexo" => $sexo,
                "cep" => $cep,
                "cep_entrega" => $cep_entrega,
                "endereco" => $endereco,
                "endereco_entrega" => $endereco_entrega,
                "numero" => $numero,
                "numero_entrega" => $numero_entrega,
                "complemento" => $complemento,
                "complemento_entrega" => $complemento_entrega,
                "bairro" => $bairro,
                "bairro_entrega" => $bairro_entrega,
                "cidade" => $cidade,
                "cidade_entrega" => $cidade_entrega,
                "uf" => $uf,
                "uf_entrega" => $uf_entrega,
                "telefone" => $telefone,
                "celular" => $celular,
            );
        } else {
            $itens = array(
                "pessoa_contato" => $pessoa_contato,
                "email" => $email,
                "cep" => $cep,
                "cep_entrega" => $cep_entrega,
                "endereco" => $endereco,
                "endereco_entrega" => $endereco_entrega,
                "numero" => $numero,
                "numero_entrega" => $numero_entrega,
                "complemento" => $complemento,
                "complemento_entrega" => $complemento_entrega,
                "bairro" => $bairro,
                "bairro_entrega" => $bairro_entrega,
                "cidade" => $cidade,
                "cidade_entrega" => $cidade_entrega,
                "uf" => $uf,
                "uf_entrega" => $uf_entrega,
                "telefone" => $telefone,
                "celular" => $celular,
            );
        }
        $this->db->where('idcliente', $idcliente, FALSE);
        $this->PerfilM->update($itens);

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/cliente_imagem/" . $idcliente . '.jpg');

        $this->session->set_flashdata('sucesso', 'Perfil atualizado com sucesso.');
        redirect('cliente/perfil');
    }

    public function salvar_senha() {
        $idcliente = $this->input->post('idcliente');

        $data['senha'] = sha1($this->input->post('senha'));
        $data['nova_senha'] = sha1($this->input->post('nova_senha'));
        $data['confirme_senha'] = sha1($this->input->post('confirme_senha'));

        $senha_atual = $this->db->get_where('cliente', array(
                    'idcliente' => $idcliente
                ))->row()->senha;
        if ($senha_atual == $data['senha'] && $data['nova_senha'] == $data['confirme_senha']) {

            $this->db->where('idcliente', $idcliente, FALSE);
            $this->db->update('cliente', array(
                'senha' => $data['nova_senha']
            ));
            $this->session->set_flashdata('sucesso', 'Senha alterada com sucesso.');

            redirect('cliente/perfil');
        } else {
            $this->session->set_flashdata('erro', 'Senhas não coincidem.');
            if ($idcliente) {
                redirect('cliente/perfil');
            }
        }
    }

}
