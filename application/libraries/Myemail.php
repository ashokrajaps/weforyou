<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: Common email library
***************************/
class Myemail
{
protected $ci;

public function __construct()
 {
	$this->ci =& get_instance();
 }
	
/* this function used to send e-email in masteradmin panel */
 
 function send_admin_mail($to_email_address,$template_id,$chk_arr,$rep_arr)
 {
 
 	$this->ci =  & get_instance();
 	$this->ci->load->database();
	$dbprefix = $this->ci->db->dbprefix;

	//echo $to_email_address;
	//echo $template_id;
	//print_r($chk_arr);
	//print_r($rep_arr);

	//exit;

 	$template_table = $dbprefix."admin_email_templates";
 	$setting_table =  $dbprefix."master_admin_settings";

 	$query = " SELECT e.email_subject,e.email_content,s.settings_from_email,s.settings_admin_email,s.settings_site_title,s.settings_mail_from_smtp,s.settings_email_footer,s.settings_smtp_host,s.settings_smtp_user,s.settings_smtp_pass,s.settings_smtp_port,s.settings_mailpath FROM  $template_table as e
 	INNER JOIN $setting_table as s ON  e.email_id = '".$template_id."'  ";

 	
 	$result = $this->ci->Mydb->custom_query_single($query);
	
 	//print_r($result); exit;

 	if(!empty($result))
 	{
 		/* get basic mail config values */
 		$to_email = ($to_email_address == '')? $result['settings_admin_email']  : $to_email_address;

 		$from_email = $result['settings_from_email'];
 		$site_title = ucfirst($result['settings_site_title']);
 		$subject = $result['email_subject'];
 		$email_content = $result['email_content'];
 		 
 		/* merge contents */
 		$chk_arr1 = array('[LOGOURL]','[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]');

 		$rep_array2 = array(load_lib()."theme/images/logo.png",base_url(),$result['settings_email_footer'],$result['settings_admin_email'],$site_title);

 		$final_chk_arr = array_merge($chk_arr,$chk_arr1);

 		$final_rep_arr = array_merge($rep_arr,$rep_array2);

 		$message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);

 		$datas = array('CONTENT' => $message1 );

 		$this->ci->load->library(array('parser','email'));

 		$message = $this->ci->parser->parse('email_template_head', $datas,true);
 		
 	
 		/* mail part */
 		 
 		if($result['settings_mail_from_smtp']==1)
 		{
 			$config['smtp_host']	= $result['settings_smtp_host'];
 			$config['smtp_user']	= $result['settings_smtp_user'];
 			$config['smtp_pass']	= $result['settings_smtp_pass'];
 			$config['smtp_port']	= $result['settings_smtp_port'];
 			$config['mailpath'] 	= $result['settings_mailpath'];
 			$config['protocol'] 	= 'smtp';
 		}
 		else
 		{
 			$config['protocol'] 	= 'sendmail';
 		}
 	
 	
 		$config['charset'] 		= 'iso-8859-1';
 		$config['wordwrap'] 	= TRUE;
 		$config['charset'] 		= "utf-8";
 		$config['mailtype'] 	= "html";
 		$config['newline'] 		= "\r\n";
 		$this->ci->email->initialize($config);
 		$this->ci->email->from($from_email,$site_title);
 		$this->ci->email->to($to_email);
 		$this->ci->email->subject($subject);
 		$this->ci->email->message($message);
 		$email_status = $this->ci->email->send();
 	
 		if($email_status)
 		{
 			return 1;
 		}
 		else
 		{
 			return 0;
 		}
 		 
 		 
 	}
 	
 }
 
 function send_client_mail($to_email_address,$template_id,$chk_arr,$rep_arr,$client_id,$app_id)
 {	
    
 	$this->ci =  & get_instance();
	$dbprefix = $this->ci->db->dbprefix;

 	$template_table = $dbprefix."admin_email_templates";
 	$setting_table = $dbprefix."master_admin_settings";
 		
 	$query = " SELECT e.email_subject,e.email_content,s.settings_from_email,s.settings_admin_email,s.settings_site_title,s.settings_mail_from_smtp,s.settings_email_footer,s.settings_smtp_host,s.settings_smtp_user,s.settings_smtp_pass,s.settings_smtp_port,s.settings_mailpath FROM  $template_table as e
 	INNER JOIN $setting_table as s ON  e.email_id = '".$template_id."'  ";

 	
 	$result = $this->ci->Mydb->custom_query_single($query);
 	
 
 	if(!empty($result))
 	{	
 		
 		/* get basic mail config values */
 		$to_email = ($to_email_address == '')? $result['settings_admin_email']  : $to_email_address;
 		$from_email = $result['settings_admin_email'];
 		$site_title = ucfirst($result['settings_site_title']);
 		$subject = $result['email_subject'];
 		$email_content = $result['email_content'];
 		 
 		/* merge contents */
 		$chk_arr1 = array('[LOGOURL]','[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]');

 		$logo="";

 		/* if( ( trim($result['client_logo'])!='' ) && file_exists(FCPATH."media/".$result['client_folder_name']."/company-logo/".$result['client_logo']))
 		{
			$logo=media_url().$result['client_folder_name']."/company-logo/".$result['client_logo'];
			
		}
		else
		{
			$logo=load_lib()."theme/images/email_logo.png";
			
		}*/
		 
		
		//$base_url=($result['client_site_url'] !='')? $result['client_site_url']  : base_url();
		$base_url="";

 		$rep_array2 = array($logo,base_url(),$result['settings_email_footer'],$result['settings_admin_email'],$site_title);

 		$final_chk_arr = array_merge($chk_arr,$chk_arr1);

 		$final_rep_arr = array_merge($rep_arr,$rep_array2);

 		$message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);

 		$datas = array('CONTENT' => $message1 );
 		$this->ci->load->library(array('parser','email'));
 		$message = $this->ci->parser->parse('email_template_head', $datas,true);
 		
 	
 	
 		/* mail part */
 		 
 		if($result['settings_mail_from_smtp']==1)
 		{
 			$config['smtp_host']	= $result['settings_smtp_host'];
 			$config['smtp_user']	= $result['settings_smtp_user'];
 			$config['smtp_pass']	= $result['settings_smtp_pass'];
 			$config['smtp_port']	= $result['settings_smtp_port'];
 			$config['mailpath'] 	= $result['settings_mailpath'];
 			$config['protocol'] 	= 'smtp';

 		}
 		else
 		{
 			$config['protocol'] 	= 'sendmail';
 		}
 	
 	
 		$config['charset'] 		= 'iso-8859-1';
 		$config['wordwrap'] 	= TRUE;
 		$config['charset'] 		= "utf-8";
 		$config['mailtype'] 	= "html";
 		$config['newline'] 		= "\r\n";
 		$this->ci->email->initialize($config);
 		$this->ci->email->from($from_email,$site_title);
 		$this->ci->email->to($to_email);
 		$this->ci->email->subject($subject);
 		$this->ci->email->message($message);
 		$email_status = $this->ci->email->send();
 	   
 		if($email_status)
 		{
			
 			return 1;
 		}
 		else
 		{
			
 			return 0;
 		}
 		 
 		 
 	}
 	
 }

 
 

}
 
/* End of file Myemail.php */
/* Location: ./application/libraries/Myemail.php */
