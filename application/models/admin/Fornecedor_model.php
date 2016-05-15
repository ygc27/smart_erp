<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fornecedor_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('fornecedor');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idfornecedor, fornecedor, nome, sexo, cep, endereco, cidade, uf, email, telefone, celular, banco, agencia, conta');
        $this->db->where($condicao);
        $this->db->from('fornecedor');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('fornecedor', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idfornecedor) {
        $this->db->where('idfornecedor', $idfornecedor, FALSE);
        $resultado = $this->db->update('fornecedor', $itens);
        if ($resultado)
            return $idfornecedor;
        else
            return FALSE;
    }

    /* public function validaNomeDuplicado($idfornecedor, $nome) {
      $this->db->from('fornecedor');
      $this->db->where('nome', $nome, TRUE);
      $this->db->where('idfornecedor !=', $idfornecedor, TRUE);
      return $this->db->count_all_results();
      } */

    public function valida_email_duplicado($idfornecedor, $email) {
        $this->db->from('fornecedor');
        $this->db->where('email', $email, TRUE);
        $this->db->where('idfornecedor !=', $idfornecedor, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idfornecedor) {
        if (file_exists("uploads/fornecedor_imagem/" . $idfornecedor . ".jpg")) {
            unlink("uploads/fornecedor_imagem/" . $idfornecedor . ".jpg");
        }

        $this->db->where('idfornecedor', $idfornecedor, FALSE);
        return $this->db->delete('fornecedor');
    }

    public function get_image_url($perfil = '', $idfornecedor = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $idfornecedor . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $idfornecedor . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';
        return $image_url;
    }

}
