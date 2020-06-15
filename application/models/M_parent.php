<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_parent extends CI_Model {

    protected $table_name = 'table_parent';

    public function __construct()
    {
        parent::__construct();
    }

    public function add_new($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function delete($from)
    {
        // var_dump($from);
        $this->db->where('id', $from);
        return $this->db->delete($this->table_name);
    }

    public function update_old($data, $from)
    {
        $this->db->where('id', $from);
        return $this->db->update($this->table_name, $data);
    }

}