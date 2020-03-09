<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('pagination');
    }

    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('video_page');
    }
}