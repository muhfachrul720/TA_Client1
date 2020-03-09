<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    protected $table_name = 'table_user';

    public function __construct()
    {
        parent::__construct();
    }

    public function check_user($where)
    {   
        return $this->db->get_where($this->table_name, $where);
    }

    public function total_row()
    {
        $this->db->select('id');
        return $this->db->get($this->table_name);
    }

    public function get_data($number, $offset, $like = null)
    {
        if($like != null) {
            $this->db->like('name', $like);
            $this->db->or_like('email', $like);
        }
        $this->db->limit($number, $offset);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table_name);
    }

    public function insert_new($data)
    {
       return $this->db->insert($this->table_name, $data);
    }

    public function delete($from)
    {
        $this->db->where('id', $from);
        return $this->db->delete($this->table_name);
    }

    public function get_edit($from)
    {
        $this->db->where('id', $from);
        return $this->db->get($this->table_name);
    }

    public function update_old($data, $from)
    {
        $this->db->where('id', $from);
        return $this->db->update($this->table_name, $data);
    }

}