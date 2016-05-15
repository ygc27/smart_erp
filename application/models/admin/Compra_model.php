<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra_Model extends CI_Model {

    public function get_all() {
        $this->db->order_by('cadastro', 'DESC');
        return $this->db->get('compra');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idcompra, codigo_compra, idfornecedor, cadastro');
        $this->db->where($condicao);
        $this->db->from('compra');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('compra', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idcompra) {
        $this->db->where('idcompra', $idcompra, FALSE);
        $resultado = $this->db->update('compra', $itens);
        if ($resultado)
            return $idcompra;
        else
            return FALSE;
    }

}
