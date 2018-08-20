<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_current_page_records($category, $based, $keyword, $limit, $start)
    {
        if($category == "semua") {
            $this->db->select('id, token, chat_id, sector, is_replied, LEFT(content, 50) as content, created_at');
            $this->db->like($based, $keyword);
            $this->db->limit($limit, $start);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get("problem_report");
        } else {
            $this->db->select('id, token, chat_id, sector, is_replied, LEFT(content, 50) as content, created_at');
            $this->db->like($based, $keyword);
            $this->db->limit($limit, $start);
            $this->db->where('sector', $category);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get("problem_report");
        }
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_total($category, $based, $keyword)
    {
        if($category == "semua") {
            $this->db->like($based, $keyword);
            return $this->db->count_all_results("problem_report");
        } else {
            $this->db->from('problem_report');
            $this->db->where('sector', $category);
            $this->db->like($based, $keyword);
            return $this->db->count_all_results();
        }
    }
    public function update($id, $value)
    {
        try {
            $this->db->set($value);
            $this->db->where('id', $id);
            $this->db->update('problem_report');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            return $this->db->get('problem_report')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_token($token)
    {
        try {
            $this->db->where('token', $token);
            return $this->db->get('problem_report')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_rand()
    {
        try {
            $this->db->order_by('rand()');
            $this->db->limit(5);
            return $this->db->get('problem_report')->result();
        }
        catch(Exception $e) {
            return false;
        }
    }
}
