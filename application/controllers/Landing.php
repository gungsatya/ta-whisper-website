<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index()
	{
		$this->load->model('news_model');
		$this->load->model('report_model');

		$data['news_feeds'] 	= $this->news_model->get_by_limit(7);
		$data['reports']		= $this->report_model->get_rand();
		
		$this->load->view('landing', $data);
	}

	public function news()
	{
		$this->load->model('news_model');
		$data = array();
		$data['data'] 	 	= $this->news_model->get_by_url($this->uri->segment(2));
		$data['related'] 	= $this->news_model->get_rand();

		if($data['data']['id']==null)
		{
			redirect(base_url(),'refresh');
		}

		$this->load->view('news',$data);
	}

	public function report()
	{
		$this->load->model('report_model');
		$data = array();
		$data['data'] 	 			= $this->report_model->get_by_token($this->uri->segment(2));
		if($data['data']['id']==null)
		{
			redirect(base_url(),'refresh');
		}

		$this->load->view('report', $data);
	}

	public function survey()
	{
		$this->load->model('survey_model');
		$this->load->model('surveyQuestion_model');

		$survey_id = $this->uri->segment(2);

        $survey = $this->survey_model->get_by_id($survey_id);

		if($survey)
		{
			
			$data['data'] 		= $survey;

			$data['data_sq']	= $this->surveyQuestion_model->get_by_survey_id($survey['id']);
			
			$this->load->view('survey', $data);
		}
		else{
			redirect(base_url(),'refresh');
		}
	}

	public function error404()
	{
		$this->load->view('errors/page-error-404');
	}
}