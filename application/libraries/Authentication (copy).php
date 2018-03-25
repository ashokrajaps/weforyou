<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Authentication {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
	}
	
	/* Master adminpanel authenticaion */
	function admin_authentication() {
		$nomat_admin = $this->ci->session->userdata ( "nc_admin_id" );
		($nomat_admin == "") ? redirect ( admin_url () ) : '';
	}
	
	/* Master adminpanel authenticaion */
	function site_authentication() {
		$nomat_admin = $this->ci->session->userdata ( "users_id" );
		
		($nomat_admin == "") ? redirect ( base_url () ) : '';
	}
	function user_authentication_login()
	 {
		 $user_session_id = $this->ci->session->userdata("users_id");
		 ($user_session_id != "")? redirect(base_url()) : '';
	 }
	 /* user authenticaion */
	 function user_authentication()
	 {
		 $user_session_id = $this->ci->session->userdata("users_id");
		 ($user_session_id =="")? redirect(base_url('account/login')) : '';
	 }
	 function user_auth()
	 {
		 $user_session_id = $this->ci->session->userdata("users_id");
		 
		 $users_first_name = $this->ci->session->userdata("users_first_name");
		 $users_email = $this->ci->session->userdata("users_email");
		 $users_phone = $this->ci->session->userdata("users_phone");
		 $users_zipcode = $this->ci->session->userdata("users_zipcode");
		 $user_type = $this->ci->session->userdata("user_type");		 		 		 		 		 
		 if($users_first_name=="" || $users_email=="" || $users_phone=="" || $users_zipcode=="" || $user_type=="")
		 { 
			 redirect(base_url('myaccount/editprofile'));
		 }
		 elseif($user_session_id=="")
		 {
			redirect(base_url());
		 }	 
		 	 
	 }	 
}
 
/* End of file authentication.php */
/* Location: ./application/libraries/authentication.php */
