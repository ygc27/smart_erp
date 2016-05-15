<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/cliente_model', 'ClienteM');
        $this->load->model('admin/perfil_model', 'PerfilM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/mensagem_model', 'MensagemM');
        $this->load->model('email_model', 'EmailM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'cliente';
        $data['URLADICIONAR'] = site_url('admin/cliente/adicionar');
        $data['URLLISTAR'] = site_url('admin/cliente');

        $data['clientes'] = $this->ClienteM->get_all()->result();

        $this->parser->parse('admin/cliente', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'cliente';
        $data['ACAO'] = 'Novo';
        $data['codigo_cliente'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['desconto'] = '0';
        $data['URLLISTAR'] = site_url('admin/cliente');

        $this->parser->parse('admin/cliente_form', $data);
    }

    // Retorna perfil usuário
    public function get_perfil() {
        $tipo_perfil = $this->input->post('tipo_perfil');

        if (!empty($tipo_perfil)) {
            echo $tipo_perfil;
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_valida_cpf($cpf = '') {
        $carateres = array('.', '-');
        
        $cpf = str_replace($carateres, '', $cpf);

        if (!empty($cpf)) {
            if (!validaCPF($cpf)) {
                // Retorna Inválido(1)
                echo 1;
            }

            //verifico se o cpf já esta cadastrado
            $this->db->where('cpf', $cpf);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                echo 2;
            }

            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_valida_cnpj() {
        $cnpj = $this->input->post('cnpj');

        $carateres = array('.', '/', '-');
        
        $cnpj = str_replace($carateres, '', $cnpj);

        if (!empty($cnpj)) {
            if (!validaCNPJ($cnpj)) {
                // Retorna Inválido(1)
                echo 1;
            }

            //verifico se o cnpj já esta cadastrado
            $this->db->where('cnpj', $cnpj);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                echo 2;
            }
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_valida_email() {
        $email = $this->input->post('email');

        if (!empty($email)) {
            //verifico se cliente já esta cadastrado
            $this->db->where('email', $email);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                echo 1;
            }
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function salvar() {
        $idcliente = $this->input->post('idcliente');
        $codigo_cliente = $this->input->post('codigo_cliente');
        $tipo_perfil = $this->input->post('tipo_perfil');
        $cpf = $this->input->post('cpf');
        $cnpj = $this->input->post('cnpj');
        $cliente = $this->input->post('cliente');
        $pessoa_contato = $this->input->post('pessoa_contato');
        $razao_social = $this->input->post('razao_social');
        $senha = $this->input->post('senha');
        $sexo = $this->input->post('sexo');
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
        $email = $this->input->post('email');
        $telefone = $this->input->post('telefone');
        $celular = $this->input->post('celular');
        $desconto = $this->input->post('desconto');
        $ativo = $this->input->post('ativo');

        $carateres = array('.', '-', '/');

        $cpf = str_replace($carateres, '', $cpf);
        $cnpj = str_replace($carateres, '', $cnpj);

        if ($tipo_perfil == 'pf') {
            $itens = array(
                "codigo_cliente" => $codigo_cliente,
                "tipo_perfil" => $tipo_perfil,
                "cpf" => $cpf,
                "nome" => $cliente,
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
                "desconto" => $desconto,
                "ativo" => $ativo ? $ativo : 'N'
            );

            if ($senha) {
                $itens['senha'] = sha1($senha);
            }
        } else {
            $itens = array(
                "codigo_cliente" => $codigo_cliente,
                "tipo_perfil" => $tipo_perfil,
                "cnpj" => $cnpj,
                "nome" => $cliente,
                "razao_social" => $razao_social,
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
                "desconto" => $desconto,
                "ativo" => $ativo ? $ativo : 'N'
            );

            if ($senha) {
                $itens['senha'] = sha1($senha);
            }
        }
        if ($idcliente) {

            $idcliente = $this->ClienteM->update($itens, $idcliente);

            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/cliente_imagem/" . $idcliente . '.jpg');

            $this->session->set_flashdata('sucesso', 'Cliente atualizado com sucesso.');
        } else {
            $idcliente = $this->ClienteM->post($itens);

            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/cliente_imagem/" . $idcliente . '.jpg');

            $this->session->set_flashdata('sucesso', 'Cliente cadastrado com sucesso.');

            $this->EmailM->abertura_conta_email('cliente', $email, $senha);
        }
        if ($idcliente) {
            redirect('admin/cliente');
        } else {
            $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

            if ($idcliente)
                redirect('admin/cliente/editar/' . $idcliente);
            else
                redirect('admin/cliente/adicionar');
        }
    }

    public function editar($idcliente) {
        $data = array();
        $data['ACAO'] = 'Edição';
        $data['pagina_nome'] = 'cliente';
        $data['URLLISTAR'] = site_url('admin/cliente');
        $resultado = $this->ClienteM->get(array("idcliente" => $idcliente), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }

            $data['uf_' . $resultado->uf] = 'selected="selected"';
            $data['uf_entrega_' . $resultado->uf_entrega] = 'selected="selected"';
            $data['sexo_' . $resultado->sexo] = 'checked="checked"';
            $data['ativo'] = ($resultado->ativo == 'S') ? 'checked="checked"' : null;
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $this->parser->parse('admin/cliente_form_editar', $data);
    }

    public function visualizar($idcliente) {
        $data = array();
        $data['ACAO'] = 'Visualizar';
        $data['pagina_nome'] = 'cliente';

        $resultado = $this->ClienteM->get(array("idcliente" => $idcliente), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $configuracoes = $this->db->get('configuracoes')->result();

        $data['moeda'] = $configuracoes[0]->moeda;

        $this->parser->parse('admin/cliente_form_visualizar', $data);
    }

    public function pendente() {
        $data = array();
        $data['pagina_nome'] = 'cliente';

        $data['clientes'] = $this->ClienteM->get_all()->result();

        $this->parser->parse('admin/cliente_pendente', $data);
    }

    public function aprovar($idcliente) {
        
        $this->db->where('idcliente', $idcliente);
        $resultado = $this->db->update('cliente', array('ativo' => 'S'));
        
        if ($resultado) {
            $this->session->set_flashdata('sucesso', 'Cliente aprovado com sucesso.');

            $email = $this->db->get_where('cliente', array('idcliente' => $idcliente))->row()->email;
            
            $this->EmailM->aprovacao_conta_email('cliente', $email);

            redirect('admin/cliente');
        } else {
            $this->session->set_flashdata('erro', 'Erro ao aprovar o cliente.');

            redirect('admin/cliente');
        }
    }

    public function excluir($idcliente) {
        $resultado = $this->ClienteM->delete($idcliente);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Cliente excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/cliente');
    }

}
