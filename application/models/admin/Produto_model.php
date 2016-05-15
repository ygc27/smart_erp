<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('produto');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idproduto, idfornecedor, idcategoria, idsubcategoria, codigoproduto, nome, modelo, idtipoatributo, dimensoes, tipo_comprimento, peso, tipo_peso, precocompra, precovenda, descricao');
        $this->db->where($condicao);
        $this->db->from('produto');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('produto', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idproduto) {
        $this->db->where('idproduto', $idproduto, FALSE);
        $resultado = $this->db->update('produto', $itens);
        if ($resultado)
            return $idproduto;
        else
            return FALSE;
    }

    public function valida_nome_duplicado($idproduto, $nome) {
        $this->db->from('produto');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idproduto !=', $idproduto, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idproduto) {
        if (file_exists("uploads/produto_imagem/" . $idproduto . ".jpg")) {
            unlink("uploads/produto_imagem/" . $idproduto . ".jpg");
        }

        $this->db->where('idproduto', $idproduto, FALSE);
        return $this->db->delete('produto');
    }

    public function get_image_url($perfil = '', $idproduto = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $idproduto . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $idproduto . '.jpg';
        else
            $image_url = base_url() . 'uploads/none.png';

        return $image_url;
    }

}
