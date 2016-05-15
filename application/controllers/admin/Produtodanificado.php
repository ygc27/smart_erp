<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProdutoDanificado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/produto_model', 'ProdutoM');
        $this->load->model('admin/produtoatributo_model', 'ProdutoAtributoM');
        $this->load->model('admin/produtodanificado_model', 'ProdutoDanificadoM');
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
        $data['pagina_nome'] = 'produto-danificado';
        $data['URLADICIONAR'] = site_url('admin/produtodanificado/adicionar');
        $data['URLLISTAR'] = site_url('admin/produtodanificado');

        $resultado = $this->SistemaM->get(array(), TRUE);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $data['produto_danificado'] = $this->ProdutoDanificadoM->get_all()->result();

        $this->parser->parse('admin/produto_danificado', $data);
    }

    public function adicionar() {
        $data = array();
        $data['pagina_nome'] = 'produto-danificado';
        $data['idprodutodanificado'] = '';
        $data['idproduto'] = '';
        $data['URLLISTAR'] = site_url('admin/produtodanificado');
        $data['BLC_PRODUTOS'] = array();

        $produto = $this->ProdutoM->get_all()->result();

        if ($produto) {
            foreach ($produto as $prod) {
                $data['BLC_PRODUTOS'][] = array(
                    "IDPRODUTO" => $prod->idproduto,
                    "NOMEPRODUTO" => $prod->nome,
                    "sel_idprodutopai" => null
                );
            }
        }

        $this->parser->parse('admin/produto_danificado_form', $data);
    }

    public function get_atributo() {
        $id_produto = $this->input->post('id_produto');

        if (!empty($id_produto)) {
            $atributosProduto = $this->ProdutoAtributoM->get_produto_atributos($id_produto);

            foreach ($atributosProduto as $atributos) {

                echo '<tr>
                          <td>' . $atributos->nome . " (" . $atributos->quantidade . ")" . '</td>
                          <td>
                            <input type="text" class="form-control estoque" id="item_' . $atributos->idprodutoestoque . '" name="atributo[' . $atributos->idprodutoestoque . '][quantidade]" onchange="validaqtde(' . $atributos->quantidade . ', ' . $atributos->idprodutoestoque . ')" value="" />
                            <input type="hidden"  name="quantidade[' . $atributos->idprodutoestoque . '][]" value="' . $atributos->quantidade . '" />
                            <input type="hidden"  name="produto[' . $atributos->idprodutoestoque . '][]" value="' . $atributos->nome . '" />
                          </td>
                      </tr>
                      ';
            }
            exit;
        } else {
            echo '';
            exit;
        }
    }

    public function salvar() {
        $idProduto = $this->input->post('id_produto');
        $atributo = $this->input->post('atributo');
        $nomeAtributo = $this->input->post('produto');
        $quantidade = $this->input->post('quantidade');
        $descricao = $this->input->post('descricao');
        $removerEstoque = $this->input->post('remover_estoque');

        $aJson = array();
        foreach ($nomeAtributo as $i => $a) {
            $aJson[$i]['atributo'] = $a[0];
        }
        foreach ($atributo as $i => $a) {
            $aJson[$i]['quantidade'] = $a['quantidade'];
        }

        $aJson = json_encode($aJson);

        $erros = FALSE;
        $mensagem = null;

        if (!$idProduto) {
            $erros = TRUE;
            $mensagem .= "Selecione um produto.\n";
        }

        if (!$descricao) {
            $erros = TRUE;
            $mensagem .= "O campo descrição é obrigatorio.\n";
        }

        if (!$erros) {
            $itens = array(
                "idproduto" => $idProduto,
                "descricao" => $descricao,
                "resumo" => $aJson,
                "remover_estoque" => $removerEstoque ? $removerEstoque : 'N'
            );

            $idProdutoDanificado = $this->ProdutoDanificadoM->post($itens);

            foreach ($atributo as $idProdutoEstoque => $valores) {

                $estoqueAtual = (int) $quantidade[$idProdutoEstoque][0];
                $itemDanificado = ($valores['quantidade']) ? $valores['quantidade'] : 0;

                if ($itemDanificado > 0) {
                    
                    if ((int) $estoqueAtual < $itemDanificado) {
                        $this->session->set_flashdata('erro', "{$nomeAtributo[$idProdutoEstoque][0]} ({$estoqueAtual}) possui estoque menor que {$itemDanificado}.");
                        continue;
                    }

                    $novoEstoque = (int) $estoqueAtual - $itemDanificado;
                    $dados = array(
                        "quantidade" => $novoEstoque
                    );

                    $this->ProdutoAtributoM->update($idProdutoEstoque, $dados);
                    //$this->session->set_flashdata('sucesso', "{$nomeAtributo[$idProdutoEstoque][0]} ($estoqueAtual) agora possui estoque de {$novoEstoque} unidades.");
                    $this->session->set_flashdata('sucesso', 'Produto danificado cadastrado com sucesso.');
                }
            }
        }

        if ($idProdutoDanificado) {
            redirect('admin/produtodanificado/');
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));

            redirect('admin/produtodanificado/adicionar');
        }
    }

    public function get_resumo() {

        $id_danificado = $this->input->post('id_danificado');

        $this->db->select('resumo');
        $this->db->from('produto_danificado');
        $this->db->where('idprodutodanificado', $id_danificado, FALSE);
        $resultado = $this->db->get()->result();

        foreach ($resultado as $row) {
            $resumo = json_decode($row->resumo);

            foreach ($resumo as $valor) {
                echo '<tr>
                        <td>' . $valor->atributo . '</td>
                        <td>
                            <input type="text" class="form-control" value="' . $valor->quantidade . '" readonly>
                        </td>
                     </tr>
                    ';
            }
            exit;
        }
    }

    public function excluir($idProdutoDanificado) {
        $resultado = $this->ProdutoDanificadoM->delete($idProdutoDanificado);

        if ($resultado)
            $this->session->set_flashdata('sucesso', 'Produto danificado removido com sucesso.');
        else
            $this->session->set_flashdata('erro', 'Registro não pode ser removido.');

        redirect('admin/produtodanificado');
    }

}
