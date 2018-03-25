<?php
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: this file contains gobal setting for admin panel..
***************************/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/* get content type */
if(!function_exists('get_content_type'))
{
	function get_content_type()
	{
		header('Content-Type: application/json');
	}

}

/* Get encrypted value */
if(!function_exists('get_encrypted_key'))
{
	function get_encrypted_key($data)
	{
		return crypt($data, '$6$rounds=5000$#$$#%$%&%^*&(sdf@#$$');
	}
}

/************ get site title ************/
if(!function_exists('get_site_title'))
{
	function get_site_title($title=null)
	{
           if($title!="")
           {
           	 return $title;
           }
           else
           {
           	 return get_label('site_title');
           }
	}
}
/****** ***** get current date ***************/
if ( ! function_exists('current_date'))
{
	function current_date()
	{
		return date("Y-m-d H:i:s");
	}
}


/*********  get metatitle ****************/
if ( ! function_exists('get_meta_title'))
{
	function get_meta_title($title)
	{
	     return ($title !="") ?  $title." | ".get_site_title() : '';
	}
}


/* On or Off form autocomplet value */

if(!function_exists('form_autocomplte'))
{
	function form_autocomplte()
	{
		 /*If development mode is enabled*/
		return 'on';
	}

}
/**********  get user session userid  ************/
if ( ! function_exists('get_user_id'))
{
	function get_user_id()
	{
		$CI =& get_instance();		
		return  $CI->session->userdata('users_id');
	}
}
/**********  get user session user type  ************/
if ( ! function_exists('get_user_type'))
{
	function get_user_type()
	{
		$CI =& get_instance();		
		return  $CI->session->userdata('user_type');
	}
}

/* load meta tags  */
if (!function_exists('load_meta_tags')) {

	function load_meta_tags($data) { 

		$CI = & get_instance();
		$title = $data['metatitle'];
		$meta = array(
				array('name' => 'robots', 'content' => 'index,follow'),
				array('name' => 'description', 'content' => (isset($data['metacontent']) && $data['metacontent']!="")  ? $data['metacontent'] : $title ),
				array('name' => 'keywords', 'content' => (isset($data['metakeyword']) && $data['metakeyword'] !='' )? $data['metakeyword'] : $title),
				array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'));
		 
		echo "<title>" . $title . "</title>";
		echo meta($meta);
		echo "<link rel=\"shortcut icon\" href=\"".skin_url()."images/favicon.png\" type=\"image/x-icon\">"."\n";
		echo "<link rel=\"icon\" href=\"".skin_url()."images/favicon.png\" type=\"image/x-icon\">"."\n";
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\" />"."\n";
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\" />"."\n";
		if(!empty($data['metaogimage'])) {

			echo '<meta property="og:image" content="'.$data['metaogimage'].'" />';
		}
		
	}
}




/* Function used to encode value - created on Jun 5, 2014 */
if(!function_exists('encode_value'))
{
	function encode_value($value='')
	{
		if($value != '')
		{
			return str_replace('=','',base64_encode($value));
		}
	}
}
/* Function used to decode for encoded value - created on Jun 5, 2014 */
if(!function_exists('decode_value'))
{
	function decode_value($value='')
	{
		if($value != '')
		{
			return base64_decode($value);
		}
	}
}
/* Function used to crypt value using salt - created on Dec 29, 2014 */
if(!function_exists('crypt_value'))
{
	function crypt_value($value='')
	{
		if($value != '')
		{
			return crypt($value,SALT_KEY);
		}
	}
}



/* Get category image */
function get_noimage($type=null,$image_name=null,$width=null,$height=null,$alt=null,$class_name=null)
{
	if($image_name !="") {
		 return $image_name;
	  }else{
		 return media_url()."no-images/no-image.jpg";
	  }
}


/* Function used to Print query  */
if (! function_exists('print_query')) {

	function print_query()
	{
		return get_instance()->db->last_query();
	}
}


/* Function used to  escape string */
if (! function_exists('escape')) {

	function escape($field)
	{
		 return get_instance()->db->escape($field);
	}
}

/*  get loading icon  */
if(!function_exists('get_loading'))
{
	function get_loading()
	{
		return media_url()."loading.gif";
	}
}

/* get  current time */
if(!function_exists('get_time'))
{
	function get_time()
	{
		$date = date("d-m-Y H:i:s");
        return strtolower(date("g.i a", strtotime($date)));

	}
}

/*  string length  */
if(!function_exists('string_length'))
{
	function string_length($str,$end=20, $end_char = '&#8230')
	{
		$str = ucwords(stripslashes($str));
		if (strlen($str) < $end)
		{
			return $str;
				
		}else {
				
			return substr($str,0,$end).$end_char;
		}

	}
}

/*word count*/
if(!function_exists('limit_text'))
{
	function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) .' Read more...';
      }
      return $text;
    }
}    

if(!function_exists('word_limiter'))
{
function word_limiter($str, $limit = 100,$base_url=null)
{
	if (trim($str) == '')
	{
		return $str;
	}

	preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

	if (strlen($str) == strlen($matches[0]))
	{
		$end_char = '';
	}
	else{

		$end_char = '&#8230; <a href="'."$base_url".'"></a>';

	}

	return rtrim($matches[0]).$end_char;
}	
}    


/*   admin pagination  configure */
if ( ! function_exists('pagination'))
{
	function pagination($uri_string,$total_rows,$limit,$uri_segment,$num_links=2)
	{
		$config = array();
		$config['base_url'] = $uri_string;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['first_tag_open'] = '<span class="text_pag">';
		$config['first_tag_close'] = '</span>';
		$config['last_tag_open'] = '<span class="text_pag">';
		$config['last_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<a class="page_act">';
		$config['cur_tag_close'] = '</a>';
		return $config;
	}
}
/*  Copyrights */
if(!function_exists('copyrights'))
{
	function copyrights(){
		echo sprintf(get_label('copyrights'), date('Y'));
	}
}

/* Get Admin Status dropdown */
if (! function_exists ( 'get_gender_dropdown' )) {
	function get_gender_dropdown($selected = null, $addStatus=array(),$extra=null) {

		$status	=	array (
				' ' => 'Select',
				'Male' => 'Male',
				'Female' => 'Female',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="gender"' : $extra;
		return form_dropdown ( 'gender', $status, $selected, $extra );
	}
}

/* get site setting... */
if(!function_exists('get_site_setting'))
{
	function get_site_setting($table=null)
	{	
		$CI =& get_instance();
		$record = $CI->Mydb->get_record ('*', $table);
		return $record;
	}
} 
if(!function_exists('social_share')) {
	
	function social_share($type=null,$url =null,$title=null,$image=null,$desc=null) {
	
	$sh_url = $sh_title=$sh_desc='';
	$picture= urlencode(base_url().'media/no-images/no-image.jpg');
	
	if(!empty($url)) {
		$sh_url=$url;
	}
	if(!empty($title)) {
		$sh_title=urlencode(stripslashes(html_entity_decode($title)));
	}
	if(!empty($desc)) {
		$sh_desc=urlencode(stripslashes(html_entity_decode($desc)));
	}
	if(!empty($image)) {
		$picture= $image;
	}  
	
	$ge_url = array( 'fb'=> 'http://www.facebook.com/share.php?u='.$sh_url.'&picture='.$picture.'&title='.$sh_title.'&description='.$sh_desc,
	'twitter' => 'https://twitter.com/intent/tweet?text='.$sh_title." - ".$sh_desc.'&url='.$sh_url,
	'pinterest' => 'http://pinterest.com/pin/create/button/?url='.$sh_url.'&media='.$picture.'&description='.$sh_title." - ".$sh_desc,
	'instagram' => '' );	
	return $ge_url[$type];
		
	}
	
}
