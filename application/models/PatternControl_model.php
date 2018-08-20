<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PatternControl_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('pattern_control');
    }
    public function update($chat_id, $data)
    {
        $this->db->where('chat_id', $chat_id);
        $this->db->set($data);
        $this->db->update('pattern_control');
    }
    public function broadcast_news($news_id)
    {
        try {
            $this->db->select('chat_id');
            $this->db->where('is_subscribed',1);
            $chats = $this->db->get('pattern_control')->result_array();
            foreach($chats as $chat) {
                $this->db->set(array(
                    'chat_id' => $chat['chat_id'],
                    'news_id' => $news_id
                ));
                $this->db->insert('news_broadcast');
            }
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function broadcast_survey($survey_id)
    {
        try {
            $this->db->select('chat_id');
            $this->db->where('is_subscribed',1);
            $chats = $this->db->get('pattern_control')->result_array();
            foreach($chats as $chat) {
                $this->db->set(array(
                    'chat_id' => $chat['chat_id'],
                    'survey_id' => $survey_id
                ));
                $this->db->insert('survey_broadcast');
            }
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_chat_id($chat_id)
    {
        $this->db->where('chat_id', $chat_id);
        $query = $this->db->get('pattern_control');
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
    public function get_current_page_records($keyword, $limit, $start)
    {
        $this->db->like('chat_id', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by('chat_id', 'desc');
        $query = $this->db->get("pattern_control");
        if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                $row['in_syntax']  = '';
                $row['param_in']   = '';
                $row['report_id']  = '';
                if($row['current_processed']=='operation'){
                    $operation  = $this->db->get_where('operation', array('id'=>$row['current_ops_id']))->row_array();
                    $param      = $this->db->get_where('param_in', array('id'=>$row['current_param_in_id']))->row_array();
                    $row['in_syntax'] = $operation['in_syntax'];
                    $row['param_in']  = $param['param_in'];
                }
                if($row['current_processed']=='discussion'){
                    $report = $this->db->get_where('problem_report', array('token'=>$row['current_report_discussion_token']))->row_array();
                    $row['report_id']  = $report['id'];
                }
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_total($keyword)
    {
        $this->db->like('chat_id', $keyword);
        return $this->db->count_all_results("pattern_control");
    }
}
 