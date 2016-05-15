<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SubCategoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/subcategoria_model', 'SubCategoriaM');
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
        $data['pagina_nome'] = 'subcategoria';
        $data['URLADICIONAR'] = site_url('admin/subcategoria/adicionar');
        $data['URLLISTAR'] = site_url('admin/subcategoria');

        $data['subcategoria'] = $this->SubCategoriaM->get_all()->result();

        $this->parser->parse('admin/subcategoria', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'subcategoria';
        $data['ACAO'] = 'Novo';
        $data['idsubcategoria'] = '';
        $data['nome'] = '';
        $data['descricao'] = '';
        $data['URLLISTAR'] = site_url('admin/subcategoria');
        $data['BLC_CATEGORIAS'] = array();
        
        $categoria = $this->CategoriaM->get_all()->result();

        if ($categoria) {
            foreach ($categoria as $cat) {
                $data['BLC_CATEGORIAS'][] = array(
                    "IDCATEGORIA" => $cat->idcategoria,
                    "NOMECATEGORIA" => $cat->nome,
                    "sel_idpai" => null
                );
            }
        }

        $this->parser->parse('admin/subcategoria_form', $data);
    }

    public function salvar() {

        $idsubcategoria = $this->input->post('idsubcategoria');
        $nome = $this->input->post('nome');
        $idcategoria = $this->input->post('idcategoria');
        $descricao = $this->input->post('descricao');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } else {
            $nomeUsado = $this->SubCategoriaM->valida_nome_duplicado($idsubcategoria, $idcategoria, $nome);
            if ($nomeUsado > 0) {
                $erros = TRUE;
                $mensagem .= "Este Nome já está sendo utilizado.\n";
            }
        }

        if (!$idcategoria) {
            $erros = TRUE;
            $mensagem .= "Selecione uma categoria.\n";
        }

        if (!$erros) {
            $itens = array(
                "nome" => $nome,
                "idcategoria" => $idcategoria,
                "descricao" => $descricao
            );

            if ($idsubcategoria) {
                $idsubcategoria = $this->SubCategoriaM->update($itens, $idsubcategoria);
                $this->session->set_flashdata('sucesso', 'Subcategoria atualizada com sucesso.');
            } else {
                $idsubcategoria = $this->SubCategoriaM->post($itens);
                $this->session->set_flashdata('sucesso', 'Subcategoria cadastrada com sucesso.');
            }
            if ($idsubcategoria) {
                redirect('admin/subcategoria');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idsubcategoria)
                    redirect('admin/subcategoria/editar/' . $idsubcategoria);
                else
                    redirect('admin/subcategoria/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idsubcategoria)
                redirect('admin/subcategoria/editar/' . $idsubcategoria);
            else
                redirect('admin/subcategoria/adicionar');
        }
    }

    public function editar($idsubcategoria) {
        $data = array();
        $data['pagina_nome'] = 'subcategoria';
        $data['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/subcategoria');

        $resultado = $this->SubCategoriaM->get(array("idsubcategoria" => $idsubcategoria), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $categoria = $this->CategoriaM->get_all()->result();

        foreach ($categoria as $cat) {
            $data['BLC_CATEGORIAS'][] = array(
                "IDCATEGORIA" => $cat->idcategoria,
                "NOMECATEGORIA" => $cat->nome,
                "sel_idpai" => ($resultado->idcategoria == $cat->idcategoria) ? 'selected="selected"' : null
            );
        }

        $this->parser->parse('admin/subcategoria_form', $data);
    }

    public function excluir($idsubcategoria) {
        $resultado = $this->SubCategoriaM->delete($idsubcategoria);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Subcategoria excluída com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/subcategoria');
    }

}
