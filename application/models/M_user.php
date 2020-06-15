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
        $this->db->select('us.id, us.email, pr.id, pr.parent_name, pr.parent_phone, pr.parent_address');
        $this->db->from("$this->table_name as us");
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        $this->db->where($where);
        return $this->db->get();
        // return $this->db->get_where($this->table_name, $where);
    }

    public function total_row()
    {
        $this->db->select('id');
        return $this->db->get($this->table_name);
    }

    public function get_data($number, $offset, $like = null)
    {   
        $this->db->select('us.id, us.email, pr.id, pr.parent_name, pr.parent_phone, pr.parent_address');
        $this->db->from("$this->table_name as us");
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        if($like != null) {
            $this->db->like('pr.parent_name', $like);
            $this->db->or_like('email', $like);
        }
        $this->db->limit($number, $offset);
        $this->db->order_by('us.id', 'DESC');
        return $this->db->get();
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
        $this->db->select('us.id, us.email, pr.id as pid, pr.parent_name, pr.parent_phone, pr.parent_address');
        $this->db->from("$this->table_name as us");
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        $this->db->where('us.id', $from);
        return $this->db->get();
    }

    public function get_parentid($from)
    {
        $this->db->select('parent_id');
        $this->db->where('id', $from);
        return $this->db->get($this->table_name);
    }

    public function update_old($data, $from)
    {
        $this->db->where('id', $from);
        return $this->db->update($this->table_name, $data);
    }

}