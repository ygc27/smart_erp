<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente_Model extends CI_Model {

    public function get_all() {
        return $this->db->get('cliente');
    }

    public function get($condicao = array(), $primeiraLinha = FALSE) {
        $this->db->select('idcliente, codigo_cliente, tipo_perfil, cpf, cnpj, nome, razao_social, pessoa_contato, senha, sexo, cep, cep_entrega, endereco, endereco_entrega, numero, numero_entrega, complemento, complemento_entrega, bairro, bairro_entrega, cidade, cidade_entrega, uf, uf_entrega, email, telefone, celular, desconto, ativo');
        $this->db->where($condicao);
        $this->db->from('cliente');

        if ($primeiraLinha)
            return $this->db->get()->first_row();
        else
            return $this->db->get()->result();
    }

    public function post($itens) {
        $resultado = $this->db->insert('cliente', $itens);
        if ($resultado)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function update($itens, $idcliente) {
        $this->db->where('idcliente', $idcliente, FALSE);
        $resultado = $this->db->update('cliente', $itens);
        if ($resultado)
            return $idcliente;
        else
            return FALSE;
    }

    /* public function valida_nome_duplicado($idcliente, $nome) {
      $this->db->from('cliente');
      $this->db->where('nome', $nome, TRUE);
      $this->db->where('idcliente !=', $idcliente, TRUE);
      return $this->db->count_all_results();
      } */

    public function valida_email_duplicado($idcliente, $email) {
        $this->db->from('cliente');
        $this->db->where('email', $email, TRUE);
        $this->db->where('idcliente !=', $idcliente, TRUE);
        return $this->db->count_all_results();
    }

    public function valida_cpf_duplicado($idcliente, $cpf) {
        $this->db->from('cliente');
        $this->db->where('cpf', $cpf, TRUE);
        $this->db->where('idcliente !=', $idcliente, TRUE);
        return $this->db->count_all_results();
    }

    public function valida_cnpj_duplicado($idcliente, $cnpj) {
        $this->db->from('cliente');
        $this->db->where('cnpj', $cnpj, TRUE);
        $this->db->where('idcliente !=', $idcliente, TRUE);
        return $this->db->count_all_results();
    }

    public function delete($idcliente) {
        if (file_exists("uploads/cliente_imagem/" . $idcliente . ".jpg")) {
            unlink("uploads/cliente_imagem/" . $idcliente . ".jpg");
        }

        $this->db->where('idcliente', $idcliente, FALSE);
        return $this->db->delete('cliente');
    }

    public function get_image_url($perfil = '', $idcliente = '') {
        if (file_exists('uploads/' . $perfil . '_imagem/' . $idcliente . '.jpg'))
            $image_url = base_url() . 'uploads/' . $perfil . '_imagem/' . $idcliente . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

}
