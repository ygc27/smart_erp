<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProdutoAtributo_Model extends CI_Model {

    // Retorna produtos com atributos pelo idproduto
    public function get_produto_atributos($idproduto) {
        $this->db->select('pe.idprodutoestoque, pe.quantidade, pe.idproduto');
        $this->db->select('a.idatributo, a.idtipoatributo, a.nome');
        $this->db->select('pa.idprodutoestoque, pa.idatributo');
        $this->db->from('produto_estoque pe');
        $this->db->join('produto_atributo pa', 'pa.idprodutoestoque = pe.idprodutoestoque');
        $this->db->join('atributo a', 'a.idatributo = pa.idatributo');
        $this->db->where('pe.idproduto', $idproduto, FALSE);

        return $this->db->get()->result();
    }

    // Retorna produtos com atributos pelo codigo produto
    public function get_produto_barcode($idproduto) {
        $this->db->select('pe.idprodutoestoque, pe.quantidade, pe.idproduto');
        $this->db->select('a.idatributo, a.idtipoatributo, a.nome');
        $this->db->select('p.codigoproduto');
        $this->db->select('pa.idprodutoestoque, pa.idatributo');
        $this->db->from('produto_estoque pe');
        $this->db->join('produto p', 'pe.idproduto = p.idproduto');
        $this->db->join('produto_atributo pa', 'pa.idprodutoestoque = pe.idprodutoestoque');
        $this->db->join('atributo a', 'a.idatributo = pa.idatributo');
        $this->db->where('p.codigoproduto', $idproduto);

        return $this->db->get()->result();
    }

    public function get_atributos_disponiveis($idproduto) {
        $this->db->select('p.idtipoatributo, p.idproduto');
        $this->db->select('a.idatributo, a.idtipoatributo, a.nome');
        $this->db->from('atributo a');
        $this->db->from('produto p');
        $this->db->where('p.idtipoatributo', 'a.idtipoatributo', FALSE);
        $this->db->where('p.idproduto', $idproduto, FALSE);

        return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('produto_estoque', $itens);
        if ($resultado) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update($idproduto_estoque, $itens) {
        $this->db->where('idprodutoestoque', $idproduto_estoque, FALSE);
        $resultado = $this->db->update('produto_estoque', $itens);
    }

    public function delete($idproduto_estoque) {
        $this->db->where('idprodutoestoque', $idproduto_estoque, FALSE);
        $resultado = $this->db->delete('produto_estoque');
    }

    public function post_atributo($itens) {
        $resultado = $this->db->insert('produto_atributo', $itens);
        if ($resultado) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

}
