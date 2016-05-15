<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedido_Model extends CI_Model {

    public function get_all() {
        $this->db->order_by('data_cadastro', 'DESC');
        return $this->db->get('pedido');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idpedido, codigo_pedido, idcliente, subtotal, desconto, percentagem_imposto, valor_total, valor_restante, forma_pagamento, status_pedido, status_pagamento, endereco_entrega, observacao, data_cadastro, data_alteracao');
        $this->db->where($condicao);
        $this->db->from('pedido');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('pedido', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idpedido) {
        $this->db->where('idpedido', $idpedido, FALSE);
        $resultado = $this->db->update('pedido', $itens);
        if ($resultado)
            return $idpedido;
        else
            return FALSE;
    }

}
