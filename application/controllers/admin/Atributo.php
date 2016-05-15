<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Atributo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/atributo_model', 'AtributoM');
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
        $data['pagina_nome'] = 'atributo';
        $data['URLADICIONAR'] = site_url('admin/atributo/adicionar');
        $data['URLLISTAR'] = site_url('admin/atributo');

        $data['atributos'] = $this->AtributoM->get_all()->result();

        $this->parser->parse('admin/atributo', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'atributo';
        $data['ACAO'] = 'Novo';
        $data['idatributo'] = '';
        $data['nome'] = '';
        $data['URLLISTAR'] = site_url('admin/atributo');
        $data['BLC_TIPOATRIBUTO'] = array();
        
        $tipoAtributo = $this->TipoAtributoM->get_all()->result();

        if ($tipoAtributo) {
            foreach ($tipoAtributo as $row) {
                $data['BLC_TIPOATRIBUTO'][] = array(
                    "IDTIPOATRIBUTO" => $row->idtipoatributo,
                    "NOMETIPOATRIBUTO" => $row->nome,
                    "sel_idpai" => null
                );
            }
        }

        $this->parser->parse('admin/atributo_form', $data);
    }

    public function salvar() {
        $idatributo = $this->input->post('idatributo');
        $nome = $this->input->post('nome');
        $idtipoatributo = $this->input->post('idtipoatributo');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } else {
            $nomeUsado = $this->AtributoM->valida_nome_duplicado($idatributo, $idtipoatributo, $nome);
            if ($nomeUsado > 0) {
                $erros = TRUE;
                $mensagem .= "Este Nome já está sendo utilizado.\n";
            }
        }

        if (!$idtipoatributo) {
            $erros = TRUE;
            $mensagem .= "Selecione um tipo de atributo.\n";
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "idtipoatributo" => $idtipoatributo
            );

            if ($idatributo) {
                $idatributo = $this->AtributoM->update($itens, $idatributo);
                $this->session->set_flashdata('sucesso', 'Atributo atualizado com sucesso.');
            } else {
                $idatributo = $this->AtributoM->post($itens);
                $this->session->set_flashdata('sucesso', 'Atributo cadastrado com sucesso.');
            }
            if ($idatributo) {
                redirect('admin/atributo');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idatributo)
                    redirect('admin/atributo/editar/' . $idatributo);
                else
                    redirect('admin/atributo/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idatributo)
                redirect('admin/atributo/editar/' . $idatributo);
            else
                redirect('admin/atributo/adicionar');
        }
    }

    public function editar($idatributo) {
        $data = array();
        $data['pagina_nome'] = 'atributo';
        $data['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/atributo');

        $resultado = $this->AtributoM->get(array("idatributo" => $idatributo), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $tipoAtributo = $this->TipoAtributoM->get_all()->result();

        foreach ($tipoAtributo as $row) {
            $data['BLC_TIPOATRIBUTO'][] = array(
                "IDTIPOATRIBUTO" => $row->idtipoatributo,
                "NOMETIPOATRIBUTO" => $row->nome,
                "sel_idpai" => ($resultado->idtipoatributo == $row->idtipoatributo) ? 'selected="selected"' : null
            );
        }

        $this->parser->parse('admin/atributo_form', $data);
    }

    public function excluir($idatributo) {
        $resultado = $this->AtributoM->delete($idatributo);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Atributo excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/atributo');
    }

}
