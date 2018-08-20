<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function masuk()
    {
        if(!is_null($this->session->userdata('id'))) {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->view('login');
    }
    public function dashboard()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('news_model');
        $this->load->model('report_model');
        $this->load->model('command_model');
        $this->load->model('patternControl_model');
        $this->load->model('summary_model');

        $usr_responds = $this->summary_model->avg_user_respond();
        $sum_time   = 0;
        $cnt        = 0;
        foreach ($usr_responds as $respond) {
            if($respond['delay'] != NULL )
            {
                $sum_time =  $sum_time + (int)$respond['delay'];
                $cnt ++;
            }
        }

        $data = array(
            'load_page' => "Dashboard",
            'news_count' => $this->news_model->get_total("semua", ""),
            'report_count' => $this->report_model->get_total("semua", "id", ""),
            'command_count' => $this->command_model->get_total(""),
            'user_count' => $this->patternControl_model->get_total(""),
            'report_list' => array(
                array(
                    'sector' => 'Infrastruktur',
                    'amount' => $this->report_model->get_total("infrastruktur", "id", "")
                ),
                array(
                    'sector' => 'Kesehatan',
                    'amount' => $this->report_model->get_total("kesehatan", "id", "")
                ),
                array(
                    'sector' => 'Pendidikan',
                    'amount' => $this->report_model->get_total("pendidikan", "id", "")
                ),
                array(
                    'sector' => 'Administrasi',
                    'amount' => $this->report_model->get_total("administrasi", "id", "")
                ),
                array(
                    'sector' => 'Lainnya',
                    'amount' => $this->report_model->get_total("lainnya", "id", "")
                )
            ),
            'avg_processed_finish'  => $this->summary_model->avg_finished(),
            'avg_msg_in_proc'       => $this->summary_model->avg_msg_in_proc(),
            'avg_msg_out_proc'      => $this->summary_model->avg_msg_out_proc(),
            'avg_usr_respond'       => $sum_time/$cnt
        );
        $this->load->view('temp-panel', $data);
    }
    public function akun()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('account_model');
        $data              = array();
        $data['load_page'] = "Akun";
        $limit_per_page    = 5;
        $page              = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;
        $total_records     = $this->account_model->get_total();
        if($total_records > 0) {
            $data["results"]              = $this->account_model->get_current_page_records($limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/akun');
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 3;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function buat_berita()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $data = array(
            'load_page' => "Buat Berita"
        );
        $this->load->view('temp-panel', $data);
    }
    public function daftar_berita()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('news_model');
        $data              = array();
        $data['load_page'] = "Daftar Berita";
        $data['results']   = null;
        $data['links']     = null;
        if($this->uri->segment(3) == "infrastruktur" || $this->uri->segment(3) == "kesehatan" || $this->uri->segment(3) == "pendidikan" || $this->uri->segment(3) == "administrasi" || $this->uri->segment(3) == "lainnya") {
            $category = $this->uri->segment(3);
        } else {
            if($this->session->userdata('category')=='all'){
                $category = "semua";
            } else if($this->session->userdata('category')=='adm'){
                $category = "administrasi";
            } else if($this->session->userdata('category')=='infra'){
                $category = "infrastruktur";
            } else if($this->session->userdata('category')=='kes'){
                $category = "kesehatan";
            } else if($this->session->userdata('category')=='pend'){
                $category = "pendidikan";
            } else if($this->session->userdata('category')=='lainnya'){
                $category = "lainnya";
            }
            else{
                redirect(base_url('panel'), 'refresh');
            }
        }
        $keyword        = $this->input->get('keyword');
        $limit_per_page = 6;
        $page           = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $total_records  = $this->news_model->get_total($category, $keyword);
        if($total_records > 0) {
            $data["results"]              = $this->news_model->get_current_page_records($category, $limit_per_page, $page * $limit_per_page, $keyword);
            $config['base_url']           = base_url('panel/berita/') . $category;
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 4;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function ubah_berita()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('news_model');
        $data              = array();
        $data['load_page'] = "Ubah Berita";
        $data['data']      = $this->news_model->get_by_id($this->uri->segment(4));
        $this->load->view('temp-panel', $data);
    }
    public function buat_survei()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $data = array(
            'load_page' => "Buat Survei"
        );
        $this->load->view('temp-panel', $data);
    }
    public function daftar_survei()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('survey_model');
        $data              = array();
        $data['load_page'] = "Daftar Survei";
        $data['results']   = null;
        $data['links']     = null;
        $based             = $this->input->get('based');
        $keyword           = $this->input->get('keyword');
        if($based == '' || $keyword == '') {
            $limit_per_page = 5;
            $page           = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;
            $total_records  = $this->survey_model->get_total();
            if($total_records > 0) {
                $data["results"]              = $this->survey_model->get_current_page_records($limit_per_page, $page * $limit_per_page);
                $config['base_url']           = base_url('panel/survei');
                $config['total_rows']         = $total_records;
                $config['per_page']           = $limit_per_page;
                $config["uri_segment"]        = 3;
                $config['num_links']          = 2;
                $config['use_page_numbers']   = TRUE;
                $config['reuse_query_string'] = TRUE;
                $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
                $config['full_tag_close']     = '</ul></nav>';
                $config['first_link']         = 'First Page';
                $config['first_tag_open']     = '<li class="page-item">';
                $config['first_tag_close']    = '</li>';
                $config['last_link']          = 'Last Page';
                $config['last_tag_open']      = '<li class="page-item">';
                $config['last_tag_close']     = '</li>';
                $config['next_link']          = 'Next Page';
                $config['next_tag_open']      = '<li class="page-item">';
                $config['next_tag_close']     = '</li>';
                $config['prev_link']          = 'Prev Page';
                $config['prev_tag_open']      = '<li class="page-item">';
                $config['prev_tag_close']     = '</li>';
                $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
                $config['cur_tag_close']      = '</a></li>';
                $config['num_tag_open']       = '<li class="page-item">';
                $config['num_tag_close']      = '</li>';
                $config['attributes']         = array(
                    'class' => 'page-link'
                );
                $this->pagination->initialize($config);
                $data["links"] = $this->pagination->create_links();
            }
        } else if($based == 'title') {
            $data["results"] = $this->survey_model->get_based_title($keyword);
        } else if($based == "explanation") {
            $data["results"] = $this->survey_model->get_based_explanation($keyword);
        }
        $this->load->view('temp-panel', $data);
    }
    public function hasil_survei()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('survey_model');
        $this->load->model('surveyQuestion_model');
        $survey = $this->survey_model->get_by_id($this->uri->segment(4));
        if($survey) {
            $data            = array(
                'load_page' => "Hasil Survei"
            );
            $data['data']    = $survey;
            $data['data_sq'] = $this->surveyQuestion_model->get_by_survey_id($survey['id']);
            $this->load->view('temp-panel', $data);
        }
    }
    public function daftar_pengaduan()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('report_model');
        $data              = array();
        $data['load_page'] = "Daftar Pengaduan";
        $data['results']   = null;
        $data['links']     = null;
        if($this->uri->segment(3) == "infrastruktur" || $this->uri->segment(3) == "kesehatan" || $this->uri->segment(3) == "pendidikan" || $this->uri->segment(3) == "administrasi" || $this->uri->segment(3) == "lainnya") {
            $category = $this->uri->segment(3);
        } else {
            if($this->session->userdata('category')=='all'){
                $category = "semua";
            } else if($this->session->userdata('category')=='adm'){
                $category = "administrasi";
            } else if($this->session->userdata('category')=='infra'){
                $category = "infrastruktur";
            } else if($this->session->userdata('category')=='kes'){
                $category = "kesehatan";
            } else if($this->session->userdata('category')=='pend'){
                $category = "pendidikan";
            } else if($this->session->userdata('category')=='lainnya'){
                $category = "lainnya";
            }
            else{
                redirect(base_url('panel'), 'refresh');
            }
        }
        $based = $this->input->get('based');
        if($based == 'chat_id' || $based == 'content') {
            $keyword = $this->input->get('keyword');
        } else if($based == 'is_replied') {
            $keyword = 0;
        } else {
            $based   = 'chat_id';
            $keyword = '';
        }
        $limit_per_page = 10;
        $page           = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $total_records  = $this->report_model->get_total($category, $based, $keyword);
        if($total_records > 0) {
            $data["results"]              = $this->report_model->get_current_page_records($category, $based, $keyword, $limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/pengaduan/') . $category;
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 4;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function detail_pengaduan()
    {
        if(is_null($this->session->userdata('id'))) {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('report_model');
        $this->load->model('discussion_model');
        $this->load->model('patternControl_model');
        $data                    = array();
        $data['load_page']       = "Detail Pengaduan";
        $data['data']            = $this->report_model->get_by_id($this->uri->segment(4));
        $data['discussion']      = $this->discussion_model->get_discuss($data['data']['token']);
        $data['pattern_control'] = $this->patternControl_model->get_by_chat_id($data['data']['chat_id']);
        $this->load->view('temp-panel', $data);
    }
    public function kontrol_pola()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('patternControl_model');
        $data              = array();
        $data['load_page'] = "Kontrol Pola";
        $data['results']   = null;
        $data['links']     = null;
        $keyword           = $this->input->get('keyword');
        $limit_per_page    = 10;
        $page              = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
        $total_records     = $this->patternControl_model->get_total($keyword);
        if($total_records > 0) {
            $data["results"]              = $this->patternControl_model->get_current_page_records($keyword, $limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/pola/kontrol');
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 4;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function daftar_pola()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('pattern_model');
        $data              = array();
        $data['load_page'] = "Pola";
        $data['results']   = null;
        $data['links']     = null;
        $keyword           = $this->input->get('keyword');
        $limit_per_page    = 10;
        $page              = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;
        $total_records     = $this->pattern_model->get_total($keyword);
        if($total_records > 0) {
            $data["results"]              = $this->pattern_model->get_current_page_records($keyword, $limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/pola');
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 3;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function detail_pola()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('pattern_model');
        $data               = array();
        $data['load_page']  = "Detail Pola";
        $data['data']       = $this->pattern_model->get_by_id($this->uri->segment(4));
        $data['data_param'] = $this->pattern_model->get_param_by_pattern_id($this->uri->segment(4));
        $this->load->view('temp-panel', $data);
    }
    public function perintah()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('command_model');
        $data              = array();
        $data['load_page'] = "Perintah";
        $data['results']   = null;
        $data['links']     = null;
        $keyword           = $this->input->get('keyword');
        $limit_per_page    = 10;
        $page              = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;
        $total_records     = $this->command_model->get_total($keyword);
        if($total_records > 0) {
            $data["results"]              = $this->command_model->get_current_page_records($keyword, $limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/perintah');
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 3;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
    public function daftar_operasi()
    {
        if($this->session->userdata('privilege') != "administrator") {
            redirect(base_url('panel'), 'refresh');
        }
        $this->load->model('operation_model');
        $data              = array();
        $data['load_page'] = "Daftar Operasi";
        $data['results']   = null;
        $data['links']     = null;
        $keyword           = $this->input->get('keyword');
        $limit_per_page    = 10;
        $page              = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;
        $total_records     = $this->operation_model->get_total($keyword);
        if($total_records > 0) {
            $data["results"]              = $this->operation_model->get_current_page_records($keyword, $limit_per_page, $page * $limit_per_page);
            $config['base_url']           = base_url('panel/operasi');
            $config['total_rows']         = $total_records;
            $config['per_page']           = $limit_per_page;
            $config["uri_segment"]        = 3;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open']      = '<nav aria-label="..."><ul class="pagination justify-content-center">';
            $config['full_tag_close']     = '</ul></nav>';
            $config['first_link']         = 'First Page';
            $config['first_tag_open']     = '<li class="page-item">';
            $config['first_tag_close']    = '</li>';
            $config['last_link']          = 'Last Page';
            $config['last_tag_open']      = '<li class="page-item">';
            $config['last_tag_close']     = '</li>';
            $config['next_link']          = 'Next Page';
            $config['next_tag_open']      = '<li class="page-item">';
            $config['next_tag_close']     = '</li>';
            $config['prev_link']          = 'Prev Page';
            $config['prev_tag_open']      = '<li class="page-item">';
            $config['prev_tag_close']     = '</li>';
            $config['cur_tag_open']       = '<li class="page-item"><a class="page-link disabled">';
            $config['cur_tag_close']      = '</a></li>';
            $config['num_tag_open']       = '<li class="page-item">';
            $config['num_tag_close']      = '</li>';
            $config['attributes']         = array(
                'class' => 'page-link'
            );
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('temp-panel', $data);
    }
}