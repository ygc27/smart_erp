<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sistema_Model extends CI_Model {

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('id, nome, email, email_paypal, endereco, telefone, moeda, imposto, cadastro');
        $this->db->where($condicao);
        $this->db->from('configuracoes');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('configuracoes', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens) {
        $this->db->update('configuracoes', $itens);
    }

}
