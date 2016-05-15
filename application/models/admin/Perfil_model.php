<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfil_Model extends CI_Model {

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idadmin, nome, email, senha, cadastro');
        $this->db->where($condicao);
        $this->db->from('admin');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('admin', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens) {
        $this->db->update('admin', $itens);
    }

    public function get_image_url($perfil = '', $id = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

}
