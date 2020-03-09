<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_schedule extends CI_Model {

    protected $table_name = 'table_schedule';

    public function __construct()
    {
        parent::__construct();
    }

    public function total_row()
    {
        $this->db->select('id');
        return $this->db->get($this->table_name);
    }

    public function get_schedule($number, $offset, $like = null)
    {
        if($like != null) {
            $this->db->like('keygen', $like);
            $this->db->or_like('child_name', $like);
            $this->db->or_like('teacher_name', $like);
            $this->db->or_like('parent_name', $like);
        }

        $this->db->limit($number, $offset);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table_name);
    }

    public function insert_new($data)
    {
       return $this->db->insert($this->table_name, $data);
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

    public function delete($from)
    {
        $this->db->where('id', $from);
        return $this->db->delete($this->table_name);
    }

}

?>