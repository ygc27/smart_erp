<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagamento extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function paypal($idpedido = '') {

        $email_paypal =  $this->db->get_where('configuracoes', array('id' => 1))->row()->email_paypal;
        $moeda = CODIGO_MOEDA;

        $this->db->select('pedido.valor_total, pedido.codigo_pedido');
        $this->db->from('pedido');
        $this->db->where('idpedido', $idpedido);
        $this->db->join('cliente', 'pedido.idcliente = cliente.idcliente');
        $cliente = $this->db->get()->result();

        //TRANSFERRING USER TO PAYPAL TERMINAL
        $this->paypal->add_field('rm', 2);
        $this->paypal->add_field('no_note', 0);
        $this->paypal->add_field('item_name', 'Compra Atual');
        $this->paypal->add_field('amount', $cliente[0]->valor_total);
        $this->paypal->add_field('currency_code', $moeda);
        $this->paypal->add_field('custom', $idpedido);
        $this->paypal->add_field('business', $email_paypal);
        $this->paypal->add_field('cancel_return', base_url() . "cliente/pedido/cancelado/{$cliente[0]->codigo_pedido}");
        $this->paypal->add_field('return', base_url() . "cliente/pedido/sucesso/{$cliente[0]->codigo_pedido}");

        $this->paypal->submit_paypal_post();
    }

}
