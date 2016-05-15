<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/sistema_model', 'SistemaM');
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/fornecedor_model', 'FornecedorM');
        $this->load->model('admin/subcategoria_model', 'SubCategoriaM');
        $this->load->model('admin/categoria_model', 'CategoriaM');
        $this->load->model('admin/tipoatributo_model', 'TipoAtributoM');
        $this->load->model('admin/atributo_model', 'AtributoM');
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
        $data['pagina_nome'] = 'produto';
        $data['URLADICIONAR'] = site_url('admin/produto/adicionar');
        $data['URLLISTAR'] = site_url('admin/produto');

        $resultado = $this->SistemaM->get(array(), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $data['produtos'] = $this->ProdutoM->get_all()->result();

        $this->parser->parse('admin/produto', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'produto';
        $data['ACAO'] = 'Novo';
        $data['idproduto'] = '';
        $data['codigoproduto'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['URLLISTAR'] = site_url('admin/produto');
        $data['BLC_FORNECEDORES'] = array();
        $data['BLC_CATEGORIAS'] = array();
        $data['BLC_SUBCATEGORIAS'] = array();
        $data['BLC_TIPOATRIBUTO'] = array();

        $fornecedor = $this->FornecedorM->get_all('fornecedor')->result();

        if ($fornecedor) {
            foreach ($fornecedor as $row) {
                $data['BLC_FORNECEDORES'][] = array(
                    "IDFORNECEDOR" => $row->idfornecedor,
                    "FORNECEDOR" => $row->fornecedor,
                    "sel_idpai" => null
                );
            }
        }

        $categoria = $this->CategoriaM->get_all('categoria')->result();

        if ($categoria) {
            foreach ($categoria as $cat) {
                $data['BLC_CATEGORIAS'][] = array(
                    "IDCATEGORIA" => $cat->idcategoria,
                    "NOMECATEGORIA" => $cat->nome,
                    "sel_idpai" => null
                );
            }
        }

        $subcategoria = $this->SubCategoriaM->get_all('subcategoria')->result();

        if ($subcategoria) {
            foreach ($subcategoria as $subcat) {
                $data['BLC_SUBCATEGORIAS'][] = array(
                    "IDSUBCATEGORIA" => $subcat->idsubcategoria,
                    "NOMESUBCATEGORIA" => $subcat->nome,
                    "sel_idsubcategoriapai" => null
                );
            }
        }

        $tipoAtributo = $this->TipoAtributoM->get_all('tipo_atributo')->result();

        if ($tipoAtributo) {
            foreach ($tipoAtributo as $row) {
                $data['BLC_TIPOATRIBUTO'][] = array(
                    "IDTIPOATRIBUTO" => $row->idtipoatributo,
                    "NOMETIPOATRIBUTO" => $row->nome,
                    "sel_idtipoatributopai" => null
                );
            }
        }

        $this->parser->parse('admin/produto_form', $data);
    }

    public function get_valida_nome() {
        $nome = $this->input->post('nome');

        if (!empty($nome)) {
            //verifico se o produto já esta cadastrado
            $this->db->where('nome', $nome);
            $query = $this->db->get('produto');

            if ($query->num_rows() == 1) {
                echo 1;
            }
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function get_valida_preco() {
        //$precocompra = $this->input->post('precocompra');
        $precovenda = $this->input->post('precovenda');

        /* if (!empty($precovenda)) {
          //verifico se o preço da compra e maior que o preço da venda
          if ($precocompra > $precovenda) {
          echo 1;
          }
          exit;
          } else {
          echo '';
          exit;
          } */
    }

    public function salvar() {
        $idproduto = $this->input->post('idproduto');
        $codigoproduto = $this->input->post('codigoproduto');
        $nome = $this->input->post('nome');
        $idfornecedor = $this->input->post('idfornecedor');
        $idcategoria = $this->input->post('idcategoria');
        $idsubcategoria = $this->input->post('idsubcategoria');
        $modelo = $this->input->post('modelo');
        $idtipoatributo = $this->input->post('idtipoatributo');
        $dimensoes = $this->input->post('dimensoes');
        $tipo_comprimento = $this->input->post('tipo_comprimento');
        $peso = $this->input->post('peso');
        $tipo_peso = $this->input->post('tipo_peso');
        $precocompra = modificaDinheiroBanco($this->input->post('precocompra'));
        $precovenda = modificaDinheiroBanco($this->input->post('precovenda'));
        $descricao = $this->input->post('descricao');

        $erros = FALSE;
        $mensagem = null;

        if (!$nome) {
            $erros = TRUE;
            $mensagem .= "O campo nome é obrigatorio.\n";
        } else {
            $nomeUsado = $this->ProdutoM->valida_nome_duplicado($idproduto, $nome);
            if ($nomeUsado > 0) {
                $erros = TRUE;
                $mensagem .= "Este Produto já está cadastrado.\n";
            }
        }

        if (!$idcategoria) {
            $erros = TRUE;
            $mensagem .= "Selecione uma categoria.\n";
        }

        if (!$idsubcategoria) {
            $erros = TRUE;
            $mensagem .= "Selecione uma subcategoria.\n";
        }

        if (!$modelo) {
            $erros = TRUE;
            $mensagem .= "O campo modelo é obrigatorio.\n";
        }

        if (!$idtipoatributo) {
            $erros = TRUE;
            $mensagem .= "Selecione uma tipo atributo.\n";
        }

        if (!$precocompra) {
            $erros = TRUE;
            $mensagem .= "O campo preço de compra é obrigatorio.\n";
        } else {
            if ($precocompra > $precovenda) {
                $erros = TRUE;
                $mensagem .= "Preço de compra não pode ser maior que o preço de venda.\n";
            }
        }

        if (!$precovenda) {
            $erros = TRUE;
            $mensagem .= "O campo preço de venda é obrigatorio.\n";
        }

        if (!$erros) {
            $itens = array(
                "codigoproduto" => $codigoproduto,
                "nome" => $nome,
                "idfornecedor" => $idfornecedor,
                "idcategoria" => $idcategoria,
                "idsubcategoria" => $idsubcategoria,
                "modelo" => $modelo,
                "dimensoes" => $dimensoes,
                "tipo_comprimento" => $tipo_comprimento,
                "peso" => $peso,
                "tipo_peso" => $tipo_peso,
                "precocompra" => $precocompra,
                "precovenda" => $precovenda,
                "descricao" => $descricao
            );

            if ($idtipoatributo) {
                $itens["idtipoatributo"] = $idtipoatributo;
            }

            if ($idproduto) {
                $idproduto = $this->ProdutoM->update($itens, $idproduto);

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/produto_imagem/" . $idproduto . '.jpg');

                $this->session->set_flashdata('sucesso', 'Produto atualizado com sucesso.');
            } else {
                $idproduto = $this->ProdutoM->post($itens);

                if (!empty($idtipoatributo)) {
                    $produto_estoque = array(
                        "idproduto" => $idproduto
                    );

                    $this->ProdutoAtributoM->post($produto_estoque);
                }

                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/produto_imagem/" . $idproduto . '.jpg');

                $this->session->set_flashdata('sucesso', 'Produto cadastrado com sucesso.');
            }
            if ($idproduto) {
                redirect('admin/produto');
            } else {
                $this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');

                if ($idproduto)
                    redirect('admin/produto/editar/' . $idproduto);
                else
                    redirect('admin/produto/adicionar');
            }
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));
            if ($idproduto)
                redirect('admin/produto/editar/' . $idproduto);
            else
                redirect('admin/produto/adicionar');
        }
    }

    public function editar($idproduto) {
        $data = array();
        $data['pagina_nome'] = 'produto';
        $data['ACAO'] = 'Edição';
        $data['URLLISTAR'] = site_url('admin/produto');

        $resultado = $this->ProdutoM->get(array("idproduto" => $idproduto), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $fornecedor = $this->FornecedorM->get_all('fornecedor')->result();

        foreach ($fornecedor as $row) {
            $data['BLC_FORNECEDORES'][] = array(
                "IDFORNECEDOR" => $row->idfornecedor,
                "FORNECEDOR" => $row->fornecedor,
                "sel_idpai" => ($resultado->idfornecedor == $row->idfornecedor) ? 'selected="selected"' : null
            );
        }

        $categoria = $this->CategoriaM->get_all('categoria')->result();

        foreach ($categoria as $cat) {
            $data['BLC_CATEGORIAS'][] = array(
                "IDCATEGORIA" => $cat->idcategoria,
                "NOMECATEGORIA" => $cat->nome,
                "sel_idpai" => ($resultado->idcategoria == $cat->idcategoria) ? 'selected="selected"' : null
            );
        }

        $subcategoria = $this->SubCategoriaM->get_all('subcategoria')->result();

        foreach ($subcategoria as $subcat) {
            $data['BLC_SUBCATEGORIAS'][] = array(
                "IDSUBCATEGORIA" => $subcat->idsubcategoria,
                "NOMESUBCATEGORIA" => $subcat->nome,
                "sel_idsubcategoriapai" => ($resultado->idsubcategoria == $subcat->idsubcategoria) ? 'selected="selected"' : null
            );
        }

        $tipoAtributo = $this->TipoAtributoM->get_all('tipo_atributo')->result();

        foreach ($tipoAtributo as $row) {
            $data['BLC_TIPOATRIBUTO'][] = array(
                "IDTIPOATRIBUTO" => $row->idtipoatributo,
                "NOMETIPOATRIBUTO" => $row->nome,
                "sel_idtipoatributopai" => ($resultado->idtipoatributo == $row->idtipoatributo) ? 'selected="selected"' : null
            );
        }

        $this->parser->parse('admin/produto_form_editar', $data);
    }

    public function atributos($idproduto) {
        $data = array();
        $data['pagina_nome'] = 'produto';
        $data['BLC_SEMVINCULADOS'] = array();
        $data['BLC_VINCULADOS'] = array();
        $data['BLC_SEMDISPONIVEIS'] = array();
        $data['BLC_DISPONIVEIS'] = array();
        $data['URLLISTAR'] = site_url('admin/produto');

        // Exibir nome do produto pelo ID
        $infoProduto = $this->ProdutoM->get(array("idproduto" => $idproduto), TRUE);

        if ($infoProduto) {
            $data['NOME'] = $infoProduto->nome;
            $data['IDPRODUTO'] = $infoProduto->idproduto;
        } else {
            show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
        }

        $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($idproduto);

        if ($atributosProduto) {
            foreach ($atributosProduto as $atributos) {
                $data['BLC_VINCULADOS'][] = array(
                    "IDPRODUTOESTOQUE" => $atributos->idprodutoestoque,
                    "QUANTIDADE" => $atributos->quantidade,
                    "DESCRICAO" => $atributos->nome
                );
            }
        } else {
            $data['BLC_SEMVINCULADOS'][] = array();
        }

        //Atributos disponíveis
        if (empty($infoProduto->idtipoatributo)) {
            $data['BLC_SEMDISPONIVEIS'][] = array();
        } else {
            $atributosDisponivel = $this->ProdutoAtributoM->get_atributos_disponiveis($idproduto);

            if ($atributosDisponivel) {
                foreach ($atributosDisponivel as $disponivel) {
                    $data['BLC_DISPONIVEIS'][] = array(
                        "DESCRICAO" => $disponivel->nome,
                        "IDATRIBUTO" => $disponivel->idatributo
                    );
                }
            } else {
                $data['BLC_SEMDISPONIVEIS'][] = array();
            }
        }

        $this->parser->parse('admin/produtoatributo_listar', $data);
    }

    public function salvaatributo() {

        $idproduto = $this->input->post('idproduto');

        //Insere atributos 
        $atributo = $this->input->post('atributo');

        foreach ($atributo as $idatributo => $valores) {
            if (!empty($valores['quantidade'])) {

                $produto_estoque = array(
                    "quantidade" => $valores['quantidade'],
                    "idproduto" => $idproduto
                );

                $idproduto_estoque = $this->ProdutoAtributoM->post($produto_estoque);

                if ($idproduto_estoque) {
                    $dados = array(
                        "idprodutoestoque" => $idproduto_estoque,
                        "idatributo" => $idatributo
                    );
                    $this->ProdutoAtributoM->post_atributo($dados);
                }
            }
        }

        // Atualiza Produto_Estoque
        $atributoExistente = $this->input->post('produto');

        if ($atributoExistente) {
            foreach ($atributoExistente as $idproduto_estoque => $valores) {
                if ($valores['remover'] === 'S') {
                    $this->ProdutoAtributoM->delete($idproduto_estoque);
                } else {

                    $atributoAtualiza = array(
                        "quantidade" => $valores['quantidade']
                    );

                    $this->ProdutoAtributoM->update($idproduto_estoque, $atributoAtualiza);
                }
            }
        }

        $this->session->set_flashdata('sucesso', 'Atritutos salvos com sucesso.');

        redirect('admin/produto/atributos/' . $idproduto);
    }

    public function excluir($idproduto) {
        $resultado = $this->ProdutoM->delete($idproduto);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Produto excluído com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/produto');
    }

}
