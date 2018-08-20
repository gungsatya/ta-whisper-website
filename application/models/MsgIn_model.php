<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MsgIn_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($chat_id, $update_id, $message_id, $username, $surename, $content_type, $content, $flag = 'just_arrived')
    {
        $data = array(
            'chat_id' => $chat_id,
            'update_id' => $update_id,
            'message_id' => $message_id,
            'username' => $username,
            'surename' => $surename,
            'content_type' => $content_type,
            'content' => $content,
            'flag' => $flag,
            'received_at' => date('Y-m-d H:i:s')
        );
        $this->db->set($data);
        $this->db->insert('message_in');
        return $this->db->insert_id();
    }
}
