<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SubCategoria_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('subcategoria');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idsubcategoria, idcategoria, nome, descricao');
        $this->db->where($condicao);
        $this->db->from('subcategoria');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('subcategoria', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idsubcategoria) {
        $this->db->where('idsubcategoria', $idsubcategoria, FALSE);
        $resultado = $this->db->update('subcategoria', $itens);
        if ($resultado)
            return $idsubcategoria;
        else
            return FALSE;
    }

    public function valida_nome_duplicado($idsubcategoria, $idcategoria, $nome) {
        $this->db->from('subcategoria');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idsubcategoria !=', $idsubcategoria, TRUE);
        $this->db->where('idcategoria', $idcategoria, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idsubcategoria) {
        $this->db->where('idsubcategoria', $idsubcategoria, FALSE);
        return $this->db->delete('subcategoria');
    }

}
