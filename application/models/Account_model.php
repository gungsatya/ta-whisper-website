<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function login($acc, $psw)
    {
        $this->db->select('id, surename, category, privilege');
        $this->db->from('account');
        $this->db->where('user_identifier', $this->db->escape_str($acc));
        $this->db->where('password', md5($psw));
        return $this->db->get()->row_array();
    }
    public function get_current_page_records($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("account");
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
        return $this->db->count_all("account");
    }
    public function checkUserIdentifier($identifier)
    {
        $this->db->where('user_identifier', $identifier);
        $query = $this->db->get('account');
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function add($data)
    {
        try {
            $this->db->insert('account', $data);
            $id = $this->db->insert_id();
            $this->db->where('id', $id);
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
            $this->db->update('account');
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
            return $this->db->get('account')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function delete_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('account');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
}