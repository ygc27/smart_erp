<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cadastro_Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_LOGIN;
        $this->load->model('email_model', 'EmailM');
    }

    public function index() {

        $this->load->view('cadastro_cliente');
    }

    public function salvar() {
        $data['codigo_cliente'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['tipo_perfil'] = $this->input->post('tipo_perfil');
        $data['cpf'] = $this->input->post('cpf');
        $data['cnpj'] = $this->input->post('cnpj');
        $data['cliente'] = $this->input->post('cliente');
        $data['pessoa_contato'] = $this->input->post('pessoa_contato');
        $data['razao_social'] = $this->input->post('razao_social');
        $data['sexo'] = $this->input->post('sexo');
        $data['telefone'] = $this->input->post('telefone');
        $data['celular'] = $this->input->post('celular');
        $data['email'] = $this->input->post('email');
        $data['senha'] = sha1($this->input->post('senha'));
        $data['confirme_senha'] = sha1($this->input->post('confirme_senha'));
        $data['ativo'] = $this->input->post('ativo');

        $carateres = array('.', '-', '/');

        $data['cpf'] = str_replace($carateres, '', $data['cpf']);
        $data['cnpj'] = str_replace($carateres, '', $data['cnpj']);

        $erros = FALSE;
        $mensagem = null;

        if (!$data['cpf']) {
            $erros = TRUE;
            $mensagem .= "Informe o CPF.\n";
        } else {
            if (!validaCPF($data['cpf'])) {
                $erros = TRUE;
                $mensagem .= "CPF informado é inválido.\n";
            } else {
                //verifico se cpf já esta cadastrado
                $this->db->where('cpf', $data['cpf']);
                $query = $this->db->get('cliente');

                if ($query->num_rows() == 1) {
                    $this->session->set_flashdata('erro', 'CPF já cadastrado no sistema.');

                    redirect('cadastro_cliente');
                }
            }
        }

        if (!$data['cnpj']) {
            $erros = TRUE;
            $mensagem .= "Informe o CNPJ.\n";
        } else {
            if (!validaCNPJ($data['cnpj'])) {
                $erros = TRUE;
                $mensagem .= "CNPJ informado é inválido.\n";
            } else {
                //verifico se cnpj já esta cadastrado
                $this->db->where('cnpj', $data['cnpj']);
                $query = $this->db->get('cliente');

                if ($query->num_rows() == 1) {
                    $this->session->set_flashdata('erro', 'CNPJ já cadastrado no sistema.');

                    redirect('cadastro_cliente');
                }
            }
        }

        if ($data['senha'] == $data['confirme_senha']) {

            //verifico se cliente já esta cadastrado
            $this->db->where('email', $data['email']);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                $this->session->set_flashdata('erro', 'Email já cadastrado no sistema.');

                redirect('cadastro_cliente');
            } else {
                if ($data['tipo_perfil'] == 'pf') {
                    // Insere registro perfil_pf
                    $data = array(
                        'codigo_cliente' => $data['codigo_cliente'],
                        'tipo_perfil' => $data['tipo_perfil'],
                        'nome' => $data['cliente'],
                        'cpf' => $data['cpf'],
                        'sexo' => $data['sexo'],
                        'telefone' => $data['telefone'],
                        'celular' => $data['celular'],
                        'email' => $data['email'],
                        'senha' => $data['senha'],
                        'ativo' => 'N'
                    );

                    $this->db->insert('cliente', $data);

                    $this->session->set_flashdata('sucesso', 'Conta criada com sucesso. Verifique seu email para concluir o cadastro.');

                    $this->EmailM->enviar_email_confirmacao($data);
                } else {

                    // Insere registro perfil_pj
                    $data = array(
                        'codigo_cliente' => $data['codigo_cliente'],
                        'tipo_perfil' => $data['tipo_perfil'],
                        'nome' => $data['cliente'],
                        'cnpj' => $data['cnpj'],
                        'razao_social' => $data['razao_social'],
                        'pessoa_contato' => $data['pessoa_contato'],
                        'telefone' => $data['telefone'],
                        'celular' => $data['celular'],
                        'email' => $data['email'],
                        'senha' => $data['senha'],
                        'ativo' => 'N'
                    );

                    $this->db->insert('cliente', $data);

                    $this->session->set_flashdata('sucesso', 'Conta criada com sucesso. Verifique seu email para concluir o cadastro.');
                    
                    $this->EmailM->enviar_email_confirmacao($data);
                }
                redirect('cadastro_cliente');
            }
        } else {
            $this->session->set_flashdata('erro', 'Senhas não coincidem.');

            redirect('cadastro_cliente');
        }
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
                $retorno = 1;
                echo json_encode($retorno);
            }

            //verifico se o cpf já esta cadastrado
            $this->db->where('cpf', $cpf);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                $retorno = 2;
                echo json_encode($retorno);
            }

            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_valida_cnpj() {
        $cnpj = $this->input->post('cnpj');

        $carateres = array('.', '-', '/');

        $cnpj = str_replace($carateres, '', $cnpj);

        if (!empty($cnpj)) {
            if (!validaCNPJ($cnpj)) {
                // Retorna Inválido(1)
                $retorno = 1;
                echo json_encode($retorno);
            }

            //verifico se o cnpj já esta cadastrado
            $this->db->where('cnpj', $cnpj);
            $query = $this->db->get('cliente');

            if ($query->num_rows() == 1) {
                $retorno = 2;
                echo json_encode($retorno);
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
            $cliente = $this->db->get('cliente');

            if ($cliente->num_rows() == 1) {
                $retorno = 1;
                echo json_encode($retorno);
            }
            
            //verifico se funcionario já esta cadastrado
            $this->db->where('email', $email);
            $funcionario = $this->db->get('funcionario');

            if ($funcionario->num_rows() == 1) {
                $retorno = 1;
                echo json_encode($retorno);
            }
            
             //verifico se admin já esta cadastrado
            $this->db->where('email', $email);
            $admin = $this->db->get('admin');

            if ($admin->num_rows() == 1) {
                $retorno = 1;
                echo json_encode($retorno);
            }
            
            
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function validacao_cadastro($email) {

        $data_atual = strtotime(date('Y/m/d H:i:s'));

        $this->db->where('md5(email)', $email);
        $data['cliente'] = $this->db->get('cliente')->result();

        $data_cadastro = strtotime($data['cliente'][0]->cadastro . "+30 minutes");

        if ($data_atual <= $data_cadastro) {
            $this->load->view('concluir_cadastro', $data);
        } else {
            //echo "Sessão Expirada.";
            redirect('cadastro_cliente');
        }
    }

    public function concluir_cadastro($idcliente) {
        $idcliente = $this->input->post('idcliente');
        $data['cep'] = $this->input->post('cep');
        $data['cep_entrega'] = $this->input->post('cep_entrega');
        $data['endereco'] = $this->input->post('endereco');
        $data['endereco_entrega'] = $this->input->post('endereco_entrega');
        $data['numero'] = $this->input->post('numero');
        $data['numero_entrega'] = $this->input->post('numero_entrega');
        $data['complemento'] = $this->input->post('complemento');
        $data['complemento_entrega'] = $this->input->post('complemento_entrega');
        $data['bairro'] = $this->input->post('bairro');
        $data['bairro_entrega'] = $this->input->post('bairro_entrega');
        $data['cidade'] = $this->input->post('cidade');
        $data['cidade_entrega'] = $this->input->post('cidade_entrega');
        $data['uf'] = $this->input->post('uf');
        $data['uf_entrega'] = $this->input->post('uf_entrega');

        if ($idcliente) {
            $this->db->where('idcliente', $idcliente);
            $this->db->update('cliente', $data);

            $this->session->set_flashdata('sucesso', 'Cadastro concluído. Aguarde aprovação.');

            $this->EmailM->solicitacao_conta_cliente_email('Cliente', $data['email'], $data['cliente']);

            redirect('login');
        } else {
            $this->session->set_flashdata('erro', 'Houve um erro ao processar seu cadastro.');

            redirect('cadastro_cliente');
        }
    }

}
