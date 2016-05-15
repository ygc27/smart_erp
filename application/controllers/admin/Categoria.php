<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/categoria_model', 'CategoriaM');
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
        $data['pagina_nome'] = 'categoria';
        $data['URLADICIONAR'] = site_url('admin/categoria/adicionar');
        $data['URLLISTAR'] = site_url('admin/categoria');

        $data['categorias'] = $this->CategoriaM->get_all()->result();

        $this->parser->parse('admin/categoria', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'categoria';
        $data['ACAO'] = 'Novo';
        $data['idcategoria'] = '';
        $data['nome'] = '';
        $data['descricao'] = '';
        $data['URLLISTAR'] = site_url('admin/categoria');

        $this->parser->parse('admin/categoria_form', $data);
    }

    public function salvar() {

        $idcategoria = $this->input->post('idcategoria');
        $nome = $this->input->post('nome');
        $descricao = $this->input->post('descricao');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } else {
            $nomeUsado = $this->CategoriaM->valida_nome_duplicado($idcategoria, $nome);
            if ($nomeUsado > 0) {
                $erros = TRUE;
                $mensagem .= "Este Nome já está sendo utilizado.\n";
            }
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "descricao" => $descricao
            );

            if ($idcategoria) {
                $idcategoria = $this->CategoriaM->update($itens, $idcategoria);
                $this->session->set_flashdata('sucesso', 'Categoria atualizada com sucesso.');
            } else {
                $idcategoria = $this->CategoriaM->post($itens);
                $this->session->set_flashdata('sucesso', 'Categoria cadastrada com sucesso.');
            }
            if ($idcategoria) {
                redirect('admin/categoria');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idcategoria)
                    redirect('admin/categoria/editar/' . $idcategoria);
                else
                    redirect('admin/categoria/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idcategoria)
                redirect('admin/categoria/editar/' . $idcategoria);
            else
                redirect('admin/categoria/adicionar');
        }
    }

    public function editar($idcategoria) {
        $data = array();
        $data['pagina_nome'] = 'categoria';
        $data['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/categoria');

        $resultado = $this->CategoriaM->get(array("idcategoria" => $idcategoria), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $this->parser->parse('admin/categoria_form', $data);
    }

    public function excluir($idcategoria) {
        $resultado = $this->CategoriaM->delete($idcategoria);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Categoria excluída com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/categoria');
    }

}
