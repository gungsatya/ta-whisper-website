<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function isUserIdentifierExist($identifier)
    {
        $this->load->model('account_model');
        $this->load->library('form_validation');
        $is_exist = $this->account_model->checkUserIdentifier($identifier);
        if($is_exist) {
            $this->form_validation->set_message('isUserIdentifierExist', 'Akun telah digunakan. Cari yang lain.');
            return false;
        } else {
            return true;
        }
    }
    public function captcha()
    {
        $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");
        $background = imagecolorallocate($image, 0x66, 0xCC, 0xFF);
        imagefill($image, 0, 0, $background);
        $linecolor  = imagecolorallocate($image, 0x33, 0x99, 0xCC);
        $textcolor1 = imagecolorallocate($image, 0x00, 0x00, 0x00);
        $textcolor2 = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
        for($i = 0; $i < 6; $i++) {
            imagesetthickness($image, rand(1, 3));
            imageline($image, 0, rand(0, 30), 120, rand(0, 30), $linecolor);
        }
        $digit = '';
        for($x = 15; $x <= 95; $x += 20) {
            $textcolor = (rand() % 2) ? $textcolor1 : $textcolor2;
            $digit .= ($num = rand(0, 9));
            imagechar($image, rand(3, 5), $x, rand(2, 14), $num, $textcolor);
        }
        $this->session->set_userdata('sec_code', $digit);
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
    public function login()
    {
        $this->load->model('account_model');
        $captcha = $this->input->post('secret_code');
        if(($this->session->userdata('sec_code') == $captcha)) {
            $usr_acc = $this->input->post('usr_acc');
            $passwd  = $this->input->post('passwd');
            $user    = $this->account_model->login($usr_acc, $passwd);
            if($user) {
                $this->session->set_userdata('id', $user['id']);
                $this->session->set_userdata('surename', $user['surename']);
                $this->session->set_userdata('category', $user['category']);
                $this->session->set_userdata('privilege', $user['privilege']);
                echo json_encode(array(
                    "ok" => TRUE,
                    "message" => "Selamat Datang",
                    "user" => $user
                ), JSON_PRETTY_PRINT);
            } else {
                echo json_encode(array(
                    "ok" => FALSE,
                    "message" => "Username atau password salah"
                ), JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(array(
                "ok" => FALSE,
                "message" => "Captcha tidak sesuai/kosong"
            ), JSON_PRETTY_PRINT);
        }
    }
    public function logout()
    {
        session_destroy();
        redirect(base_url(), 'refresh');
    }
    public function account_add()
    {
        $this->load->model('account_model');
        try {
            $this->load->helper(array(
                'form',
                'url'
            ));
            $this->load->library('form_validation');
            $valid = array(
                array(
                    'field' => 'surename',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|min_length[3]|max_length[50]'
                ),
                array(
                    'field' => 'usr_acc',
                    'label' => 'Akun',
                    'rules' => 'required|alpha_numeric_spaces|callback_isUserIdentifierExist|min_length[5]|max_length[15]'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Kata sandi',
                    'rules' => 'required|alpha_numeric_spaces|min_length[5]|max_length[20]'
                ),
                array(
                    'field' => 'passconf',
                    'label' => 'Konfirmasi kata sandi',
                    'rules' => 'required|alpha_numeric_spaces|matches[password]|min_length[5]|max_length[20]'
                )
            );
            $this->form_validation->set_rules($valid);
            $this->form_validation->set_message('required', '<li><b>{field}</b> harus diisi</li>');
            $this->form_validation->set_message('alpha_numeric_spaces', '<li><b>{field}</b> hanya boleh berisi karakter a-z, A-Z, 0-9 dan spasi</li>');
            $this->form_validation->set_message('min_length', '<li><b>{field}</b> harus diisi minimal {param} karakter</li>');
            $this->form_validation->set_message('max_length', '<li><b>{field}</b> harus diisi maksimal {param} karakter</li>');
            $this->form_validation->set_message('matches', '<li><b>{field}</b> tidak cocok</li>');
            if($this->form_validation->run() == FALSE) {
                $error = validation_errors();
                echo json_encode(array(
                    "status" => FALSE,
                    "message" => $error
                ), JSON_PRETTY_PRINT);
            } else {
                $data = array(
                    'surename' => $this->input->post('surename'),
                    'privilege' => $this->input->post('privilege'),
                    'category' => $this->input->post('category'),
                    'user_identifier' => $this->input->post('usr_acc'),
                    'password' => md5($this->input->post('password')),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $acc  = $this->account_model->add($data);
                if($acc) {
                    echo json_encode(array(
                        "status" => TRUE,
                        "message" => "Data telah ditambahkan",
                        "acc" => $acc
                    ), JSON_PRETTY_PRINT);
                } else {
                    echo json_encode(array(
                        "status" => FALSE,
                        "message" => "Penambahan data gagal"
                    ), JSON_PRETTY_PRINT);
                }
            }
        }
        catch(Exception $e) {
            echo json_encode(array(
                "status" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function account_update()
    {
        $this->load->model('account_model');
        try {
            $this->load->helper(array(
                'form',
                'url'
            ));
            $this->load->library('form_validation');
            $valid = array(
                array(
                    'field' => 'surename',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|min_length[3]|max_length[50]'
                ),
                array(
                    'field' => 'usr_acc',
                    'label' => 'Akun',
                    'rules' => 'alpha_numeric_spaces|callback_isUserIdentifierExist|min_length[5]|max_length[15]'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Kata sandi',
                    'rules' => 'alpha_numeric_spaces|min_length[5]|max_length[20]'
                ),
                array(
                    'field' => 'passconf',
                    'label' => 'Konfirmasi kata sandi',
                    'rules' => 'alpha_numeric_spaces|matches[password]|min_length[5]|max_length[20]'
                )
            );
            $this->form_validation->set_rules($valid);
            $this->form_validation->set_message('required', '<li><b>{field}</b> harus diisi</li>');
            $this->form_validation->set_message('alpha_numeric_spaces', '<li><b>{field}</b> hanya boleh berisi karakter a-z, A-Z, 0-9 dan spasi</li>');
            $this->form_validation->set_message('min_length', '<li><b>{field}</b> harus diisi minimal {param} karakter</li>');
            $this->form_validation->set_message('max_length', '<li><b>{field}</b> harus diisi maksimal {param} karakter</li>');
            $this->form_validation->set_message('matches', '<li><b>{field}</b> tidak cocok</li>');
            if($this->form_validation->run() == FALSE) {
                $error = validation_errors();
                echo json_encode(array(
                    "status" => FALSE,
                    "message" => $error
                ), JSON_PRETTY_PRINT);
            } else {
                $data = array(
                    'surename' => $this->input->post('surename'),
                    'privilege' => $this->input->post('privilege'),
                    'category' => $this->input->post('category')
                );
                if("" !== ($this->input->post('usr_acc'))) {
                    $data['user_identifier'] = $this->input->post('usr_acc');
                }
                if("" !== ($this->input->post('password'))) {
                    $data['password'] = md5($this->input->post('password'));
                }
                $id  = $this->input->post('id');
                $acc = $this->account_model->update($id, $data);
                if($acc) {
                    echo json_encode(array(
                        "status" => TRUE,
                        "message" => "Data telah diubah"
                    ), JSON_PRETTY_PRINT);
                } else {
                    echo json_encode(array(
                        "status" => FALSE,
                        "message" => "Pengubahan data gagal"
                    ), JSON_PRETTY_PRINT);
                }
            }
        }
        catch(Exception $e) {
            echo json_encode(array(
                "status" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function account_get_by_id()
    {
        $this->load->model('account_model');
        $id  = $this->input->post('id');
        $acc = $this->account_model->get_by_id($id);
        if($acc) {
            echo json_encode(array(
                "ok" => TRUE,
                "acc" => $acc
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function account_delete_by_id()
    {
        $this->load->model('account_model');
        $id       = $this->input->post('id');
        $response = $this->account_model->delete_by_id($id);
        if($response) {
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function news_add()
    {
        try {
            $this->load->model('news_model');
            $uuid   = uniqid();
            $dir    = "./news-pict/";
            $url    = base_url('news-pict');
            $config = array(
                'upload_path' => $dir,
                'allowed_types' => "jpg|jpeg",
                'file_name' => $uuid,
                'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('banner_img')) {
                $error = $this->upload->display_errors();
                echo json_encode(array(
                    "status" => FALSE,
                    "message" => $error
                ), JSON_PRETTY_PRINT);
            } else {
                $upload_data = $this->upload->data();
                $data        = array(
                    'news_url' => strtolower((string) (date('YmdHis-')) . url_title($this->input->post('title'))),
                    'title' => $this->input->post('title'),
                    'category' => $this->input->post('category'),
                    'url_img' => $url,
                    'banner_img' => $upload_data['file_name'],
                    'content' => $this->input->post('content'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $news_id     = $this->news_model->add($data);
                $this->load->model('patternControl_model');
                $broadcast = $this->patternControl_model->broadcast_news($news_id);
                if($news_id) {
                    if($broadcast) {
                        echo json_encode(array(
                            "status" => TRUE,
                            "message" => "Data berita telah ditambahkan"
                        ), JSON_PRETTY_PRINT);
                    } else {
                        $this->news_model->delete_by_id($news_id);
                        echo json_encode(array(
                            "status" => FALSE,
                            "message" => "Penambahan berita gagal"
                        ), JSON_PRETTY_PRINT);
                    }
                } else {
                    echo json_encode(array(
                        "status" => FALSE,
                        "message" => "Penambahan berita gagal"
                    ), JSON_PRETTY_PRINT);
                }
            }
        }
        catch(Exception $e) {
            echo json_encode(array(
                "status" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function news_update()
    {
        try {
            $data = array();
            $this->load->model('news_model');
            if(isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] != UPLOAD_ERR_NO_FILE) {
                $uuid   = uniqid();
                $dir    = "./news-pict/";
                $url    = base_url('news-pict');
                $config = array(
                    'upload_path' => $dir,
                    'allowed_types' => "jpg|jpeg",
                    'file_name' => $uuid,
                    'overwrite' => TRUE
                );
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('banner_img')) {
                    $error = $this->upload->display_errors();
                    echo json_encode(array(
                        "status" => FALSE,
                        "message" => $error
                    ), JSON_PRETTY_PRINT);
                    return false;
                } else {
                    $upload_data        = $this->upload->data();
                    $data['url_img']    = $url;
                    $data['banner_img'] = $upload_data['file_name'];
                }
            }
            $data['title']    = $this->input->post('title');
            $data['category'] = $this->input->post('category');
            $data['content']  = $this->input->post('content');
            $id               = $this->input->post('id');
            $news             = $this->news_model->update($id, $data);
            if($news) {
                echo json_encode(array(
                    "status" => TRUE,
                    "message" => "Data berita telah diperbarui"
                ), JSON_PRETTY_PRINT);
            } else {
                echo json_encode(array(
                    "status" => FALSE,
                    "message" => "Penambahan berita diperbarui"
                ), JSON_PRETTY_PRINT);
            }
        }
        catch(Exception $e) {
            echo json_encode(array(
                "status" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function news_delete_by_id()
    {
        $this->load->model('news_model');
        $id       = $this->input->post('id');
        $response = $this->news_model->delete_by_id($id);
        if($response) {
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function survey_add()
    {
        try {
            $data = array();
            $this->load->model('survey_model');
            $this->load->model('surveyQuestion_model');
            $data['title']       = $this->input->post('title');
            $data['explanation'] = $this->input->post('explanation');
            $data['created_at']  = date('Y-m-d H:i:s');
            $data['due_at']      = $this->input->post('due_at');
            $survey_id           = $this->survey_model->add($data);
            $sq_q                = $this->input->post('sq_question');
            $sq_is               = $this->input->post('sq_is_closed');
            $sq_a                = $this->input->post('sq_answers');
            foreach($sq_q as $key => $value) {
                $survey_question = $this->surveyQuestion_model->add(array(
                    'survey_id' => $survey_id,
                    'question' => $value,
                    'is_closed' => $sq_is[$key],
                    'answers' => $sq_a[$key]
                ));
            }
            $this->load->model('patternControl_model');
            $broadcast = $this->patternControl_model->broadcast_survey($survey_id);
            if($survey_id) {
                if($broadcast) {
                    echo json_encode(array(
                        "status" => TRUE,
                        "message" => "Data Survey telah ditambahkan",
                        "data" => $data
                    ), JSON_PRETTY_PRINT);
                } else {
                    $this->survey_model->delete_by_id($survey_id);
                    $this->surveyQuestion_model->delete_by_survey_id($survey_id);
                    echo json_encode(array(
                        "status" => FALSE,
                        "message" => "Gagal menambahkan survey."
                    ), JSON_PRETTY_PRINT);
                }
            } else {
                echo json_encode(array(
                    "status" => FALSE,
                    "message" => "Gagal menambahkan survey."
                ), JSON_PRETTY_PRINT);
            }
        }
        catch(Exception $e) {
            echo json_encode(array(
                "status" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function survey_delete_by_id()
    {
        $this->load->model('survey_model');
        $this->load->model('surveyQuestion_model');
        $id        = $this->input->post('id');
        $response  = $this->survey_model->delete_by_id($id);
        $response1 = $this->surveyQuestion_model->delete_by_survey_id($id);
        if($response) {
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function report_refresh()
    {
        try {
            $this->load->model('discussion_model');
            $this->load->model('patternControl_model');
            $last_id         = $this->input->post('last_row_id');
            $token           = $this->input->post('token');
            $chat_id         = $this->input->post('chat_id');
            $last_msg        = $this->discussion_model->get_discuss($token, $last_id);
            $pattern_control = $this->patternControl_model->get_by_chat_id($chat_id);
            echo json_encode(array(
                "ok" => TRUE,
                "last_msg" => $last_msg,
                "pattern_control" => $pattern_control
            ), JSON_PRETTY_PRINT);
        }
        catch(Exception $e) {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function start_discussion()
    {
        $this->load->model('patternControl_model');
        $this->load->model('msgOut_model');
        $this->load->model('discussion_model');
        $token           = $this->input->post('token');
        $chat_id         = $this->input->post('chat_id');
        $pattern_control = $this->patternControl_model->get_by_chat_id($chat_id);
        $last_user_chat  = $this->discussion_model->get_last_user_chat($token, $chat_id);
        if($pattern_control['current_processed'] == 'idle') {
            $this->patternControl_model->update($chat_id, array(
                'current_processed' => 'discussion',
                'current_report_discussion_token' => $token
            ));
            if($last_user_chat) {
                $this->msgOut_model->insert($chat_id, $content = '<b>[Sesi Diskusi Pengaduan #' . $token . ' Dimulai]</b>', $is_reply = 1, $reply_message_id = $last_user_chat['message_id']);
                $this->msgOut_model->insert($chat_id, $content = 'Link Pelaporan  : ' . base_url('pengaduan/') . $token . '');
            } else {
                $this->msgOut_model->insert($chat_id, $content = '<b>[Sesi Diskusi Pengaduan #' . $token . ' Dimulai]</b>');
                $this->msgOut_model->insert($chat_id, $content = 'Link Pelaporan  : ' . base_url('pengaduan/') . $token . '');
            }
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function stop_discussion()
    {
        $this->load->model('patternControl_model');
        $this->load->model('msgOut_model');
        $token           = $this->input->post('token');
        $chat_id         = $this->input->post('chat_id');
        $pattern_control = $this->patternControl_model->get_by_chat_id($chat_id);
        if($pattern_control['current_processed'] == 'discussion' && $pattern_control['current_report_discussion_token'] == $token) {
            $this->patternControl_model->update($chat_id, array(
                'current_processed' => 'idle',
                'current_report_discussion_token' => null
            ));
            $content = '<b>[Sesi Diskusi Pengaduan #' . $token . ' Berakhir]</b>';
            $this->msgOut_model->insert($chat_id, $content);
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function add_response()
    {
        $this->load->model('patternControl_model');
        $this->load->model('msgOut_model');
        $this->load->model('discussion_model');
        $this->load->model('report_model');
        $token           = $this->input->post('token');
        $chat_id         = $this->input->post('chat_id');
        $pattern_control = $this->patternControl_model->get_by_chat_id($chat_id);
        if($pattern_control['current_processed'] == 'discussion' && $pattern_control['current_report_discussion_token'] == $token) {
            $data = array(
                'account_id' => $this->session->userdata('id'),
                'sender_name' => $this->session->userdata('surename'),
                'privilege' => $this->session->userdata('privilege'),
                'content' => $this->input->post('content'),
                'report_token' => $token
            );
            $this->discussion_model->insert($data);
            $msg = ('<b>['.substr($this->session->userdata('privilege'),0,3).'] '. $this->session->userdata('surename').':</b>'.
                    chr(0x0A).chr(0x0A).
                    $this->input->post('content'));
            $this->msgOut_model->insert($chat_id, $msg);
            $report = $this->report_model->get_by_token($token);
            if(!$report['is_replied']) {
                $this->report_model->update($report['id'], array('is_replied'=>1));
            }
            if($report['status']=='terdaftar') {
                $this->report_model->update($report['id'], array('status'=>'didiskusikan'));
            }
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
    public function change_report_status()
    {
        try
        {
            $this->load->model('report_model');
            $this->load->model('msgOut_model');
            $token      = $this->input->post('token');
            $status     = $this->input->post('status');
            $report     = $this->report_model->get_by_token($token);
            $this->report_model->update($report['id'], array('status'=>$status));
            $this->msgOut_model->insert($report['chat_id'], 'Status dari pengaduan Anda pada sektor <b>'.$report['sector'].'</b> dengan token <a href="'.base_url('pengaduan/'.$token).'">'.$token.'</a> diubah menjadi "'.$status.'"');
            echo json_encode(array(
                "ok"        => TRUE,
                'message'   => 'token : '.$token.', status: '.$status
            ), JSON_PRETTY_PRINT);
        }
        catch(Exception $e) {
            echo json_encode(array(
                "ok" => FALSE,
                "message" => $e
            ), JSON_PRETTY_PRINT);
        }
    }
    public function clear_operation()
    {
        try {
            $this->load->model('msgOut_model');
            $this->load->model('patternControl_model');
            $this->load->model('pattern_model');
            $chat_id         = $this->input->post('chat_id');
            $pattern_control = $this->patternControl_model->get_by_chat_id($chat_id);
            if($pattern_control['current_pattern_id'] != NULL) {
                $this->pattern_model->update($pattern_control['current_pattern_id'], array(
                    'flag' => 'drop'
                ));
            }
            $this->patternControl_model->update($chat_id, array(
                'current_processed' => 'idle',
                'current_ops_id' => NULL,
                'current_param_in_id' => NULL,
                'current_pattern_id' => NULL,
                'current_pattern_param_id' => NULL,
                'temp_survey_id' => NULL,
                'current_survey_id' => NULL,
                'current_survey_question_id' => NULL,
                'current_report_discussion_token' => NULL
            ));
            $this->msgOut_model->insert($chat_id, 'Operasi telah dihentikan oleh Admin');
            echo json_encode(array(
                "ok" => TRUE
            ), JSON_PRETTY_PRINT);
        }
        catch(Exception $e) {
            echo json_encode(array(
                "ok" => FALSE
            ), JSON_PRETTY_PRINT);
        }
    }
}