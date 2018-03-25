<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper("string");
        $this->load->helper("common_settings");
        $this->load->helper("security");
        $this->load->library("form_validation");
        $this->page_token = $this->input->post("page_token");
        $this->page_token = $this->page_token ? $this->page_token : "";
        
        $post_json_decoded = json_decode(file_get_contents("php://input"), true);
        if($post_json_decoded && count($post_json_decoded))
            $_POST = array_merge($post_json_decoded, $_POST);

        date_default_timezone_set('Asia/Kolkata');

             $_GET['country_id']=167;
        if(isset($_GET['country_id']))
            $_POST['country_id'] = $_GET['country_id'];
        
        //$this->check_mod_accessibility();

        //get country details & store in session : 1
        $country = $this->get_country(1);
        //$this->get_site_details();/* to set session data in setting values*/
    }

    function get_user_device()
    {
        $user_device = $this->session->userdata("user_device");
        if(!$user_device)
        {
            $this->load->library('user_agent');
            if($this->agent->is_browser())
                $user_device = 'web';
            else if($this->agent->is_mobile('iphone'))
                $user_device = 'iphone';
            else if($this->agent->is_mobile('android'))
                $user_device = 'android';
            else
                $user_device = 'Unknown';
            $this->session->set_userdata("user_device", $user_device);
        }
        return $user_device;
    }

    function browser_clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    var $token_expiry = 10;
    public function generate_page_token()
    {
        $this->load->library('user_agent');
        if($this->agent->is_browser())
            $device = 'Web';
        else if($this->agent->is_mobile('iphone'))
            $device = 'IPhone';
        else if($this->agent->is_mobile('android'))
            $device = 'Android';
        else
            $device = 'Unknown';

        $token_data = array(
            'token_timestamp'   => time(),
            'token_page'        => uri_string(),
            'token_source'      => $device,
            'token_valid'       => time()+(60*$this->token_expiry),
        );
        $this->load->library('encryption');
        $page_token = $this->encryption->encrypt(json_encode($token_data));
        return array("status_id"=>"1", "page_token"=>$page_token);
    }
    
    public function update_page_token($pages=array())
    {
        $page_token = $this->input->post('page_token');
        if(!$page_token)
            return array("status_id"=>"0", "status_message"=>"Page token required");
        $this->load->library('encryption');
        $token_data = json_decode($this->encryption->decrypt($page_token), true);
        if($token_data['token_valid']<time())
        {
            $this->load->model('users_model');
            //$this->users_model->login_track_destroy();
            return array("status_id"=>"0", "status_message"=>"Token expired.");
        }
        $token_data['token_valid'] = time()+(60*$this->token_expiry);

        //New page token
        $page_token = $this->encryption->encrypt(json_encode($token_data));
        return array("status_id"=>"1", "page_token"=>$page_token);
    }

    //-------------------------------------------------------------------------------------------------------
    //Purpose   : Login session track, session validation & session destroy :--------------------------------
    //-------------------------------------------------------------------------------------------------------
    function validate_device_session()
    {
        $response = array("status_id"=>"1", "status_message"=>"", 'action'=>"");
        /*if(uri_string()!="users/login")
        {
            $this->load->library("Mobile_Detect/Mobile_Detect");
            $detect = new Mobile_Detect;
            if($detect->isMobile() || $detect->isTablet())
            {
                $is_valid = $this->login_track_validate();
                if(!$is_valid)
                {
                    $response = array("status_id"=>"0", "status_message"=>"Invalid session id / session expired.");
                }
            }
        }*/
        return $response;
    }
    function get_settings()
    {
        $data = $this->db->select("tbl_settings.*")
        ->from("tbl_settings")
        ->get()->row_array();

        return $data;
    }

    function generate_otp()
    {
        $otp_val = substr(number_format(time() * rand(),0,'',''),0,6);
        return $otp_val;
    }

    function get_profile_image_url($image_url='')
    {
        $image_url = "https://s3-ap-southeast-1.amazonaws.com/vods3pro/".($image_url ? $image_url : "media/user_image/noimage.png");

        return $image_url;
    }

    function get_image_url($image_url='')
    {
        if(strpos($image_url, 'http')>-1)
            $image_url = "$image_url";
        else
            $image_url = "https://s3-ap-southeast-1.amazonaws.com/vods3pro/$image_url";

        return $image_url;
    }

    function get_video_url($video_url='')
    {
        //$video_url = "https://s3-ap-southeast-1.amazonaws.com/vods3pro/$video_url";
        if(strpos($video_url, 'http')>-1)
            $video_url = "$video_url";
        else
            $video_url = $this->get_wowza_url($video_url, 'with_security_token');
        
        return $video_url;
    }

    function get_movie_image_url($image_url='')
    {
        //$image_url = base_url()."$image_url";
        $image_url = "https://s3-ap-southeast-1.amazonaws.com/vods3pro/$image_url";

        return $image_url;
    }
    
    
    function get_weeks_range($date) {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next saturday', $start)));
    }

    function get_month_range($date) {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        return array(date("Y-m-01", strtotime($date)), date("Y-m-t 23:59:59", strtotime($date)) );
    }

    function send_sms($mobilen_umbers='', $message)
    {
        $message = preg_replace("/\r|\n/", '\n', $message);
        $mobilen_umbers = strlen($mobilen_umbers)==10 ? intval("91$mobilen_umbers") : intval($mobilen_umbers);
        $blacklist = array(
            //'192.168.33.168',
            //'127.0.0.1',
            //'::1'
        );
        if(!in_array($_SERVER['HTTP_HOST'], $blacklist)){
            $to = $mobilen_umbers;
            $from = 'MOD';
            $messageId = '';
            $text = $message;
            $notifyUrl = '';
            $notifyContentType = '';
            $callbackData = '';
            $sms_user_name = 'vvmineral';
            $sms_password = 'VVM@2111';
            $sms_api_url = "https://api.infobip.com/sms/1/text/single"; 

            $dt=new stdClass();                        
            $dt = (object) array_merge( array('query'=> " SELECT * FROM  tbl_settings where fld_setting_id ='1' and fld_setting_sms_enable='1' "));
            $setting_result = $this->Datatable_model->custom_query($dt);
            if(!empty($setting_result))
            {
                $setting_result_array=$setting_result[0];
                $sms_user_name = $setting_result_array['fld_setting_sms_user'];
                $sms_password = $setting_result_array['fld_setting_sms_password'];
                $sms_api_url = $setting_result_array['fld_setting_sms_api_url'];                
            }

            $curl = curl_init();
            $header = array("Content-Type:application/json", "Accept:application/json");
            curl_setopt_array($curl, array(
                CURLOPT_URL => $sms_api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_USERPWD=> $sms_user_name . ":" . $sms_password,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{ \"from\":\"$from\", \"to\":\"".$to."\", \"text\":\"".$message."\" }",
                CURLOPT_HTTPHEADER => $header,
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        }
        return false;
    }

    function ip_to_location($ip='', $store_session=0)
    {
        if($ip)
        { }
        else if($location = $this->session->userdata("location"))
        {
            return $location;
        }
        else
        {
            $store_session = 1;
            $ip = $this->input->ip_address();
        }
        $location = file_get_contents("http://extreme-ip-lookup.com/json/$ip");
        $location = json_decode($location, true);

        if($store_session)
            $this->session->set_userdata("location", $location);
        
        return $location;
    }

    function get_country($store_session = 0)
    {
        if($country_id = $this->input->post('country_id'))
            $this->db->where("tbl_countries.fld_country_id", $country_id);
        else if($country_name = $this->input->post('country_name'))
            $this->db->where("tbl_countries.fld_country_name", $country_name);
        else if($currency_code = $this->input->post('currency_code'))
            $this->db->where("tbl_countries.fld_country_currency_code", $currency_code);
        else if($country = $this->session->userdata("country"))
        {
            return $country;
        }
        else
        {
            $store_session = 1;
            $location = $this->ip_to_location();
            $this->db->where("tbl_countries.fld_country_name", isset($location['country']) ? $location['country'] : '');
        }
        
        $country = $this->db->select("tbl_countries.fld_country_id as country_id, tbl_countries.fld_country_name as country_name, tbl_countries.fld_country_code as country_code, tbl_countries.fld_country_currency_name as currency_name, tbl_countries.fld_country_currency_code as currency_code,, tbl_countries.fld_country_currency_symbol as currency_symbol, tbl_countries.fld_country_currency_aed_price as currency_aed_price") //tbl_countries.fld_country_currency_dollar_price as currency_dollar_price, 
        ->from("tbl_countries")
        ->get()->row_array();

        if($store_session)
            $this->session->set_userdata("country", $country);

        return $country;
    }
    
    function currency_convert_google($amount, $from_currency, $to_currency)
    {
        $from_currency = urlencode($from_currency);
        $to_currency = urlencode($to_currency);
        $get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_currency&to=$to_currency");
        $get = explode("<span class=bld>",$get);
        if(isset($get[1]))
        {
            $get = explode("</span>",$get[1]);
            $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
            $response = array("status_id"=>1, "converted_currency"=>"$converted_currency");
        }
        else
            $response = array("status_id"=>0, "converted_currency"=>"");
        return $response;
    }

    function currency_convert_old($amount, $to_currency='', $from_currency='')
    {
        $from_currency = $from_currency ? $from_currency : get_label('currency_code');
        $this->default_currency_code = get_label('currency_code');
        //$converted_currency = $this->currency_convert_google($amount, $from_currency, $to_currency);
        //return $converted_currency['status_id'] ? $converted_currency['converted_currency'] : 0;
        /*//Testing
        echo "function currency_convert($amount, $to_currency, $from_currency)";*/

        $status_id = 0;
        if($from_currency==$this->default_currency_code && $to_currency==$this->default_currency_code)
        {
            $to_country = array('currency_aed_price'=>1);
            $status_id  = 1;
        }
        else if($from_currency==$this->default_currency_code)
        {
            $_POST['currency_code'] = $to_currency;
            $to_country = $this->get_country();
            if(isset($to_country['currency_aed_price']) && $to_country['currency_aed_price'])
            {
                $_POST['currency_code'] = $to_currency;
                //$to_country = $this->get_country();
                $amount = $to_country['currency_aed_price']*$amount;
                $status_id = 1;
            }
        }
        else if($to_currency==$this->default_currency_code)
        {
            $_POST['currency_code'] = $from_currency;
            $to_country = $this->get_country();
            if(isset($to_country['currency_aed_price']) && $to_country['currency_aed_price'])
            {
                $_POST['currency_code'] = $from_currency;
                //$to_country = $this->get_country();
                $amount = $amount/$to_country['currency_aed_price'];
                $status_id = 1;
            }
        }
        else if(isset($to_country['currency_aed_price']) && $to_country['currency_aed_price'])
        {
            if($to_currency)
                $_POST['currency_code'] = $to_currency;
            $to_country = $this->get_country();

            $_POST['currency_code'] = $from_currency;
            $from_country = $this->get_country();
            if(isset($from_country['currency_aed_price']) && $from_country['currency_aed_price'])   
            {
                $amount = ($to_country['currency_aed_price']/$from_country['currency_aed_price'])*$amount;
                $status_id = 1;
            }
        }
        if($status_id)
        {
            $response = array("status_id"=>"1", "status_message"=>"", "amount"=>"$amount", "currency"=>"$to_currency", "exchange_rate"=>"$to_country[currency_aed_price]");
        }
        else
        {
            $response = array("status_id"=>"0", "status_message"=>"Error on converting $from_currency to $to_currency", "amount"=>"$amount", "currency"=>"$from_currency", "exchange_rate"=>"");
        
            //Slack notification
            $slack_response = $this->common_model->post_to_slack("web_issues", "MOD : ".site_url()." : ".uri_string()." #payment:--------------------------------------- Currency conversion failed : amount:$to_country[currency_aed_price] from_currency:$from_currency to_currency:$to_currency?");
        }

        return $response;
    }

    function get_state()
    {
        $state_id = $this->input->post('state_id');
        $state_id = $state_id ? $state_id : 0;
        if($state_id)
            $this->db->where("tbl_state.fld_state_id", $state_id);
        $state_name = $this->input->post('state_name');
        if($state_name)
            $this->db->where("tbl_state.fld_state_name", $state_name);
        $state = $this->db->select("tbl_states.fld_state_id as state_id, tbl_states.fld_state_name as state_name, tbl_states.fld_state_country_id as state_country_id")
        ->from("tbl_states")
        ->get()->row_array();
        return $state;
    }

    function post_to_slack($channel, $message)
    {
        $ch = curl_init("https://slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => "xoxp-79006235159-165351787939-186432099191-6ffb992e691f581b92f07180a1f3336b",
            "channel" => $channel, //"#mychannel",
            "text" => $message,
            "username" => "dillibabu.php",
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function get_curl($url='', $data=array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        return json_decode($response, true);
    }

    function get_video_duration($filePath)
    {
        exec('ffmpeg -i'." '$filePath' 2>&1 | grep Duration | awk '{print $2}' | tr -d ,", $O, $S);
        return isset($O[0]) ? $O[0] : "00:00:00";
    }

    /* this function used to validate image */
    function valid_image_type($files = null) 
    { 
        if (isset ( $files ) && ! empty ( $files )) {
            $allowedExts = array ("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG"); 
            // for($i = 0; $i < count($files['name']); $i++) 
            // { 
                $temp = explode ( ".", $files ['name']); 
                $extension = end ( $temp );
                if (! in_array ( $extension, $allowedExts )) 
                {
                        return FALSE;
                }
            //}
        }
        return TRUE;
    }

    /* this function used to validate image */
    function valid_video_type($files = null) { 
        if (isset ( $files ) && ! empty ( $files )) {
            $allowedExts = array ("mp4", "mov"); //"mpg", "mpeg", "wmv", "mkv", "webm", "flv", "3gp"
            // for($i = 0; $i < count($files['name']); $i++) 
            // { 
                $temp = explode ( ".", $files ['name']);
                $extension = end ( $temp );
                if (! in_array ( $extension, $allowedExts )) 
                {
                    return FALSE;
                }
            // }
        }
        return TRUE;
    }
    /*function get_multiple_uploaded_files($upload_name='')
    {
        $files = array();
        if(isset($_FILES[$upload_name]))
        {
            $i=0;
            foreach($_FILES[$upload_name]['name'] as $name)
                $files[$i++]['name'] = $name;
            $i=0;
            foreach($_FILES[$upload_name]['type'] as $type)
                $files[$i++]['type'] = $type;
            $i=0;
            foreach($_FILES[$upload_name]['tmp_name'] as $tmp_name)
                $files[$i++]['tmp_name'] = $tmp_name;
            $i=0;
            foreach($_FILES[$upload_name]['error'] as $error)
                $files[$i++]['error'] = $error;
            $i=0;
            foreach($_FILES[$upload_name]['size'] as $size)
                $files[$i++]['size'] = $size;
        }
        return $files;
    }*/

    function get_site_details($is_internal=0)
    {
        $site_details = $this->db->select("fld_setting_site_title as site_title, fld_setting_site_logo as site_logo, fld_setting_site_icon as site_icon, fld_setting_site_footer_content as site_footer_content")
        ->from("tbl_settings")
        ->get()->row_array();
        if(isset($site_details['site_logo']))
        {
            $site_details['site_logo'] = $this->get_image_url($site_details['site_logo']);
            $site_details['site_about_us'] = site_url("viewer/about_us");
            $site_details['site_faq'] = site_url("viewer/faq");
            $site_details['site_contact_us'] = site_url("viewer/contact_us");
            $site_details['site_terms'] = site_url("viewer/terms");
            $site_details['site_privacy_policy'] = site_url("viewer/privacy_policy");

            /*$_POST['cmspage_slug'] = 'disclaimer_content';
            $content = $this->get_cmspage_content();
            $site_details['site_disclaimer'] = isset($content['cmspage_description']) ? $content['cmspage_description'] : '';*/
        }
        if(!$this->session->userdata('site_title') || $is_internal)
        {
            $this->session->set_userdata($site_details);
        }
        return $site_details;
    }
    
    function get_cmspage_content($is_internal=0)
    {
        $where=$cmspage_details=array();
        $cmspage_id = $this->input->post("cmspage_id");
        $cmspage_slug = $this->input->post("cmspage_slug");
        if($cmspage_id != "")
        {
            $where=array('fld_cmspage_id'=>$cmspage_id);
        }
        if($cmspage_slug != "")
        {
            $where=array('fld_cmspage_slug'=>$cmspage_slug);
        } 

        $this->db->select("fld_cmspage_title as cmspage_title,fld_cmspage_description as cmspage_description,fld_cmspage_meta_title as cmspage_meta_title,fld_cmspage_meta_description as cmspage_meta_description,fld_cmspage_status as cmspage_status")->from("tbl_cms_page")->where($where);
        $cmspage_details = $this->db->get()->row_array();
        return $cmspage_details ? $cmspage_details : array();
    }

    function get_service_cache($cache_item_id='')
    {
        $cache_item_id = $cache_item_id ? $cache_item_id : uri_string().implode("_", $_POST);
        $this->load->driver('cache');
        $cache_data = $this->cache->redis->get($cache_item_id);
        
        return ($cache_data!=false) ? json_decode($cache_data, true) : array();
    }

    function save_service_cache($cache_item_id='', $cache_data=array(), $time=null)
    {
        $cache_item_id = $cache_item_id ? $cache_item_id : uri_string().implode("_", $_POST);    
        $this->load->driver('cache');
        $this->cache->redis->save($cache_item_id, json_encode($cache_data), $time);

        return true;
    }

    function clean_service_cache()
    {
        $this->load->driver('cache');
        $this->cache->redis->clean();
    }
  function currency_convert($from_cc='USD',$to_cc='INR',$amount=0)
  {
    $curr_array=array();
    $curr_array['status_id']=1;
    $curr_array['exchange_rate']=1;
    $curr_array['currency_code']=$to_cc;
    $curr_array['currency_paid_amount']=$amount;
        return $curr_array;

  }

}