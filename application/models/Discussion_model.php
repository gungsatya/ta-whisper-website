<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discussion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('discussion');
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('discussion');
    }
    public function get_discuss($token, $more_than_id = 0, $limit = 0)
    {
        $this->db->where('id >', $more_than_id);
        $this->db->where('report_token', $token);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get('discussion');
        if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_last_user_chat($token, $chat_id)
    {
        $this->db->where('chat_id', $chat_id);
        $this->db->where('report_token', $token);
        $this->db->where('privilege', 'user');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('discussion');
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
}