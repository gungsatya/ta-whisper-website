<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MsgOut_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($chat_id, $content, $is_reply = 0, $reply_message_id = '')
    {
        try {
            $this->load->model('blackbox_model');
            $data = array(
                'chat_id' => $chat_id,
                'content_type' => 'text',
                'content' => $content,
                'is_reply' => $is_reply,
                'reply_message_id' => $reply_message_id,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->set($data);
            $this->db->insert('message_out');
            $message_out_id = $this->db->insert_id();
            $this->blackbox_model->insertMsgOutQueue($message_out_id);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
}
