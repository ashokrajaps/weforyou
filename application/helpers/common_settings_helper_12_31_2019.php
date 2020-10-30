<?php
/**************************
Project Name	: weforyou
Created on		: Jan 09, 2018
Last Modified 	: Jan 09, 2018
Description		: this file contains gobal setting for admin panel..
***************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* get Language label */
if (! function_exists ( 'get_label' )) {
	function get_label($label = null) {
		$CI = & get_instance ();
		return ucfirst ( $CI->lang->line ( $label ) );
	}
}
/* get Language label */
if (! function_exists ( 'get_label_path' )) {
	function get_label_path($label = null) {
		$CI = & get_instance ();
		return $CI->lang->line ( $label );
	}
}
/* get Language label */
if (! function_exists ( 'get_path_label' )) {
	function get_path_label($label = null) {
		$CI = & get_instance ();
		return $CI->lang->line ( $label ) ;
	}
}
/* get ip address */
if (! function_exists ( 'get_ip' )) {
	function get_ip() {
		return $_SERVER ['REMOTE_ADDR'];
	}
}
/* Put Start symbol */
if (! function_exists ( 'get_required' )) {
	function get_required() {
		return '<span class="required_star">*</span>';
	}
}
/* form size */
if (! function_exists ( 'get_form_size' )) {
	function get_form_size() {
		return 4;
	}
}
/* this method used to show records count */
if ( ! function_exists('show_record_info'))
{
	function show_record_info($total_rows,$start,$end)
	{
		if(($start+$end) > $total_rows) {
			$end = $total_rows;
		} else {
			$end = $start+$end;
		}

		 return ((int)$total_rows== 0 ? " ": 'Showing <b>'.($start+1).'</b> to<b> '.$end.'</b> of <b> '.$total_rows.' </b>entries');
	}
}
/* Get Admin Status dropdown */
if (! function_exists ( 'get_sort_order_dropdown' )) {
	function get_sort_order_dropdown($selected = null, $addStatus=array(),$extra=null) {
		$CI = & get_instance ();		
			if($selected == "I" || $selected  == "P")
			{
				$selected ="I";
			}
		$status	=	array (
				'Desc' => 'Newest',
				'Asc' => 'Oldest',		
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="sort_order_cls" id="sort_order"' : $extra;
		return form_dropdown ( 'sort_order', $status, $selected, $extra );
	}
}
/* this method used to add sort by option */
if (! function_exists ( 'add_sort_by' )) {
	function add_sort_by($filed_name, $module) {
		$CI = & get_instance ();
		
		if ( get_session_value ( $module . "_order_by_field" ) !="" && get_session_value ( $module . "_order_by_field" ) == $filed_name && get_session_value ( $module . "_order_by_value" ) != "") {
			$icon  = (get_session_value ( $module . "_order_by_value" ) == "ASC")? 'desc' : 'asc';
			return '&nbsp;<a  data="' . $filed_name . '" class="sort_'.$icon.'"  title=" ' . get_label ( 'order_by_'.$icon ) . ' "><i class="fa fa-sort-alpha-'.$icon.' t sort_icon"></i></a>';
			
		} else {
			
			return '&nbsp;<a  data="' . $filed_name . '" class="sort_asc"  title=" ' . get_label ( 'order_by_asc' ) . ' "><i class="fa fa-sort sort_icon"></i></a>';
		}

	}
}
/*  $this method used to load pagination config..  */
if ( ! function_exists('pagination_config'))
{
	function pagination_config($uri_string,$total_rows,$limit,$uri_segment,$num_links=2)
	{
		$CI = & get_instance ();
		$CI->load->library('pagination');
		$config = array();
		$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = $config['last_tag_open']   = $config['next_tag_open']  = $config['prev_tag_open'] = 	$config['num_tag_open'] =  '<li>';
		$config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close']  = $config['prev_tag_close'] =   $config['num_tag_close'] =  '</li>';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['cur_tag_open']  = '<li class="active"> <a>';
		$config['cur_tag_close'] = "</li> </a>";
		$config['num_links'] = $num_links; 
		$config['base_url'] = $uri_string;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		return $config;
	}
}
/* get date format unique format */
if (! function_exists ( "set_date_formart" )) {
	function set_date_formart($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'Y-m-d H:i:s';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_date_format" )) {
	function get_date_format($date, $format = "") {
		$format = ($format != "") ? $format : "d-m-Y";
		
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00") {
			return "";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_date_formart" )) {
	function get_date_formart($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'd-m-Y';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_date_time_formart" )) {
	function get_date_time_formart($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'd-m-Y H:i';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_day" )) {
	function get_day($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'd';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_month_name" )) {
	function get_month_name($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'M';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_year" )) {
	function get_year($date, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'Y';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
/* get date format unique format */
if (! function_exists ( "get_event_date_formart" )) {
	function get_event_date_formart($date,$date1,$date_info, $format = "") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'M d';
		$event_date='';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL || $date1 == "0000:00:00 00:00:00" || $date1 == "0000:00:00" || $date1 == NULL) {
			return "";
		} else {
			$days       = round(abs(date('d',strtotime($date)) - date('d',strtotime($date1))));// 0
			$months     = round(abs(date('m',strtotime($date)) - date('m',strtotime($date1))));// 0
			$years      = round(abs(date('y',strtotime($date)) - date('y',strtotime($date1))));// 0

			if($years)
			{
				$format = 'Y M d';
				if($months)
				{
					$start= date ( $format, strtotime ( $date ) );
					$end= ($date1) ? " - ".date ( $format, strtotime ( $date1 ) ) : '';					
					$event_date=$start.$end;
				}
				else if($days)
				{
					$start= date ( $format, strtotime ( $date ) );
					$end= ($date1) ? " - ".date ( 'd', strtotime ( $date1 ) ) : '';
					$event_date=$start.$end;
				}
				else
				{
					$start= date ( $format, strtotime ( $date ) );
					$event_date=$start;
				}										
			}
			else
			{
				$format = 'M d';
				if($months)
				{
					$start= date ( $format, strtotime ( $date ) );
					$end= ($date1) ? " - ".date ( $format, strtotime ( $date1 ) ) : '';					
					$event_date=$start.$end;
				}
				else if($days)
				{
					$start= date ( $format, strtotime ( $date ) );
					$end= ($date1) ? " - ".date ( 'd', strtotime ( $date1 ) ) : '';
					$event_date=$start.$end;
				}
				else
				{
					$start= date ( $format, strtotime ( $date ) );
					$event_date=$start;
				}
			}

			return $event_date;
		}
	}
}
if (! function_exists ( "get_event_time_formart" )) {
	function get_event_time_formart($date, $date1,$format = "h:i A") {
		$CI = & get_instance ();
		$format = ($format != "") ? $format : 'H:i';
		if ($date == "0000:00:00 00:00:00" || $date == "00:00:00" || $date == NULL) {
			return "";
		} else {
			return date ( $format, strtotime ( $date ) ) ." to ".date ( $format, strtotime ( $date1 ) );
		}
	}
}
/* get newest date */
if (! function_exists ( 'get_newest_date' )) {
	function get_newest_date() {		
		$current_date = current_date();
		$limit_date = strtotime($current_date);
		$date       = strtotime("-7 day", $limit_date);
		$newest_date = date('Y-m-d H:i:s', $date);
		return $newest_date;
	}
}
/* get time ago date for post */
if (! function_exists ( 'time_ago' )) {
	function time_ago($time_ago)
	{
		$time_ago = strtotime($time_ago);
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ; // 5292
		$minutes    = round($time_elapsed / 60 );// 88
		$hours      = round($time_elapsed / 3600);// 1
		$days       = round($time_elapsed / 86400);// 0
		$weeks      = round($time_elapsed / 604800);// 0
		$months     = round($time_elapsed / 2600640 );// 0
		$years      = round($time_elapsed / 31207680 );// 0
		// Seconds
		if($seconds <= 60){
			if($seconds<0)
			{
				return "0 sec";
			}
			else if($seconds==1)
			{
				return "1 sec";
			}
			else
			{
			return $seconds." secs";//5s
			}
		}
		//Minutes
		else if($minutes <=60 && $minutes!=0){
			if($minutes==1)
			{
				return "1 min";
			}
			else{
				return ($minutes." mins");//6m
			}
		}
		//Hours
		else if($hours <=24 && $hours!=0){
			if($hours==1)
			{
				return "1 hr";
			}
			else{
				return ($hours." hrs");//5h
			}
		}
		//Days
		else if($days <= 7 && $days!=0){
			if($days==1){
				return ($days." day");
			}else{
				return ($days." days");
			}
		}
		//Weeks
		else if($weeks <= 4.3 && $weeks!=0){
			if($weeks==1){
				return ($weeks." week");
			}else{
				return ($weeks." weeks");
			}   
		}
		//Months
		else if($months <=12 && $months!=0){
			return date('M d',$time_ago);        
		}
		//Years
		else{
			return date('Y M d',$time_ago);    
		}
	}
}

/* Get user key */
if (! function_exists ( 'get_random_key' )) {
	function get_random_key($length = 20, $table = null, $field_name = null, $value = null, $type = 'alnum') {
		$CI = & get_instance ();
		$CI->load->helper ( 'string' );
		
		$randomkey = ($value != "" ? $value : random_string ( $type, $length ));
		$result = $CI->Mydb->get_record ( array (
				$field_name 
		), $table, array (
				$field_name => trim ( $randomkey ) 
		) );
		
		if (! empty ( $result )) {
			// $randomkey = random_string($type,$length);
			return get_random_key ( $length, $table, $field_name, "", $type );
		} else {
			return $randomkey;
		}
	}
}
/* Check GUID exists */
if (! function_exists ( 'get_guid' )) {
	function get_guid($table = null, $field_name = null, $where = array()) {
		$CI = & get_instance ();
		$guid = GUID ();
		$where_arary = array_merge ( array (
				$field_name => trim ( $guid ) 
		), $where );
		$result = $CI->Mydb->get_record ( array (
				$field_name 
		), $table, $where_arary );
		
		if (! empty ( $result )) {
			return get_guid ( $table, $field_name );
		} else {
			return $guid;
		}
	}
}
/* this function used to generate generate GUID */
function GUID()
{
	if (function_exists('com_create_guid') === true)
	{
		return trim(com_create_guid(), '{}');
	}

	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
/* chek ajax request .. skip to direct access... */
if (! function_exists ( 'check_ajax_request' )) {
	function check_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {
			redirect ( base_url () );
			return false;
		}
	}
}
/* chek ajax request .. skip to direct access... */
if (! function_exists ( 'check_front_ajax_request' )) {
	function check_front_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {
			redirect ( base_url () );
			return false;
		}
	}
}
/* cretae bcrypt password... */
if (! function_exists ( 'do_bcrypt' )) {
	function do_bcrypt($password = null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		return $CI->bcrypt->hash_password ( $password );
	}
}
/* Compare bcrypt password... */
if (! function_exists ( 'check_hash' )) {
	function check_hash($password = null, $stored_hash = null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		if ($CI->bcrypt->check_password ( $password, $stored_hash )) {
			return 'Yes';
			// Password does match stored password.
		} else {
			return 'No';
			// Password does not match stored password.
		}
	}
}
/* function used to get session values */
if (! function_exists ( 'get_session_value' )) {
	function get_session_value($sess_name) {
		$CI = & get_instance ();
		return $CI->session->userdata ( $sess_name );
	}
}
/* this function used to removed unwanted chars */
if (! function_exists ( 'post_value' )) {
	function post_value($post_data = null) {
		$CI = & get_instance ();
		
		if ($CI->input->post ( $post_data )) {
			
			$data = addslashes ( trim ( $CI->input->post ( $post_data ) ) );
		} else {
			
			$data = addslashes ( trim ( $CI->input->get ( $post_data ) ) );
		}
		return $data;
	}
}
/* this function used provide clean putput value... */
if (! function_exists ( 'output_value' )) {
	function output_value($value = null) {
		return ($value == '') ? "N/A" : ucfirst ( stripslashes ( $value ) );
	}
}
/* this function used provide clean putput value... */
if (! function_exists ( 'output_val' )) {
	function output_val($value = null) {
		return ($value == '') ? '' : ucfirst ( stripslashes ( $value ) );
	}
}
/* this function used provide clean putput value... */
if (! function_exists ( 'get_output_value' )) {
	function get_output_value($value = null) {
		return ($value == '') ? "N/A" :  ( stripslashes ( $value ) );
	}
}
/* this method used to set Session URL */
if (! function_exists ( 'set_sessionurl' )) {
	function set_sessionurl($data) {
		$CI = & get_instance ();
		$protocol = 'http';
		$re = $protocol . '://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		$CI->session->set_userdata ( $data, $re );
	}
}

/* Make SEO friendly url */
if (! function_exists ( 'make_slug' )) {
	function make_slug($title, $table_name, $field_name, $chk_where = null) {
		$CI = & get_instance ();
		$page_uri = '';
		$code_entities_match = array (
				' ',
				'&quot;',
				'!',
				'@',
				'#',
				'$',
				'%',
				'^',
				'&',
				'*',
				'(',
				')',
				'+',
				'{',
				'}',
				'|',
				':',
				'"',
				'<',
				'>',
				'?',
				'[',
				']',
				'',
				';',
				"'",
				',',
				'.',
				'_',
				'/',
				'~',
				'`',
				'=',
				'---',
				'--' 
		);
		
		$code_entities_replace = array (
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-' 
		);
		
		$text = str_replace ( $code_entities_match, $code_entities_replace, $title );
		$t = htmlentities ( $text, ENT_QUOTES, 'UTF-8' );
		$page_urii = trim ( strtolower ( $t ), "-" );
		$page_uri_where = array (
				$field_name => $page_urii 
		);
		
		$where = (! empty ( $chk_where )) ? array_merge ( $page_uri_where, $chk_where ) : $page_uri_where;
		
		$result = $CI->Mydb->get_record ( array (
				$field_name 
		), $table_name, $where );
		$CI->load->helper ( 'string' );
		// $page_uri = (!empty($result) ) ? $result [$field_name] . "-" . random_string ( 'alnum', 50 ) : $page_urii;
		
		// return strtolower ( $page_uri );
		if (! empty ( $result )) {
			$re_page = $result [$field_name] . "-" . random_string ( 'alnum', 25 );
			return make_slug ( $re_page, $table_name, $field_name, $chk_where );
		} else {
			return $page_urii;
		}
	}
}

/* this method used to output integer vcalue */
if (! function_exists ( 'output_integer' )) {
	function output_integer($value = null) {
		return ($value == 0) ? "" : $value;
	}
}

/* this method used to output integer vcalue */
if (! function_exists ( 'output_date' )) {
	function output_date($date = null) {
		return ($date != "1970-01-01") ? $date : "";
	}
}

/* this function used show enabled or disbled status */
if (! function_exists ( 'output_enbled' )) {
	function output_enbled($vlaue = null) {
		return ($vlaue == 1) ? "Yes" : "No";
	}
}

/* this function used to show name */
if (! function_exists ( 'output_name' )) {
	function output_name($fname = null, $lname = null) {
		return ($fname != "" && $lname != "") ? ucwords ( stripslashes ( $fname . " " . $lname ) ) : ($fname != "" ? ucwords ( stripslashes ( $fname ) ) : "N/A");
	}
}

/* Add tooltip */
if(!function_exists('add_tooltip'))
{
	function add_tooltip($title=null)
	{
		 return ' <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="'.get_label($title."_ttip").'" ></i>';
	}
}
/****** show post user name *******/
if ( ! function_exists('post_user'))
{
	function post_user($f_name="",$lname="")
	{
		return stripslashes(ucwords($f_name." ".$lname));
	}
}
/**
* Generate a random password.
*/
if ( ! function_exists('get_random_password'))
{
   function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

      return $password;
    }

}
/**
* Company records per page.
*/
if (! function_exists ( 'company_records_perpage' )) {
	function company_records_perpage() {
		return 5;
	}
}
/**
* Front Loading Image.
*/
if (! function_exists ( 'front_loading_image' )) {
	function front_loading_image($class=null) {
		return  '<img src="'.load_lib("theme/images/loading_icon_default.gif").'" alt="loading.."  class="'.$class.'"/>';
	}
}
if (! function_exists ( 'generateRandomString' )) {
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
}
/* Get Language list    */
if(!function_exists('get_language'))
{
	function get_language($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('language_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('language_id,language_name,language_code','languages',$where_array,'','',array('language_name'=>"ASC"));
		$data=array(''=>get_label('select_language'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['language_code']] = stripslashes($value['language_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="language" ' ;
		 
		return  form_dropdown('language',$data,$selected,$extra);
	}
}
/* Get language name */
if(!function_exists('get_language_name'))
{
	function get_language_name($language_id='')
	{
		$CI=& get_instance();
		$lang = $CI->Mydb->get_record('language_name','languages',array('language_code' => $language_id ));
		return (isset($lang['language_name'])) ? ucwords(stripslashes($lang['language_name'])) : "N/A";
	}
}
/* this function used to get admin email */
if (! function_exists ( 'get_admin_email' )) {
	function get_admin_email() {
		$CI = & get_instance ();
		$records = $CI->Mydb->get_record ( 'settings_admin_email', 'master_admin_settings' );
		return $records;
	}
}
/* this function used to get footer */
if (! function_exists ( 'get_footer_content' )) {
	function get_footer_content() {
		$CI = & get_instance ();
		$records = $CI->Mydb->get_record ( 'staticblocks_description', 'admin_staticblocks',array('staticblocks_id'=>1) );
		return $records['staticblocks_description'];
	}
}
/* this function used to get_records_limit */
if (! function_exists ( 'get_records_limit' )) {
	function get_records_limit() {
		$CI = & get_instance ();
		$records = $CI->Mydb->get_record ( 'settings_admin_records', 'master_admin_settings' );
		return $records['settings_admin_records'];
	}
}
/* this method used to get limit the word */
if(!function_exists('word_limit'))
{
	function word_limit($string=null,$length=null)
	{
		if($string!='')
		{
			$length=($length!='')?$length:40;
			$limit_string=substr($string, 0, $length-1);
			if(strlen($string)>$length)
			{

				return $limit_string."...";
			}
			else
			{
				return $limit_string;
			}
	    }
	    else
	    {
			return '';
		}
		
	}
}
if(!function_exists('variable_exists'))
{
	function variable_exists($string) 
	{
	  if (isset($string) && $string) 
	  {
		return $string;
	  }
	  return '';
	}
}
if (! function_exists ('get_country_name')) {
	function get_country_name($country_id) {

		$CI = & get_instance ();
		$result=array();
		$country_table = 'countries';
		$where = array("fld_country_status_id"=>'1',"fld_country_id"=>$country_id);
		$select = array('fld_country_id','fld_country_name');

		$records = $CI->Mydb->get_record ( $select, $country_table, $where );
		$result='';
		if(!empty($records))
		{
			$result=$records['fld_country_name'];
		}
 		return $result;

	}
}
if(!function_exists('relative_date')) {
	function relative_date($time) {
 
		$today = strtotime(date('M j, Y'));
		$reldays = ($time - $today)/86400;
 
		if ($reldays >= 0 && $reldays < 1) {
			return 'Today';
		} else if ($reldays >= 1 && $reldays < 2) {
			return 'Tomorrow';
		} else if ($reldays >= -1 && $reldays < 0) {
			return 'Yesterday';
		}
		if (abs($reldays) < 7) {
			if ($reldays > 0) {
				$reldays = floor($reldays);
					return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
			} else {
				$reldays = abs(floor($reldays));
					return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
			}
		}
		if (abs($reldays) < 182) {
			return date('l, j F',$time ? $time : time());
		} else {
			return date('l, j F, Y',$time ? $time : time());
		}
	}
}
/* get post images list */
if(!function_exists('get_user_profile'))
{
	function get_user_profile($user_id=NULL)
	{
		$CI =& get_instance();
		$record = $CI->Mydb->get_record('*','rxl_users',array('users_id' => $user_id,));
		return $record;
	}
}
/* get country list*/
if (! function_exists ('get_country_code_list')) {
	function get_country_code_list($fieldname,$selected='',$extra='',$where='') {

		$CI = & get_instance ();

		$country_table = 'countries';
		$where = array("status"=>'A');
		$select = array('country_id','country_name','country_code','country_phone_code','GMT','timezone');
		$order_by=array('country_phone_code'=>'ASC');
		
		$records = $CI->Mydb->get_all_records ( $select, $country_table, $where,'','',$order_by );
		$data=array(''=>get_label('select_country_code'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				if($value['country_phone_code']>0)
				{
					$data[$value['country_phone_code']] = "+".stripslashes($value['country_phone_code']);
				}
			}
		}
 
		$extra = ($extra == "")? 'class="country_code" id="country_code"' : $extra;
		return form_dropdown ($fieldname,$data, $selected, $extra );

	}
}
if(!function_exists('getcategory_list_dd')) {
	  
	  function getcategory_list_dd($fieldname,$selected='',$extra='',$where='') {
		$CI = & get_instance ();
		
		$records = array();
	

			$table = 'rxl_doctor_dispensary_category';
			$where = array( "category_status" =>"A");
			
			$select = array('category_id','category_name', 'category_status', 'category_created_on','category_created_by','category_created_ip');
			$order_by=array('category_name'=>'ASC');
			$groupby=array('category_name');			
			
			$records = $CI->Mydb->get_all_records ( $select, $table, $where, '', '', $order_by,'',$groupby );
		if(!empty($records))
		{
			foreach($records as $value)
			{
					$data[$value['category_id']] = stripslashes($value['category_name']);
			}
		}
 
		$extra = ($extra == "")? 'class="medical_category" id="medical_category"' : $extra;
		return form_dropdown ($fieldname,$data, $selected, $extra );
	}
}

/* Get Method Name */
if(!function_exists('get_method_name')) {
function get_method_name() {
$CI=& get_instance();
$method = $CI->router->fetch_method(); 
return $method;
}	
}
/* Get Class Name */
if(!function_exists('get_class_name')) {
function get_class_name() {
$CI=& get_instance();
$class = $CI->router->fetch_class();
return $class;
}	
}
/* get budget list drop down */
if (! function_exists ('get_post_category_list_dd')) {
	function get_post_category_list_dd($fieldname,$selected='',$extra='',$where='') {

		$CI = & get_instance ();
		$data=array();
		$table = 'post_category';
			$where = array( 'post_category_status'=>'A');
		$select = array('post_category_id','post_category_name');
		$order_by=array('post_category_name'=>'ASC');
		
		$records = $CI->Mydb->get_all_records ( $select, $table, $where,'','',$order_by );
		$data=array(''=>get_label('select_category'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
					$data[$value['post_category_id']] = stripslashes($value['post_category_name']);
			}
		}
 
		$extra = ($extra == "")? 'class="post_category_color post_category_id_cls" id="post_category_id"' : $extra;
		return form_dropdown ($fieldname,$data, $selected, $extra );

	}
}
if(!function_exists('get_post_category_list')) {
	  
	  function get_post_category_list() {
		$CI = & get_instance ();
		
		$result = array();
		$table = 'post_category';
			$where = array( 'post_category_status'=>'A');
			$select = array('post_category_id','post_category_name','post_category_color');
		$records = $CI->Mydb->get_all_records($select, $table, $where);
		if(!empty($records))
		{
			foreach($records as $record)
			{
				$result[]=$records;
			}
		}
 
		return $result;
	}
}
if(!function_exists('get_post_category_color')) {
	  
	  function get_post_category_color($post_cate_id='') {
		$CI = & get_instance ();
		
		$result = "";
		$table = 'post_sub_category';
			$where = array( 'post_sub_category_id'=>$post_cate_id ,'post_sub_category_status'=>'A');
			$select = array('post_sub_category_id','post_sub_category_name','post_sub_category_color');
		$records = $CI->Mydb->get_record($select, $table, $where);
		if(!empty($records))
		{
				$result=$records['post_sub_category_color'];
		}
 
		return $result;
	}
}
if(!function_exists('get_post_category_name')) {
	  
	  function get_post_category_name($post_cate_id='') {
		$CI = & get_instance ();
		
		$result = "";
		$table = 'post_category';
			$where = array( 'post_category_id'=>$post_cate_id ,'post_category_status'=>'A');
			$select = array('post_category_id','post_category_name');
		$records = $CI->Mydb->get_record($select, $table, $where);
		if(!empty($records))
		{
				$result=$records['post_category_name'];
		}
 
		return $result;
	}
}
/* this function used to show categoery dropdown values */
if(!function_exists('get_post_category_select'))
{
	function get_post_category_select($where='',$cateselected='',$extra='',$enable_mutible="")
	{
		$CI=& get_instance();
		$cateselected = $cateselected;
		$where_array=($where=='')? array('post_category_id !='=>'') :  $where ;
		
		$where_array = array_merge($where_array,array('post_category_status'=>'A')); /* check company and app id... */
		
		$records=$CI->Mydb->get_all_records('post_category_id,post_category_name','post_category',$where_array,'','',array('post_category_name'=>"ASC"));

		$data=array(''=>get_label('category_select'));
		
		$form = ' <select name="post_sub_category" '.$extra.'  data-custom="1"  data-placeholder="'.get_label('category_select').' " title="'.sprintf(get_label('product_errors'),get_label('product_categorie')).'">
				<option value="">'.get_label('category_select').'</option>';
		if(!empty($records))
		{
			foreach($records as $mod)
			{
				$mod_vals = get_post_subcategory(array('post_category_id' => $mod['post_category_id']));
		 	 
				if(!empty($mod_vals)) {
					
					$form .=' <optgroup label="'.ucwords(stripslashes($mod['post_category_name'])).' ">';
						
					foreach($mod_vals as $modval)
					{ 
						$sel_cate = ($modval['post_sub_category_id'] == $cateselected) ? 'selected' : '';
						
						$form .='<option value="'.$mod['post_category_id'].'~'.$modval['post_sub_category_id'].'" '.$sel_cate.' >'.ucwords(stripslashes($modval['post_sub_category_name'])). '</option>';
					}

					$form .=' </optgroup>';
				}
			}
		}
			
		$form.=' </select>';
			
		return $form;
	}
}

/*  this function to get all  subcategories list   */
if(!function_exists('get_country_list_dd'))
{
	function get_country_list_dd($name='',$selected = null,$extra=null,$where=array()) 
	{
		$CI=& get_instance();
		$where  = array_merge(array('fld_country_status_id'=>'1'),$where);
		$records=$CI->Mydb->get_all_records('fld_country_id,fld_country_name','countries',$where,'','',array('fld_country_name' => 'ASC'));

		$data=array(''=>get_label('select_country'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['fld_country_id']] = stripslashes($value['fld_country_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="country_id" ' ;
		 $name=($name != '') ? $name : 'country_id';
		return  form_dropdown($name,$data,$selected,$extra);		
	}
}
if ( ! function_exists('get_user_name_slug'))
{
	function get_user_name_slug($user_id = null)
	{ 
		$CI = & get_instance ();

		if($user_id != "")
		{
				$field_name = array('user_name_slug');
				$table = 'users';
				$where_arary = array('users_id' => $user_id );
				$result = $CI->Mydb->get_record ( $field_name, $table, $where_arary );
				$u_fname = $result['user_name_slug'];	
		}

		return $u_fname;
	}
}
if ( ! function_exists('get_event_registration_remainder_alert'))
{
	function get_event_registration_remainder_alert()
	{ 
		$CI = & get_instance ();
		$result=array();
		$table = 'event';
		$order=array('event_registration_start_date'=>'asc');
		$where_arary=array("event_status"=>'1','event_registration_end_date >='=>date("Y-m-d"));
		$result = $CI->Mydb->get_record ( '*', $table, $where_arary,$order );
		// echo $CI->Mydb->print_query();
		// exit;
			return $result;
	}
}
if ( ! function_exists('get_admin_setting'))
{
	function get_admin_setting()
	{ 
		$CI = & get_instance ();
		$result=array();
		$table = 'master_admin_settings';
		$order=array('settings_site_title'=>'asc');
		$where_arary=array("settings_id"=>'1');
		$result = $CI->Mydb->get_record ( '*', $table, $where_arary,$order );
		// echo $CI->Mydb->print_query();
		// exit;
			return $result;
	}
}
/* Get Admin Status dropdown */
if (! function_exists ( 'get_area_of_interest_dropdown' )) {
	function get_area_of_interest_dropdown($selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				' ' => get_label('select_volunteer_area_of_interest'),
				'1' => 'Field Work',
				'2' => 'Office work',
				'3' => 'Tech Support',
				'4' => 'Donor handling',
				'5' => 'Others',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="status" multiple' : $extra;
		return form_dropdown ( 'volunteer_area_of_interest', $status, $selected, $extra );
	}
}
/* Get Admin Status dropdown */
if (! function_exists ( 'get_event_address' )) {
	function get_event_address($selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				' ' => get_label('select_volunteer_area_of_interest'),
				'1' => 'Field Work',
				'2' => 'Office work',
				'3' => 'Tech Support',
				'4' => 'Donor handling',
				'5' => 'Others',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="status" multiple' : $extra;
		return form_dropdown ( 'volunteer_area_of_interest[]', $status, $selected, $extra );
	}
}
if(!function_exists('get_member_dd'))
{
	function get_member_dd($count=2,$name='',$selected='',$extra='')
	{
		$data=array();
		if($count>0)
		{
			for($i=1;$i<=$count;$i++)
			{
				$data[$i] = stripslashes($i);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="'.$name.'" ' ;
		 
		return  form_dropdown($name,$data,$selected,$extra);
	}
}