<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Survey_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_current_page_records($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("survey");
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_total()
    {
        return $this->db->count_all("survey");
    }
    public function add($data)
    {
        try {
            $this->db->set($data);
            $this->db->insert('survey');
            $id = $this->db->insert_id();
            return $id;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function update($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('survey');
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
            return $this->db->get('survey')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function delete_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('survey');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_based_title($title)
    {
        $this->db->like('title', $title);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("survey");
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_based_explanation($explanation)
    {
        $this->db->like('explanation', $explanation);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("survey");
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
