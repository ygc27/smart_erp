<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    public function init() {
        $CI = &get_instance();

        $output = $CI->output->get_output();

        if (isset($CI->layout)) {

            if ($CI->layout) {

                $erro = $CI->session->flashdata('erro');
                $sucesso = $CI->session->flashdata('sucesso');

                if (!preg_match('/(.+).php$/', $CI->layout)):
                    $CI->layout .= '.php';
                endif;

                $template = APPPATH . 'templates/' . $CI->layout;

                if (file_exists($template)) {
                    $layout = $CI->load->file($template, TRUE);
                } else {
                    die('Template inválida.');
                }

                $html = str_replace("{CONTEUDO}", $output, $layout);

                if ($erro) {
                    $erro = $this->criaAlerta($erro, 'alert-danger');
                    $html = str_replace("{MENSAGEM_SISTEMA_ERRO}", $erro, $html);
                } else {
                    $html = str_replace("{MENSAGEM_SISTEMA_ERRO}", null, $html);
                }

                if ($sucesso) {
                    $sucesso = $this->criaAlerta($sucesso, 'alert-success');
                    $html = str_replace("{MENSAGEM_SISTEMA_SUCESSO}", $sucesso, $html);
                } else {
                    $html = str_replace("{MENSAGEM_SISTEMA_SUCESSO}", null, $html);
                }
            } else {
                $html = $output;
            }
        } else {
            $html = $output;
        }

        $CI->output->_display($html);
    }

    private function criaAlerta($mensagem, $tipo) {
        $html = "<div class=\"alert {$tipo}\">\n";
        $html .="\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n";
        $html .="\t{$mensagem}\n";
        $html .="</div>";
        return $html;
    }

}
