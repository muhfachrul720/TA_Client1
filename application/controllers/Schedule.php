<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_schedule');
    }

    public function index()
    {   
        $total = $this->m_schedule->total_row()->num_rows();
        $from = $this->uri->segment(3);
        $this->pagination->initialize(cs_pagination('schedule/index', $total, 10));

        $data['schedule'] = $this->m_schedule->get_schedule(10, $from, $this->input->post('search'))->result();

        $this->load->view('parts/header');
        $this->load->view('dashboard', $data);
    }

    public function add_schedule()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('childname', 'Nama Anak', 'required');
        $this->form_validation->set_rules('teachername', 'Nama Guru', 'required');
        $this->form_validation->set_rules('parentname', 'Nama Ortu', 'required');
        $this->form_validation->set_rules('phonenumber', 'No HP', 'required');
        $this->form_validation->set_rules('date', 'Hari Dan Jam', 'required');
        $this->form_validation->set_rules('time', 'Hari Dan Jam', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
            redirect('schedule');
        }
        else {
            $data = array(
                'keygen' => $post['id'],
                'child_name' => $post['childname'],
                'teacher_name' => $post['teachername'],
                'parent_name' => $post['parentname'],
                'phone_number' => $post['phonenumber'],
                'date' => $post['date'].' '.$post['time'],
            );
            
            if($this->m_schedule->insert_new($data)){
                $this->session->set_flashdata('Alert', 'Berhasil Memasukkan Data');
                redirect('schedule/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
                redirect('schedule');
            };
        }
    }

    public function get_dataEdit()
    {
        $post = $this->input->post();
        if($result = $this->m_schedule->get_edit($post['id'])->result()){

            foreach ($result as $res){
                $x = explode(' ', $res->date);
                $dataid = array(
                    'keygen' => $res->keygen,
                    'childName' => $res->child_name,
                    'teacherName' => $res->teacher_name,
                    'parentName' => $res->parent_name,
                    'phoneNumber' => $res->phone_number,
                    'date' => $x[0],
                    'time' => $x[1]
                );
            }
            
            echo json_encode($dataid);
        }
    }

    public function edit_schedule()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('childname', 'Nama Anak', 'required');
        $this->form_validation->set_rules('teachername', 'Nama Guru', 'required');
        $this->form_validation->set_rules('parentname', 'Nama Ortu', 'required');
        $this->form_validation->set_rules('phonenumber', 'No HP', 'required');
        $this->form_validation->set_rules('date', 'Hari Dan Jam', 'required');
        $this->form_validation->set_rules('time', 'Hari Dan Jam', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
            redirect('schedule');
        }
        else {
            $data = array(
                'keygen' => $post['id'],
                'child_name' => $post['childname'],
                'teacher_name' => $post['teachername'],
                'parent_name' => $post['parentname'],
                'phone_number' => $post['phonenumber'],
                'date' => $post['date'].' '.$post['time'],
            );

            if($this->m_schedule->update_old($data, $post['realid'])){
                $this->session->set_flashdata('Alert', 'Berhasil Mengedit Data');
                redirect('schedule/index');
            }
            else {
                $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
                redirect('schedule');
            };
        }
    }

    public function delete_schedule()
    {
        if($this->m_schedule->delete($this->input->post('id'))){
            $this->session->set_flashdata('Alert', 'Berhasil Menghapus Data');
            redirect('schedule/index');
        }
        else {
            $this->session->set_flashdata('Alert', 'Gagal Memasukkan Data');
            redirect('schedule');
        }
    }

}
?>