<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documentacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_login')) {
            redirect(base_url('login'));
        }
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $this->load->view('admin/documentacao');
    }

}
