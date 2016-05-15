<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TipoAtributo_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('tipo_atributo');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idtipoatributo, nome');
        $this->db->where($condicao);
        $this->db->from('tipo_atributo');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('tipo_atributo', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idtipoatributo) {
        $this->db->where('idtipoatributo', $idtipoatributo, FALSE);
        $resultado = $this->db->update('tipo_atributo', $itens);
        if ($resultado)
            return $idtipoatributo;
        else
            return FALSE;
    }

    public function valida_nome_duplicado($idtipoatributo, $nome) {
        $this->db->from('tipo_atributo');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idtipoatributo !=', $idtipoatributo, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idtipoatributo) {
        $this->db->where('idtipoatributo', $idtipoatributo, FALSE);
        return $this->db->delete('tipo_atributo');
    }

}
