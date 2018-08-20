<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Summary_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function avg_finished()
    {
        $this->db->select('`in_syntax`, SUM(`last_updated_at`-`created_at`)/(count(operation_id)) AS `avg_finished`');
        $this->db->join('operation','operation.id = operation_id');
        $this->db->group_by('operation_id');
        $this->db->where('flag','finish');
        return $this->db->get('pattern')->result_array();
    }
    public function avg_user_respond()
    {
        return $this->db->query('SELECT created_at, TIMESTAMPDIFF(SECOND, (SELECT MAX(`created_at`) FROM pattern_param WHERE `created_at` < t.`created_at` AND pattern_id = t.`pattern_id`), `created_at`) AS `delay` FROM `pattern_param` AS t ORDER BY id DESC LIMIT 100')->result_array();
    }
    public function avg_msg_in_proc()
    {
        $this->db->select('SUM(`last_updated_at`-`received_at`)/(count(id)) AS `avg_finished`');
        $this->db->where('flag','processed');
        $this->db->order_by('id', 'desc');
        $this->db->limit('20');
        return $this->db->get('message_in')->row_array();
    }
    public function avg_msg_out_proc()
    {
        $this->db->select('SUM(`last_updated_at`-`created_at`)/(count(id)) AS `avg_finished`');
        $this->db->where('flag','sent');
        $this->db->order_by('id', 'desc');
        $this->db->limit('20');
        return $this->db->get('message_out')->row_array();
    }
}
