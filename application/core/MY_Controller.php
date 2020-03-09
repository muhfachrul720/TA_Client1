<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('status') != 1){
            redirect('auth');
        }

        $this->load->library('form_validation');
        $this->load->helper('pagination');
    }

}
