<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Operation_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        try {
            $this->db->set($data);
            $this->db->insert('operation');
            $id = $this->db->insert_id();
            return $id;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('operation');
    }
    public function get_current_page_records($keyword, $limit, $start)
    {
        $this->db->like('in_syntax', $keyword);
        $this->db->limit($limit, $start);
        $query = $this->db->get("operation");
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
        $this->db->like('in_syntax', $keyword);
        return $this->db->count_all_results("operation");
    }
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('operation');
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
}