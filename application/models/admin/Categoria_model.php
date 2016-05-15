<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoria_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('categoria');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idcategoria, nome, descricao');
        $this->db->where($condicao);
        $this->db->from('categoria');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('categoria', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idcategoria) {
        $this->db->where('idcategoria', $idcategoria, FALSE);
        $resultado = $this->db->update('categoria', $itens);
        if ($resultado)
            return $idcategoria;
        else
            return FALSE;
    }

    public function valida_nome_duplicado($idcategoria, $nome) {
        $this->db->from('categoria');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idcategoria !=', $idcategoria, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idcategoria) {
        $this->db->where('idcategoria', $idcategoria, FALSE);
        return $this->db->delete('categoria');
    }

}
