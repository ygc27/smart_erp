<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProdutoDanificado_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('produto_danificado');
    }

    public function post($itens) {
        $resultado = $this->db->insert('produto_danificado', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function delete($idprodutodanificado) {
        $this->db->where('idprodutodanificado', $idprodutodanificado, FALSE);
        return $this->db->delete('produto_danificado');
    }

}
