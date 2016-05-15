<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfil_Model extends CI_Model {

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('*');
        $this->db->where($condicao);
        $this->db->from('funcionario');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('funcionario', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens) {
        $this->db->update('funcionario', $itens);
    }

    public function get_image_url($perfil = '', $id = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

}
