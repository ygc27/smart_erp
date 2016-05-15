<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

    public $nome;

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/fornecedor_model', 'FornecedorM');
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
        $data['pagina_nome'] = 'fornecedor';
        $data['URLADICIONAR'] = site_url('admin/fornecedor/adicionar');
        $data['URLLISTAR'] = site_url('admin/fornecedor');

        $data['fornecedor'] = $this->FornecedorM->get_all()->result();

        $this->parser->parse('admin/fornecedor', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'fornecedor';
        $data['ACAO'] = 'Novo';
        $data['idfornecedor'] = '';
        $data['URLLISTAR'] = site_url('admin/fornecedor');

        $this->parser->parse('admin/fornecedor_form', $data);
    }

    public function get_valida_email() {
        $email = $this->input->post('email');

        if (!empty($email)) {
            //verifico se fornecedor já esta cadastrado
            $this->db->where('email', $email);
            $query = $this->db->get('fornecedor');

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
        $idfornecedor = $this->input->post('idfornecedor');
        $fornecedor = $this->input->post('fornecedor');
        $nome = $this->input->post('nome');
        $sexo = $this->input->post('sexo');
        $cep = $this->input->post('cep');
        $endereco = $this->input->post('endereco');
        $cidade = $this->input->post('cidade');
        $uf = $this->input->post('uf');
        $email = $this->input->post('email');
        $telefone = $this->input->post('telefone');
        $celular = $this->input->post('celular');
        $banco = $this->input->post('banco');
        $agencia = $this->input->post('agencia');
        $conta = $this->input->post('conta');

        $erros = FALSE;
        $mensagem = null;

        if (!$fornecedor) {
            $erros = TRUE;
            $mensagem .= "O campo fornecedor é obrigatorio.\n";
        }

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } /* else {
          $nomeUsado = $this->FornecedorM->validaNomeDuplicado($idfornecedor, $nome);
          if ($nomeUsado > 0) {
          $erros = TRUE;
          $mensagem .= "Este Nome já está sendo utilizado.\n";
          }
          } */

        if (!$cep) {
            $erros = TRUE;
            $mensagem .= "O campo cep é obrigatorio.\n";
        }

        if (!$endereco) {
            $erros = TRUE;
            $mensagem .= "O campo endereço é obrigatorio.\n";
        }

        if (!$cidade) {
            $erros = TRUE;
            $mensagem .= "O campo cidade é obrigatorio.\n";
        }

        if (!$email) {
            $erros = TRUE;
            $mensagem .= "O campo email é obrigatorio.\n";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros = TRUE;
                $mensagem .= "Este email é inválido.\n";
            } else {
                $total = $this->FornecedorM->valida_email_duplicado($idfornecedor, $email);
                if ($total > 0) {
                    $erros = TRUE;
                    $mensagem .= "Este email já está sendo utilizado.\n";
                }
            }
        }
        if (!$telefone) {
            $erros = TRUE;
            $mensagem .= "O campo telefone é obrigatorio.\n";
        }

        if (!$celular) {
            $erros = TRUE;
            $mensagem .= "O campo celular é obrigatorio.\n";
        }
        if (!$banco) {
            $erros = TRUE;
            $mensagem .= "Selecione um banco.\n";
        }
        if (!$agencia) {
            $erros = TRUE;
            $mensagem .= "O campo agencia é obrigatorio.\n";
        }
        if (!$conta) {
            $erros = TRUE;
            $mensagem .= "O campo conta é obrigatorio.\n";
        }

        if (!$erros) {
            $itens = array(
                "fornecedor" => $fornecedor,
                "nome" => $nome,
                "sexo" => $sexo,
                "cep" => $cep,
                "endereco" => $endereco,
                "cidade" => $cidade,
                "uf" => $uf,
                "email" => $email,
                "telefone" => $telefone,
                "celular" => $celular,
                "banco" => $banco,
                "agencia" => $agencia,
                "conta" => $conta
            );

            if ($idfornecedor) {
                $idfornecedor = $this->FornecedorM->update($itens, $idfornecedor);

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/fornecedor_imagem/" . $idfornecedor . '.jpg');

                $this->session->set_flashdata('sucesso', 'Fornecedor atualizado com sucesso.');
            } else {
                $idfornecedor = $this->FornecedorM->post($itens);

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/fornecedor_imagem/" . $idfornecedor . '.jpg');

                $this->session->set_flashdata('sucesso', 'Fornecedor cadastrado com sucesso.');
            }
            if ($idfornecedor) {
                redirect('admin/fornecedor');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idfornecedor)
                    redirect('admin/fornecedor/editar/' . $idfornecedor);
                else
                    redirect('admin/fornecedor/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idfornecedor)
                redirect('admin/fornecedor/editar/' . $idfornecedor);
            else
                redirect('admin/fornecedor/adicionar');
        }
    }

    public function editar($idfornecedor) {
        $data = array();
        $data['pagina_nome'] = 'fornecedor';
        $data ['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/fornecedor');

        $resultado = $this->FornecedorM->get(array("idfornecedor" => $idfornecedor), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $data['uf_' . $resultado->uf] = 'selected="selected"';
        $data['sexo_' . $resultado->sexo] = 'checked="checked"';

        $this->parser->parse('admin/fornecedor_form_editar', $data);
    }

    public function visualizar($idfornecedor) {
        $data = array();
        $data['pagina_nome'] = 'fornecedor';
        $data['ACAO'] = 'Visualizar';

        $resultado = $this->FornecedorM->get(array("idfornecedor" => $idfornecedor), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $configuracoes = $this->SistemaM->get(array(), TRUE);

        $data['moeda'] = $configuracoes->moeda;

        $this->parser->parse('admin/fornecedor_form_visualizar', $data);
    }

    public function excluir($idfornecedor) {
        $resultado = $this->FornecedorM->delete($idfornecedor);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Fornecedor excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/fornecedor');
    }

}
