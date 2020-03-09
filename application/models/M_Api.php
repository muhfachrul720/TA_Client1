<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_Api extends CI_Model {

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

            $this->db->select('*');
            $this->db->from($this->tschedule . ' as sch');
            $this->db->join($this->tuser . ' as us', 'us.id = sch.user_id');
            $this->db->where('sch.user_id', $where);
            $this->db->limit($limit, $start);
            $this->db->order_by('sch.id', 'DESC');

            return $this->db->get();
        }

    }

?>