<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mensagem extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = LAYOUT_DASHBOARD;
        $this->load->model('admin/perfil_model', 'PerfilM');
        $this->load->model('admin/mensagem_model', 'MensagemM');
        $this->load->model('email_model', 'EmailM');
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $data = array();
        $data['pagina_nome'] = 'mensagem';
        $data['URLADICIONAR'] = site_url('admin/mensagem/nova');

        $this->parser->parse('admin/mensagem', $data);
    }

    public function nova() {
        $data = array();
        $data['pagina_nome'] = 'mensagem';
        $data['TITULO'] = 'Compor uma mensagem';

        $data['clientes'] = $this->db->get('cliente')->result();

        $data['equipe_vendas'] = $this->db->get_where('funcionario', array(
                    'departamento' => 'V'
                ))->result();

        $data['equipe_compras'] = $this->db->get_where('funcionario', array(
                    'departamento' => 'C'
                ))->result();

        $this->parser->parse('admin/mensagem_form', $data);
    }

    public function salvar() {

        $destinatario = $this->input->post('destinatario');
        $corpo_mensagem = $this->input->post('mensagem');
        $remetente = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');

        $erros = FALSE;
        $mensagem = null;

        if (!$destinatario) {
            $erros = TRUE;
            $mensagem .= "Selecione um usuário.\n";
        }

        if (!$corpo_mensagem) {
            $erros = TRUE;
            $mensagem .= "O campo mensagem é obrigatorio.\n";
        }

        if (!$erros) {
            $query1 = $this->db->get_where('fio_mensagem', array(
                        'remetente' => $remetente,
                        'destinatario' => $destinatario
                    ))->num_rows();
            $query2 = $this->db->get_where('fio_mensagem', array(
                        'remetente' => $remetente,
                        'destinatario' => $destinatario
                    ))->num_rows();
            if ($query1 == 0 && $query2 == 0) {
                $codigo_mensagem = substr(md5(rand(100000000, 20000000000)), 0, 15);
                $data_fio_mensagem['codigo_mensagem'] = $codigo_mensagem;
                $data_fio_mensagem['remetente'] = $remetente;
                $data_fio_mensagem['destinatario'] = $destinatario;
                $this->db->insert('fio_mensagem', $data_fio_mensagem);
            }
            if ($query1 > 0)
                $codigo_mensagem = $this->db->get_where('fio_mensagem', array(
                            'remetente' => $remetente,
                            'destinatario' => $destinatario
                        ))->row()->codigo_mensagem;
            if ($query2 > 0)
                $codigo_mensagem = $this->db->get_where('fio_mensagem', array(
                            'remetente' => $remetente,
                            'destinatario' => $destinatario
                        ))->row()->codigo_mensagem;

            $data_mensagem['codigo_mensagem'] = $codigo_mensagem;
            $data_mensagem['mensagem'] = $corpo_mensagem;
            $data_mensagem['remetente'] = $remetente;

            $this->db->insert('mensagem', $data_mensagem);

            $this->session->set_flashdata('sucesso', 'Mensagem enviada com sucesso.');

            $tipo_cliente = explode('-', $destinatario);
            
            $email_to = $this->db->get_where($tipo_cliente[0], array(
                        'id' . $tipo_cliente[0]  => $tipo_cliente[1]
                    ))->row()->email;

            $this->EmailM->notificacao_mensagem_enviada_email_admin($email_to);

            redirect('admin/mensagem/nova');

            return $codigo_mensagem;
        }else {
            $this->session->set_flashdata('erro', nl2br($mensagem));

            redirect('admin/mensagem/nova');
        }
    }

    public function lida($codigo_mensagem = '') {
        $data = array();
        $data['pagina_nome'] = 'mensagem';
        $data['TITULO'] = 'Mensagens';

        $resultado = $this->MensagemM->get(array("codigo_mensagem" => $codigo_mensagem), TRUE);

        $this->MensagemM->marcar_mensagem_lida($codigo_mensagem);

        if ($resultado) {
            foreach ($resultado as $chave => $valor) {
                $data[$chave] = $valor;
            }
        }

        $this->parser->parse('admin/mensagem_form_responder', $data);
    }

    public function responder($codigo_mensagem) {

        $remetente = $this->session->userdata('tipo_login') . '-' . $this->session->userdata('idusuario');
        $corpo_mensagem = $this->input->post('mensagem');

        $erros = FALSE;
        $mensagem = null;

        if (!$corpo_mensagem) {
            $erros = TRUE;
            $mensagem .= "O campo mensagem é obrigatorio.\n";
        }

        if (!$erros) {
            $data_mensagem['codigo_mensagem'] = $codigo_mensagem;
            $data_mensagem['mensagem'] = $corpo_mensagem;
            $data_mensagem['remetente'] = $remetente;
            $this->db->insert('mensagem', $data_mensagem);

            $this->session->set_flashdata('sucesso', 'Mensagem enviada com sucesso.');

            redirect('admin/mensagem/lida/' . $codigo_mensagem);
        } else {
            $this->session->set_flashdata('erro', nl2br($mensagem));

            redirect('admin/mensagem/lida/' . $codigo_mensagem);
        }
    }

}
