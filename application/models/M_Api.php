<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_api extends CI_Model {

        protected $tschedule = 'table_schedule';
        protected $tuser = 'table_user';

        public function __construct()
        {
            parent::__construct();
        }

        public function get_schedulebyId($where, $limit, $start, $key)
        {
            if($key != null) {
                $this->db->like('keygen', $key);
                $this->db->or_like('child_name', $key);
                $this->db->or_like('teacher_name', $key);
                $this->db->or_like('parent_name', $key);
            }

            $this->db->select('sch.id as id, sch.child_name as child, sch.date as date, tr.teacher_name as teacher, pr.parent_name as parent, pr.parent_phone as phone, us.id as uid');
            $this->db->from("$this->tschedule as sch");
            $this->db->join('table_user as us', 'us.id = sch.user_id');
            $this->db->join('table_parent as pr', 'us.parent_id = pr.id');
            $this->db->join('table_teacher as tr', 'tr.id = sch.teacher_id');
            $this->db->where('sch.user_id', $where);
            $this->db->order_by('sch.id', 'DESC');
            $this->db->limit($limit, $start);
            
            // $this->db->select('*');
            // $this->db->from($this->tschedule . ' as sch');
            // $this->db->join($this->tuser . ' as us', 'us.id = sch.user_id');

            return $this->db->get();
        }

    }

?>