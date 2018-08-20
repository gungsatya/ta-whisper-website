<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blackbox_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insertInbond($rawData)
    {
        $blackbox = $this->load->database('blackbox', TRUE);
        $blackbox->insert('inbond', array(
            'raw_data' => $rawData,
            'created_at' => date('Y-m-d H:i:s')
        ));
    }
    public function insertMsgInQueueOps($message_in_id)
    {
        $blackbox = $this->load->database('blackbox', TRUE);
        $blackbox->insert('message_in_queue_ops', array(
            'message_in_id' => $message_in_id
        ));
    }
    public function insertMsgInQueueSurvey($message_in_id)
    {
        $blackbox = $this->load->database('blackbox', TRUE);
        $blackbox->insert('message_in_queue_survey', array(
            'message_in_id' => $message_in_id
        ));
    }
    public function insertMsgOutQueue($message_out_id)
    {
        $blackbox = $this->load->database('blackbox', TRUE);
        $blackbox->insert('message_out_queue', array(
            'message_out_id' => $message_out_id
        ));
    }
}
