<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SurveyQuestion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function add($data)
    {
        try {
            $this->db->set($data);
            $this->db->insert('survey_question');
            $id = $this->db->insert_id();
            $this->db->where('id', $id);
            return $this->db->get('survey_question')->row_array();
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
            $this->db->update('survey_question');
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
            return $this->db->get('survey_question')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function delete_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('survey_question');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function delete_by_survey_id($survey_id)
    {
        try {
            $this->db->where('survey_id', $survey_id);
            $this->db->delete('survey_question');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_survey_id($survey_id)
    {
        $this->db->where('survey_id', $survey_id);
        $query = $this->db->get('survey_question');
        if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                $row['amount_respond'] = $this->get_amount_all($row['id']);
                $row['results']        = $this->get_result($row['id']);
                $data[]                = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_result($survey_question_id)
    {
        $this->db->where('id', $survey_question_id);
        $sq = $this->db->get('survey_question')->row_array();
        if($sq['is_closed']) {
            $answers = explode(',', $sq['answers']);
            foreach($answers as $answer) {
                $this->db->where('survey_question_id', $survey_question_id);
                $this->db->where('respond', $answer);
                $query  = $this->db->count_all_results('survey_respond');
                $data[] = array(
                    'answer' => $answer,
                    'amount' => $query
                );
            }
        } else {
            $this->db->where('survey_question_id', $survey_question_id);
            $data = $this->db->get('survey_respond')->result_array();
        }
        return $data;
    }
    public function get_amount_all($survey_question_id)
    {
        $this->db->where('survey_question_id', $survey_question_id);
        return $this->db->count_all_results('survey_respond');
    }
}