<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pattern_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_by_id($id)
    {
        $this->db->select('pattern.id, chat_id, in_syntax, flag, pattern.created_at, explain, is_read_command, is_sql_command');
        $this->db->join('operation', 'operation.id = pattern.operation_id');
        $this->db->where('pattern.id', $id);
        $query = $this->db->get('pattern');
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
    public function get_param_by_pattern_id($pattern_id)
    {
        $this->db->where('pattern_id', $pattern_id);
        $query = $this->db->get('pattern_param');
        if($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function get_current_page_records($keyword, $limit, $start)
    {
        $this->db->select('pattern.id, operation.id AS operation_id, chat_id, in_syntax, flag, pattern.created_at');
        $this->db->join('operation', 'operation.id = pattern.operation_id');
        $this->db->like('chat_id', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by('pattern.id', 'desc');
        $query = $this->db->get("pattern");
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_total($keyword)
    {
        $this->db->like('chat_id', $keyword);
        return $this->db->count_all_results("pattern");
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('pattern');
    }
}