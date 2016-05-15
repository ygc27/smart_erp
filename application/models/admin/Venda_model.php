<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venda_Model extends CI_Model {

    public function get_all() {
        $this->db->order_by('data_cadastro', 'DESC');
        return $this->db->get('venda');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idvenda, codigo_venda, idcliente, subtotal, desconto, percentagem_imposto, valor_total, valor_restante, data_cadastro');
        $this->db->where($condicao);
        $this->db->from('venda');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $res = $this->db->insert('venda', $itens);
        if ($res)
            return $this->db->insert_id();
        else
            return FALSE;
    }

}
