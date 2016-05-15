<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Funcionario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/funcionario_model', 'FuncionarioM');
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
        $data['pagina_nome'] = 'funcionario';
        $data['URLADICIONAR'] = site_url('admin/funcionario/adicionar');
        $data['URLLISTAR'] = site_url('admin/funcionario');

        $data['funcionario'] = $this->FuncionarioM->get_all()->result();

        $this->parser->parse('admin/funcionario', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'funcionario';
        $data['ACAO'] = 'Novo';
        $data['idfuncionario'] = '';
        $data['URLLISTAR'] = site_url('admin/funcionario');

        $this->parser->parse('admin/funcionario_form', $data);
    }

    public function get_valida_email() {
        $email = $this->input->post('email');

        if (!empty($email)) {
            //verifico se fornecedor já esta cadastrado
            $this->db->where('email', $email);
            $query = $this->db->get('funcionario');

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
        $idfuncionario = $this->input->post('idfuncionario');
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        $sexo = $this->input->post('sexo');
        $departamento = $this->input->post('departamento');
        $cep = $this->input->post('cep');
        $endereco = $this->input->post('endereco');
        $numero = $this->input->post('numero');
        $complemento = $this->input->post('complemento');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $uf = $this->input->post('uf');
        $telefone = $this->input->post('telefone');
        $celular = $this->input->post('celular');
        $ativo = $this->input->post('ativo');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } /* else {
          $nomeUsado = $this->FuncionarioM->valida_nome_duplicado($idfuncionario, $nome);
          if ($nomeUsado > 0) {
          $erros = TRUE;
          $mensagem .= "Este Nome já está sendo utilizado.\n";
          }
          } */

        if (!$email) {
            $erros = TRUE;
            $mensagem .= "O campo email é obrigatorio.\n";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros = TRUE;
                $mensagem .= "Este email é inválido.\n";
            } else {
                $total = $this->FuncionarioM->valida_email_duplicado($idfuncionario, $email);
                if ($total > 0) {
                    $erros = TRUE;
                    $mensagem .= "Este email já está sendo utilizado.\n";
                }
            }
        }

        if (!$sexo) {
            $erros = TRUE;
            $mensagem .= "O campo sexo é obrigatorio.\n";
        }

        if (!$departamento) {
            $erros = TRUE;
            $mensagem .= "O campo departamento é obrigatorio.\n";
        }

        if (!$cep) {
            $erros = TRUE;
            $mensagem .= "O campo cep é obrigatorio.\n";
        }

        if (!$endereco) {
            $erros = TRUE;
            $mensagem .= "O campo endereço é obrigatorio.\n";
        }

        if (!$numero) {
            $erros = TRUE;
            $mensagem .= "O campo número é obrigatorio.\n";
        }

        if (!$complemento) {
            $erros = TRUE;
            $mensagem .= "O campo complemento é obrigatorio.\n";
        }

        if (!$bairro) {
            $erros = TRUE;
            $mensagem .= "O campo bairro é obrigatorio.\n";
        }

        if (!$cidade) {
            $erros = TRUE;
            $mensagem .= "O campo cidade é obrigatorio.\n";
        }


        if (!$telefone) {
            $erros = TRUE;
            $mensagem .= "O campo telefone é obrigatorio.\n";
        }

        if (!$celular) {
            $erros = TRUE;
            $mensagem .= "O campo celular é obrigatorio.\n";
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "email" => $email,
                "sexo" => $sexo,
                "departamento" => $departamento,
                "cep" => $cep,
                "endereco" => $endereco,
                "numero" => $numero,
                "complemento" => $complemento,
                "bairro" => $bairro,
                "cidade" => $cidade,
                "uf" => $uf,
                "telefone" => $telefone,
                "celular" => $celular,
                "ativo" => $ativo ? $ativo : 'N'
            );

            if ($senha) {
                $itens['senha'] = sha1($senha);
            }

            if ($idfuncionario) {
                $idfuncionario = $this->FuncionarioM->update($itens, $idfuncionario);

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/funcionario_imagem/" . $idfuncionario . '.jpg');

                $this->session->set_flashdata('sucesso', 'Funcionário atualizado com sucesso.');
            } else {
                $idfuncionario = $this->FuncionarioM->post($itens);

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/funcionario_imagem/" . $idfuncionario . '.jpg');

                $this->session->set_flashdata('sucesso', 'Funcionário cadastrado com sucesso.');
            }
            if ($idfuncionario) {
                redirect('admin/funcionario');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idfuncionario)
                    redirect('admin/funcionario/editar/' . $idfuncionario);
                else
                    redirect('admin/funcionario/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idfuncionario)
                redirect('admin/funcionario/editar/' . $idfuncionario);
            else
                redirect('admin/funcionario/adicionar');
        }
    }

    public function editar($idfuncionario) {
        $data = array();
        $data['ACAO'] = 'Edição';
        $data['pagina_nome'] = 'funcionario';
        $data['URLLISTAR'] = site_url('admin/funcionario');
        $resultado = $this->FuncionarioM->get(array("idfuncionario" => $idfuncionario), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }

            $data['departamento_' . $resultado->departamento] = 'checked="checked"';
            $data['sexo_' . $resultado->sexo] = 'checked="checked"';
            $data['uf_' . $resultado->uf] = 'selected="selected"';
            $data['ativo'] = ($resultado->ativo == 'S') ? 'checked="checked"' : null;
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $this->parser->parse('admin/funcionario_form_editar', $data);
    }

    public function excluir($idfuncionario) {
        $resultado = $this->FuncionarioM->delete($idfuncionario);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Funcionário excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/funcionario');
    }

}
