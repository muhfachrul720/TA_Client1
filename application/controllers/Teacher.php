<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_teacher');
    }

    public function index()
    {
        $total = $this->m_teacher->total_row()->num_rows();
        $from = $this->uri->segment(3);
        $this->pagination->initialize(cs_pagination('teacher/index', $total, 10));

        $data['result'] = $this->m_teacher->get_data(10, $from, $this->input->post('search'))->result();

        $this->load->view('parts/header');
        $this->load->view('admin_teacher', $data);
    }

    public function add_teacher()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('name', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('phone', 'No HP', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
            redirect('teacher');
        }
        else {
            $data = array(
                'teacher_name' => $post['name'],
                'teacher_phone' => $post['phone'],
                'teacher_status' => 1,
                'teacher_address' => $post['address']
            );
            
            if($this->m_teacher->insert_new($data)){
                $this->session->set_flashdata('Alert', 'Berhasil Menambah Pengguna');
                redirect('teacher/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
                redirect('teacher');
            };
        }
    }

    public function delete_teacher()
    {
        if($this->m_teacher->delete($this->input->post('id'))){
            $this->session->set_flashdata('Alert', 'Berhasil Menghapus Data');
            redirect('teacher/index');
        }
        else {
            $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
            redirect('teacher');
        }
    }

    public function get_dataEdit()
    {
        $post = $this->input->post();
        if($result = $this->m_teacher->get_edit($post['id'])->result()){

            foreach ($result as $res){
                $dataid = array(
                    'name' => $res->teacher_name,
                    'phone' => $res->teacher_phone,
                    'address' => $res->teacher_address
                );
            }
            
            echo json_encode($dataid);
        }
    }
    
    public function edit_teacher()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('name', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('phone', 'No HP', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
            redirect('teacher');
        }
        else {
            $data = array(
                'teacher_name' => $post['name'],
                'teacher_phone' => $post['phone'],
                'teacher_status' => 1,
                'teacher_address' => $post['address']
            );
            
            if($this->m_teacher->update_old($data, $post['id'])){
                $this->session->set_flashdata('Alert', 'Berhasil Menambah Pengguna');
                redirect('teacher/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Menambah Pengguna');
                redirect('teacher');
            };
        }
    }


}