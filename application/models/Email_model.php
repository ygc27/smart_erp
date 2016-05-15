<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function abertura_conta_email($tipo_conta, $email_to, $senha) {
        $system_url = base_url();
        $email_sub = "Abertura de nova conta";
        $email_to = $email_to;
        $email_msg = "Parabéns! A sua conta foi criada.<br \>";
        $email_msg .= "Sua senha para a nova conta é " . $senha . "<br \>";
        $email_msg .= "Efetuar login aqui " . $system_url . " para continuar. <br \>";
        $email_msg .= "Você pode alterar sua senha após efetuar o login a partir de suas configurações de perfil.";
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }
    
    public function aprovacao_conta_email($tipo_conta, $email_to) {
        $system_url = base_url();
        $email_sub = "Abertura de nova conta";
        $email_to = $email_to;
        $email_msg = "Parabéns! A sua conta foi aprovada.<br \>";
        $email_msg .= "Efetuar login aqui: " . $system_url . " para acessar ao sistema.";
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }

    public function enviar_email_confirmacao($dados) {
        $email_sub = "Smart ERP - Confirmação de cadastro";
        $email_mensagem = $this->load->view('emails/confirmar_cadastro.php', $dados, TRUE);
        $email_to = $dados['email'];
        $this->enviar_email($email_mensagem, $email_sub, $email_to);
    }

    public function solicitacao_conta_cliente_email($tipo_conta, $email_from, $nome) {
        $system_url = base_url();
        $email_to = $this->db->get_where('admin', array(
                    'idadmin' => 1
                ))->row()->email;
        $email_sub = "Cliente Aguardando Aprovação";
        $email_msg = $tipo_conta . " " . $nome . " aguarda aprovação para ter acesso ao sistema.<br \>";
        $email_msg .= "Efetuar login aqui " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to, $email_from);
    }

    public function pedido_criado_by_admin_email($status_pedido, $codigo_pedido, $email_to) {
        $system_url = base_url();
        $email_sub = "Novo Pedido";
        $email_to = $email_to;
        $email_msg = "Um novo pedido foi encomendado.<br \>";
        $email_msg .= "Código do Pedido: " . $codigo_pedido . "<br \>";
        $email_msg .= "Status do Pedido: " . $status_pedido . "<br \>";
        $email_msg .= "Verifique os detalhes da encomenda: " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }

    public function pedido_criado_by_cliente_email($email_from, $cliente, $codigo_pedido, $status_pedido) {
        $system_url = base_url();
        $email_sub = "Novo Pedido";
        $email_from = $email_from;
        $email_to = $this->db->get_where('admin', array(
                    'idadmin' => '1'
                ))->row()->email;
        $email_msg = "Um novo pedido foi encomendado por " . $cliente . ".<br \>";
        $email_msg .= "Código do Pedido: " . $codigo_pedido . "<br \>";
        $email_msg .= "Status do Pedido: " . $status_pedido . "<br \>";
        $email_msg .= "Verifique os detalhes da encomenda: " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to, $email_from);
    }

    public function pagamento_efetuado($email_from, $cliente, $codigo_pedido, $status_pedido) {
        $system_url = base_url();
        $email_sub = "Pagamento efetuado do Pedido {$codigo_pedido}";
        $email_from = $email_from;
        $email_to = $this->db->get_where('admin', array(
                    'idadmin' => '1'
                ))->row()->email;
        $email_msg = "Pagamento efetuado do cliente: " . $cliente . ".<br \>";
        $email_msg .= "Código do Pedido: " . $codigo_pedido . "<br \>";
        $email_msg .= "Status do Pedido: " . $status_pedido . "<br \>";
        $email_msg .= "Data e hora do pagamento: " . date('d/m/y h:m:s') . "<br \>";
        $email_msg .= "Forma de pagamento via paypal.";
        $this->enviar_email($email_msg, $email_sub, $email_to, $email_from);
    }

    public function alteracao_status_pedido_email($status_pedido, $codigo_pedido, $email_to) {
        $system_url = base_url();
        $email_sub = "Pedido Atualizado";
        $email_to = $email_to;
        $email_msg = "Seu Pedido: " . $codigo_pedido . " foi " . $status_pedido . ".<br \>";
        $email_msg .= "Confira os detalhes do pedido " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }

    public function notificacao_mensagem_enviada_email_admin($email_to) {
        $system_url = base_url();
        $email_sub = "Nova Mensagem";
        $email_to = $email_to;
        $email_msg = "Você tem uma nova mensagem do administrador.<br \>";
        $email_msg .= "Verifique a mensagem no " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }

    public function notificacao_mensagem_enviada_email_usuario($tipo_conta, $email_from, $nome) {
        $system_url = base_url();
        $tipo_conta = $tipo_conta;
        $email_from = $email_from;
        $email_to = $this->db->get_where('admin', array(
                    'idadmin' => 1
                ))->row()->email;
        $email_sub = "Nova Mensagem";
        $email_msg = "Você tem uma nova mensagem do " . $tipo_conta . " " . $nome . ".<br \>";
        $email_msg .= "Verifique a mensagem no " . $system_url;
        $this->enviar_email($email_msg, $email_sub, $email_to, $email_from);
    }

    public function redefinir_senha_email($nova_senha, $email_to) {
        $system_url = base_url();
        $email_to = $email_to;
        $nova_senha = $nova_senha;
        $email_sub = "Solicitação de nova senha para acesso ao sistema";
        $email_msg = "Seu pedido de redefinição de senha foi concluído com sucesso.<br \>";
        $email_msg .= "Sua nova senha é: " . $nova_senha . "<br \>";
        $email_msg .= "Por favor faça o login aqui: " . $system_url . " com seu e-mail e nova senha.<br \>";
        $email_msg .= "Você pode alterar a senha após efetuar o login. Nas configurações do seu perfil.";
        $this->enviar_email($email_msg, $email_sub, $email_to);
    }

    public function enviar_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL, $attachment_url = NULL) {
        $config = array();
        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'grijalba21@gmail.com';
        $config['smtp_pass'] = 'Ygc5372620136';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);

        $query = $this->db->get('configuracoes')->result();
        $system_name = $query[0]->nome;

        if ($from == NULL) {
            $query = $this->db->get('configuracoes')->result();
            $from = $query[0]->email;
        }
        // attachment
        if ($attachment_url != NULL) {
            $this->email->attach($attachment_url);
        }
        $this->email->from($from, $system_name);
        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
        //echo $this->email->print_debugger();
    }

}

