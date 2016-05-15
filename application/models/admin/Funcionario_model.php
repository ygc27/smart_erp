<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Funcionario_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('funcionario');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idfuncionario, nome, email, senha, sexo, departamento, cep, endereco, numero, complemento, bairro,
        cidade, uf, telefone, celular, ativo');
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

    public function update($itens, $idfuncionario) {
        $this->db->where('idfuncionario', $idfuncionario, FALSE);
        $resultado = $this->db->update('funcionario', $itens);
        if ($resultado)
            return $idfuncionario;
        else
            return FALSE;
    }

    /*public function valida_nome_duplicado($idfuncionario, $nome) {
        $this->db->from('funcionario');
        $this->db->where('nome', $nome, TRUE);
        $this->db->where('idfuncionario !=', $idfuncionario, TRUE);
        return $this->db->count_all_results();
    }*/

    public function valida_email_duplicado($idfuncionario, $email) {
        $this->db->from('funcionario');
        $this->db->where('email', $email, TRUE);
        $this->db->where('idfuncionario !=', $idfuncionario, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idfuncionario) {
        if (file_exists("uploads/funcionario_imagem/" . $idfuncionario . ".jpg")) {
            unlink("uploads/funcionario_imagem/" . $idfuncionario . ".jpg");
        }

        $this->db->where('idfuncionario', $idfuncionario, FALSE);
        return $this->db->delete('funcionario');
    }

    public function get_image_url($perfil = '', $idfuncionario = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $idfuncionario . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $idfuncionario . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

}
