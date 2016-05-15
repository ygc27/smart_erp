<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TipoAtributo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/tipoatributo_model', 'TipoAtributoM');
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
        $data['pagina_nome'] = 'tipo-atributo';
        $data['URLADICIONAR'] = site_url('admin/tipoatributo/adicionar');
        $data['URLLISTAR'] = site_url('admin/tipoatributo');

        $data['tipo_atributo'] = $this->TipoAtributoM->get_all()->result();

        $this->parser->parse('admin/tipoatributo', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'tipo-atributo';
        $data['ACAO'] = 'Novo';
        $data['idtipoatributo'] = '';
        $data['nome'] = '';
        $data['URLLISTAR'] = site_url('admin/tipoatributo');

        $this->parser->parse('admin/tipoatributo_form', $data);
    }

    public function salvar() {
        $idtipoatributo = $this->input->post('idtipoatributo');
        $nome = $this->input->post('nome');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } else {
            $nomeUsado = $this->TipoAtributoM->valida_nome_duplicado($idtipoatributo, $nome);
            if ($nomeUsado > 0) {
                $erros = TRUE;
                $mensagem .= "Este Nome já está sendo utilizado.\n";
            }
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome
            );

            if ($idtipoatributo) {
                $idtipoatributo = $this->TipoAtributoM->update($itens, $idtipoatributo);
                $this->session->set_flashdata('sucesso', 'Tipo de atributo atualizado com sucesso.');
            } else {
                $idtipoatributo = $this->TipoAtributoM->post($itens);
                $this->session->set_flashdata('sucesso', 'Tipo de atributo cadastrado com sucesso.');
            }
            if ($idtipoatributo) {
                redirect('admin/tipoatributo');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idtipoatributo)
                    redirect('admin/tipoatributo/editar/' . $idtipoatributo);
                else
                    redirect('admin/tipoatributo/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idtipoatributo)
                redirect('admin/tipoatributo/editar/' . $idtipoatributo);
            else
                redirect('admin/tipoatributo/adicionar');
        }
    }

    public function editar($idtipoatributo) {
        $data = array();
        $data['pagina_nome'] = 'tipo-atributo';
        $data['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/tipoatributo');

        $resultado = $this->TipoAtributoM->get(array("idtipoatributo" => $idtipoatributo), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $this->parser->parse('admin/tipoatributo_form', $data);
    }

    public function excluir($idtipoatributo) {
        $resultado = $this->TipoAtributoM->delete($idtipoatributo);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Tipo de atributo excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/tipoatributo');
    }

}
