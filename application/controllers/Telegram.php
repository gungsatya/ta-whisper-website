<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Telegram extends CI_Controller {
    
        var $data;

        function __construct()
        {
            // Citizen  : 552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps
            parent::__construct();
            $this->load->model('blackbox_model');
            $this->load->model('msgIn_model');
            $this->load->model('msgOut_model');
            $this->load->model('patternControl_model');
            $this->load->model('pattern_model');
            $this->load->model('discussion_model');
            $this->data = array(
                'api_token'     =>'552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps',
                'bot_username'  =>'citizenlab_bot'
            );

            date_default_timezone_set('Asia/Jakarta');
        }
        public function set()
        {
            $data = $this->data;
        
            $fields = array(
                'url'               => base_url() . $data['api_token'],
                'max_connections'   => 20
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$data['api_token']."/setWebhook");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            $response = curl_exec($ch);
            curl_close($ch);

            echo $response;
        }
        
        public function unset()
        {
            $data = $this->data;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$data['api_token']."/deleteWebhook");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            $response = curl_exec($ch);
            curl_close($ch);

            echo $response;
        }

        public function info()
        {
            $data = $this->data;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$data['api_token']."/getWebhookInfo");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            $response = curl_exec($ch);
            curl_close($ch);

            echo $response;
        }

        public function webhook()
        {
            $data = $this->data;
            
            $json       = @file_get_contents('php://input');

            $this->blackbox_model->insertInbond($json);

            $update     = json_decode($json, TRUE);

            if(array_key_exists("message", $update))
            {
                $message            = $update['message'];
                $chat               = $message['chat'];
                
                $tester_chat_id     = array('217177928'); 
                $testing_mode       = FALSE;

                if(!$testing_mode || in_array($chat['id'],$tester_chat_id))
                {
                    $pattern_control    = $this->patternControl_model->get_by_chat_id($chat['id']);
                
                    if ($chat['type'] == 'private' and array_key_exists('username',$chat))
                    {
                        if (array_key_exists('text', $update['message']))
                        {
                            if($message['text']=='/clear')
                            {
                                if($pattern_control['current_pattern_id']!=NULL)
                                {
                                    $this->pattern_model->update($pattern_control['current_pattern_id'], array('flag' => 'drop' ));
                                }
                                
                                if($pattern_control['current_report_discussion_token']!=NULL)
                                {
                                    $this->msgOut_model->insert($chat['id'], '<b>[Sesi Diskusi Pengaduan #'.$pattern_control['current_report_discussion_token'].' Berakhir]</b>');
                                }
                                
                                $this->patternControl_model->update($chat['id'], array(
                                    'current_processed' => 'idle', 
                                    'current_ops_id' => NULL,
                                    'current_param_in_id'=> NULL,
                                    'current_pattern_id' => NULL,
                                    'current_pattern_param_id'=> NULL,
                                    'temp_survey_id' => NULL,
                                    'current_survey_id'=> NULL,
                                    'current_survey_question_id' => NULL,
                                    'current_report_discussion_token'=> NULL
                                ));
                                $this->msgOut_model->insert($chat['id'], 'Operasi telah dihentikan',  $is_reply=1, $reply_message_id=$message['message_id']);
                                $flag = 'processed';
                            }
                            else
                            {
                                if($pattern_control['current_processed']=='discussion')
                                {
                                    $flag = 'processed';
                                    $this->discussion_model->insert(array(
                                        'chat_id'       => $chat['id'],
                                        'message_id'    => $message['message_id'],
                                        'privilege'     => 'user',
                                        'report_token'  => $pattern_control['current_report_discussion_token'],
                                        'content'       => $message['text'],
                                        'created_at'    => date('Y-m-d H:i:s')
                                    ));
                                    $notif = $this->send_discuss_notif($pattern_control['current_report_discussion_token'], $message['text']);
                                    if(!$notif)
                                    {
                                        $this->msgOut_model->insert($chat['id'], 'Notif tidak masuk');
                                    }
                                }
                                else{
                                    $flag = 'just_arrived';
                                }
                            }
                            
                            $message_in_id = $this->msgIn_model->insert($chat['id'], $update['update_id'], $message['message_id'], $chat['username'],
                            $chat['first_name'] . " " . $chat['last_name'], 'text',
                            $message['text'], $flag);

                        }
                        else if (array_key_exists('location', $update['message']))
                        {
                            if($pattern_control['current_processed']=='discussion')
                            {
                                $flag = 'processed';
                                $this->discussion_model->insert(array(
                                    'chat_id'       => $chat['id'],
                                    'message_id'    => $message['message_id'],
                                    'privilege'     => 'user',
                                    'report_token'  => $pattern_control['current_report_discussion_token'],
                                    'content'       => 
                            strval($message['location']['latitude']) . "," . strval($message['location']['longitude']),
                                    'created_at'    => date('Y-m-d H:i:s')
                                ));
                            }
                            else{
                                $flag = 'just_arrived';
                            }

                            $message_in_id = $this->msgIn_model->insert($chat['id'], $update['update_id'], $message['message_id'], $chat['username'],
                            $chat['first_name'] . " " . $chat['last_name'], 'location',
                            strval($message['location']['latitude']) . "," . strval($message['location']['longitude']), $flag);
                        }
                        else if (array_key_exists('photo', $update['message']))
                        {
                            $fields = array(
                                'file_id'               => $message['photo'][2]['file_id']
                            );
                            $ch1 = curl_init();
                            $url = "https://api.telegram.org/bot".$data['api_token']."/getFile";
                            curl_setopt($ch1, CURLOPT_URL, $url );
                            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
                            curl_setopt($ch1, CURLOPT_HEADER, FALSE);
                            curl_setopt($ch1, CURLOPT_POST, TRUE);
                            curl_setopt($ch1, CURLOPT_POSTFIELDS, ($fields));
                            $response = curl_exec($ch1);
                            curl_close($ch1);
                
                            $file_info = json_decode($response, TRUE);
                            $fp = fopen('/home/citizenl/chatbot.citizenlab.web.id.new/'.$file_info['result']['file_path'], "w");

                            $options = array(
                                CURLOPT_FILE    => $fp,
                                CURLOPT_TIMEOUT =>  28800,
                                CURLOPT_URL     => "https://api.telegram.org/file/bot".$data['api_token']."/".$file_info['result']['file_path']
                            );

                            $ch = curl_init();
                            curl_setopt_array($ch, $options);
                            curl_exec($ch);
                            curl_close($ch);

                            $file_name = explode("/", strval($file_info['result']["file_path"]))[1];
                            
                            if($pattern_control['current_processed']=='discussion')
                            {
                                $flag = 'processed';
                                $this->discussion_model->insert(array(
                                    'chat_id'       => $chat['id'],
                                    'message_id'    => $message['message_id'],
                                    'privilege'     => 'user',
                                    'report_token'  => $pattern_control['current_report_discussion_token'],
                                    'content'       => $file_name,
                                    'created_at'    => date('Y-m-d H:i:s')
                                ));
                            }
                            else{
                                $flag = 'just_arrived';
                            }
                            
                            $message_in_id = $this->msgIn_model->insert($chat['id'], $update['update_id'], $message['message_id'], $chat['username'],
                            $chat['first_name'] . " " . $chat['last_name'],
                            'photo', $file_name, $flag);
                            
                            $fp = fopen('vardump.txt', 'w');
                            fwrite($fp, serialize($file_name));
                            fclose($fp);
                        }
                        
                        if ($pattern_control['current_processed']=='idle' or $pattern_control['current_processed']=='operation' or is_null($pattern_control['current_processed'])) 
                        {
                            $this->blackbox_model->insertMsgInQueueOps($message_in_id);
                        } 
                        else if($pattern_control['current_processed']=='survey' or $pattern_control['current_processed']=='tmp_survey')
                        {
                            $this->blackbox_model->insertMsgInQueueSurvey($message_in_id);
                        }
                    }
                    else{
                        $this->msgOut_model->insert($chat['id'], 'Anda harus memiliki <i>username</i> atau mengirim pesan kepada Whisper melalui pesan pribadi',  $is_reply=1, $reply_message_id=$message['message_id']);
                    }
                    
                }
                else{
                    $this->msgOut_model->insert($chat['id'], 'Whisper saat ini dalam tahap <pre>testing</pre> dan terbatas untuk umum. Tunggu beberapa saat lagi atau kontak @gung_satya untuk info lebih lanjut.',  $is_reply=1, $reply_message_id=$message['message_id']);
                    $message_in_id = $this->msgIn_model->insert($chat['id'], $update['update_id'], $message['message_id'], $chat['username'], $chat['first_name'] . " " . $chat['last_name'], 'text', $message['text'], 'processed');
                }
            }

        }

        public function send_discuss_notif($token, $notif)
        {
            try
            {
                $this->load->model('report_model');
                $report = $this->report_model->get_by_token($token);
                $content = array(
                    "en" => $notif
                );

                switch ($report['sector']) 
                {
                    case 'infrastruktur':
                        $category = 'infra';
                        break;
                    
                    case 'kesehatan':
                        $category = 'kes';
                        break;

                    case 'pendidikan':
                        $category = 'pend';
                        break;

                    case 'administrasi':
                        $category = 'adm';
                        break;

                    default:
                        $category = 'lainnya';
                        break;
                }

                $filters = array(
                    array("field" => "tag", "key" => "category", "relation" => "=", "value" => "all"),
                    array("operator"=> "OR"),
                    array("field" => "tag", "key" => "category", "relation" => "=", "value" => $category)
                );

                $fields = array(
                    'app_id'            => "380695d9-fee9-4e5b-b67f-f0606625600c",
                    'filters'           => $filters,
                    'contents'          => $content,
                    'url'               => base_url('/panel/pengaduan/detail/'.$report['id'])
                );
                
                $fields = json_encode($fields);
            
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                        'Authorization: Basic ZGFjM2JmYzMtNDIyNy00Y2I2LTgxMWUtZjU0NTM5NDU0MGU3'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);

                return 1;
            }
            catch(Exception $e)
            {
                return 0;
            } 
        }
    }
    
    /* End of file Controllername.php */
    