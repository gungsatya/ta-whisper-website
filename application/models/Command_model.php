<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Command_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_current_page_records($keyword, $limit, $start)
    {
        $this->db->select('command.id, operation.id as operation_id, chat_id, in_syntax, sql_query, flag, command.created_at');
        $this->db->join('operation', 'operation.id = command.operation_id');
        $this->db->like('chat_id', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by('command.id', 'desc');
        $query = $this->db->get("command");
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
        return $this->db->count_all_results("command");
    }
}
