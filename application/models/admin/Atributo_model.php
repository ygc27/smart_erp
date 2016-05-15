<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Atributo_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('atributo');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idatributo, idtipoatributo, nome');
        $this->db->where($condicao);
        $this->db->from('atributo');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('atributo', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idatributo) {
        $this->db->where('idatributo', $idatributo, FALSE);
        $resultado = $this->db->update('atributo', $itens);
        if ($resultado)
            return $idatributo;
        else
            return FALSE;
    }

    public function valida_nome_duplicado($idatributo, $idtipoatributo, $nome) {
        $this->db->from('atributo');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idatributo !=', $idatributo, TRUE);
        $this->db->where('idtipoatributo', $idtipoatributo, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idatributo) {
        $this->db->where('idatributo', $idatributo, FALSE);
        return $this->db->delete('atributo');
    }

}
