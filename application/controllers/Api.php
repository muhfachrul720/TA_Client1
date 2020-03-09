<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class\
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_api');
        $this->load->model('m_schedule');
    }

    public function login_post()
    {
        // Get the Post Data
        $email = $this->post('email');
        $pass = md5($this->post('password'));

        if(!empty($email) && !empty($pass)){

            $con['returnType'] = "single";

            if($user = $this->m_user->check_user($where = array('email' => $email, 'password' => $pass))->row()){

                $this->response([
                    'status' => TRUE,
                    'message' => 'User Login Successful',
                    'data' => $user 
                ], RestController::HTTP_OK);
            }
            else {
                $this->response([
                    'message' => "Wrong email or password.",
                    'status' => FALSE 
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
        else {
            $this->response([
                'message' => "Provide Email And Password.",
                'status' => FALSE 
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function jadwal_get()
    { 
        $limit = $this->get('limit');
        $start = $this->get('start');
        $key =   $this->get('key`');
        $order = $this->get('order');
        $where = $this->get('id');

        if(!empty($where)){
            $schedule = $this->m_api->get_schedulebyId($where, $limit, $start, $key)->result();
            $this->response(var_dump($schedule), 200);
        }
        else {
            $this->response("Such A Data Doesn't Exist", RestController::HTTP_BAD_REQUEST);
        }

    }
    
}