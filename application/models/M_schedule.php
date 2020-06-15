<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_schedule extends CI_Model {

    protected $table_name = 'table_schedule';
    protected $table_user = 'table_user';
    protected $table_teacher = 'table_teacher';

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
        $this->db->select('sch.id as id, sch.child_name as child, sch.date as date, tr.teacher_name as teacher, pr.parent_name as parent, pr.parent_phone as phone');
        $this->db->from("$this->table_name as sch");
        $this->db->join('table_user as us', 'us.id = sch.user_id');
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        $this->db->join('table_teacher as tr', 'tr.id = sch.teacher_id');

        if($like != null) {
            $this->db->or_like('sch.child_name', $like);
            $this->db->or_like('tr.teacher_name', $like);
            $this->db->or_like('pr.parent_name', $like);
        }

        $this->db->limit($number, $offset);
        $this->db->order_by('sch.id', 'DESC');
        return $this->db->get();
    }

    public function get_teacher_info()
    {
        $this->db->select('id, teacher_name');
        return $this->db->get($this->table_teacher);
    }

    public function get_userinfo()
    {
        $this->db->select('us.id as uid, pr.parent_name');
        $this->db->from("$this->table_user as us");
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        return $this->db->get();
    }

    public function get_parentNumber($from)
    {   
        $this->db->select('pr.parent_phone');
        $this->db->from("$this->table_user as us");
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        $this->db->where('us.id', $from);
        return $this->db->get();
    }

    public function insert_new($data)
    {
       return $this->db->insert($this->table_name, $data);
    }

    public function get_edit($from)
    {
        $this->db->select('sch.id as id, sch.child_name as child, sch.date as date, tr.id as tid, tr.teacher_name as teacher, pr.id as pid, pr.parent_name as parent, pr.parent_phone as phone');
        $this->db->from("$this->table_name as sch");
        $this->db->join('table_user as us', 'us.id = sch.user_id');
        $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
        $this->db->join('table_teacher as tr', 'tr.id = sch.teacher_id');
        $this->db->where('sch.id', $from);
        return $this->db->get();
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