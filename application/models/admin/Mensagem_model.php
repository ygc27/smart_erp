<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mensagem_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('fio_mensagem');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idmensagemfio, codigo_mensagem, remetente, destinatario, cadastro');
        $this->db->where($condicao);
        $this->db->from('fio_mensagem');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    // Atualiza a mensagem para lida
    public function marcar_mensagem_lida($codigo_mensagem) {
        $usuario_logado = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');
        $this->db->where('remetente !=', $usuario_logado);
        $this->db->where('codigo_mensagem', $codigo_mensagem);
        $this->db->update('mensagem', array('ler_estado' => 1));
    }

    // Contador de mensagem não lidas
    public function contador_mensagem($codigo_mensagem) {
        $total_mensagem = 0;
        $usuario_logado = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');
        $mensagens = $this->db->get_where('mensagem', array('codigo_mensagem' => $codigo_mensagem))->result();
        foreach ($mensagens as $row) {
            if ($row->remetente != $usuario_logado && $row->ler_estado == '0')
                $total_mensagem++;
        }
        return $total_mensagem;
    }

}
