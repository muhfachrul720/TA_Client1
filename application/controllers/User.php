<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_parent');
    }

    public function index()
    {
        $total = $this->m_user->total_row()->num_rows();
        $from = $this->uri->segment(3);
        $this->pagination->initialize(cs_pagination('user/index', $total, 10));

        $data['result'] = $this->m_user->get_data(10, $from, $this->input->post('search'))->result();

        $this->load->view('parts/header');
        $this->load->view('admin_user', $data);
    }

    public function add_user()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('name', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'No HP', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
            redirect('user');
        }
        else {
            $data_parent = array(
                'parent_name' => $post['name'],
                'parent_phone' => $post['phone'],
                'parent_address' => $post['address'],
            );
            $parent_id = $this->m_parent->add_new($data_parent);

            $data = array(
                'parent_id' => $parent_id,
                'email' => $post['email'],
                'password' => md5(substr(explode('@' , $post['email'])[0], -3, 3)),
            );
            
            if($this->m_user->insert_new($data)){
                $this->session->set_flashdata('Alert', 'Berhasil Menambah Pengguna');
                redirect('user/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
                redirect('user');
            };
        }
    }

    public function get_dataEdit()
    {
        $post = $this->input->post();
        if($result = $this->m_user->get_edit($post['id'])->result()){

            foreach ($result as $res){
                $dataid = array(
                    'p_id' => $res->pid,
                    'name' => $res->parent_name,
                    'email' => $res->email,
                    'phone' => $res->parent_phone,
                    'address' => $res->parent_address
                );
            }
            
            echo json_encode($dataid);
        }
    }

    public function delete_user()
    {
        $row = $this->m_user->get_parentid($this->input->post('id'))->row();
        if($this->m_user->delete($this->input->post('id'))){
            if($this->m_parent->delete($row->parent_id)){
            $this->session->set_flashdata('Alert', 'Berhasil Menghapus Data');
            redirect('user/index');
            }
        }
        else {
            $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
            redirect('user');
        }
    }

    public function edit_user()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('name', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'No HP', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
            redirect('user');
        }
        else {
            $data_parent = array(
                'parent_name' => $post['name'],
                'parent_phone' => $post['phone'],
                'parent_address' => $post['address'],
            );

            $this->m_parent->update_old($data_parent, $post['pid']);

            $data = array(
                'email' => $post['email'],
                'password' => md5(substr(explode('@' , $post['email'])[0], -3, 3)),
            );
            
            if($this->m_user->update_old($data, $post['id'])){
                $this->session->set_flashdata('Alert', 'Berhasil Menambah Pengguna');
                redirect('user/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
                redirect('user');
            };
        }
    }


   

}