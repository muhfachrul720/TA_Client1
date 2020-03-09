<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('parts/header');
		$this->load->view('login_page');
	}

	public function check_user()
	{
		$post = $this->input->post();

		if($post['username'] == 'admin' && $post['password'] == 'portalstudio'){
			$this->session->set_userdata('status', 1); 
		}
		redirect(base_url('schedule'));
	}

	public function sign_out()
	{
		session_destroy();
		redirect('auth');
	}
}
