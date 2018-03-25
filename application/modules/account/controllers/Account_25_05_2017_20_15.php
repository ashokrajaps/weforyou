<?php 
include('facebook/Facebook/autoload.php');
/************************************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: This class contains registration, Login, Reset password
**************************************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library ( 'form_validation' );
		$this->module_name = "account";
		$this->folder = "account/";
		$this->form_validation->set_error_delimiters('<li> <i class="fa fa-times-circle-o"></i>', '</li>');
		$this->table='users';
		$this->upload_folder = "media/users/";		
	}
	
	
	public function googlelogin()
	{
		include_once APPPATH."third_party/google-api-php-client/Google_Client.php";
		include_once APPPATH."third_party/google-api-php-client/contrib/Google_Oauth2Service.php";
		$codeing_google = explode('?code=',$_SERVER['REQUEST_URI']);

		//$clientId = '157027549515-orf31dc505dh2vucdmm3kafdtjarbiki.apps.googleusercontent.com';
		$clientId = '157027549515-j0t1kpq7vtfrqidqeovbk6pvtfupc3tr.apps.googleusercontent.com';
		//$clientSecret = 'GinUfdhB7n3MDSw00Eskq3dx';
		$clientSecret = 'T1nFLww__VmQwgQnAomnprF3';
		$redirectUrl = base_url().'account/googlelogin';
		/* $gClient = new Google_Client();
		$gClient->setApplicationName('RxLeaf');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectUrl);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		 $gClient->authenticate();
		 echo $gClient->getAccessToken();*/
		 
		$client = new Google_Client();
		$client->setApplicationName("Web client 2");
		$client->setClientId($clientId);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectUrl);

		// Visit https://code.google.com/apis/console?api=plus to generate your
		// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
		// $client->setClientId('insert_your_oauth2_client_id');
		// $client->setClientSecret('insert_your_oauth2_client_secret');
		// $client->setRedirectUri('insert_your_redirect_uri');
		// $client->setDeveloperKey('insert_your_developer_key');
		$oauth2 = new Google_Oauth2Service($client);
		if (isset($codeing_google[1])) {
			$client->authenticate($codeing_google[1]);
			$this->session->set_userdata('Gtoken', $client->getAccessToken());
			$redirectUrl=base_url().'account/login';
			header('Location: '.$redirectUrl);
		}
		exit;
	}
	public function login()
	{   
		$this->authentication->user_authentication_login();

		/*user registration section*/		
		$data=array();
		$user_type="";
		
		$action=$this->input->post('action');
		$user_type_val=$this->input->post('user_types');
		if($user_type_val=="sign_Physician")
		{
			$user_type="Physician";
		}
		elseif($user_type_val=="sign_non_Physician")
		{
			$user_type="Nonphysician";
		}	
			
		if($this->input->post('action')=="Login")
		{	

			$this->form_validation
			->set_rules('email_address', 'Email Address', 'required|trim')
			->set_rules('password', 'Password', 'trim|required');/* |min_length[6] */

			if ($this->form_validation->run() == TRUE) // validation passed
			{
				$username =  trim(post_value('email_address'));
				$password = trim(post_value('password'));	
				$select_array = array (
					'users_id',
					'users_first_name',
					'users_email',
					'users_password',
					'users_phone',
					'users_zipcode',
					'users_status',
					'users_username',
					'user_type'
				);
			
			/* Set keep cookie value */

			if(post_value('keep_signin')=="1")
			{	
				$year = time() + 31536000; 
				setcookie('email_address', post_value('email_address'), $year);
				setcookie('password', post_value('password'), $year);
			
			} 
			else 
			{
				$time = time() - 3600;
				setcookie('email_address', post_value('email_address'), $time);
				setcookie('password', post_value('password'), $time);
			}
			$email_address_array = "users_email = '".$username."' OR users_username = '".$username."'";
			$email = $this->Mydb->get_record($select_array,$this->table,$email_address_array);
			if(empty($email)) {
					/*invalid Password*/
					$data['status'] = 'error';
					$data['msg'] = get_label ('invalid_email');
					echo json_encode($data); exit;
			} else {
			/*check by status,app_id,and email*/
			//$where_array="(users_email = '".$username."' OR users_username = '".$username."') ";
						$where_array="(users_email = '".$username."' OR users_username = '".$username."') AND user_type='".$user_type."' ";
			$check_result = $this->Mydb->get_record($select_array,$this->table,$where_array); 
			/*check result is empty*/
			if(isset($check_result) && !empty($check_result))
			{
			
				$password_verify = check_hash($password,$check_result['users_password']);
					/*check password*/
					if($password_verify == "Yes")
					{ 
							if($check_result['users_status'] == 'A')
							{		
									$session_values = array( 'users_id' => $check_result['users_id'],
															 'users_first_name'=>$check_result['users_first_name'],
															 'users_email'=>$check_result['users_email'],
															 'users_phone'=>$check_result['users_phone'],
															 'users_zipcode'=>$check_result['users_zipcode'],
															 'user_type'=>$check_result['user_type']				 
														   );									
									$this->session->set_userdata($session_values);
									
									//check user first time login or not
									$user_details_check=$this->user_mandatory_fields_check($check_result['users_id']);
								
									if($user_details_check == '1')
									{
										$data['redirect_url'] = base_url().'myaccount/editprofile';
								    }
									else
									{
										$data['redirect_url'] = base_url();
									}		

									$data['status'] = 'success';
									echo json_encode( $data); exit;
   						    } elseif($check_result['users_status'] == 'I') {
								/*invalid login detail*/
								$data['status'] = 'error';
								$data['msg'] = get_label ('admin_disabled');
								echo json_encode($data); exit;
						   } else {
								/*invalid login detail*/
								$data['status'] = 'error';
								$data['msg'] = get_label ('account_disabled');
								echo json_encode($data); exit;
						   }	
					}
					else
					{
						/*invalid Password*/
						$data['status'] = 'error';
						$data['msg'] = get_label ('invalid_password');
						echo json_encode($data); exit;
					}	
			}
			else
			{
				/*invalid username*/
				$data['status'] = 'error';
				$data['msg'] = get_label ('invalid_usertype');
				echo json_encode($data); exit;
			}
		}

			}

			else {

				$data['status'] = 'error';
				$data['msg'] = validation_errors();
				echo json_encode($data); exit;
			}
		}


		$referal = array();
		if(isset($_SERVER['HTTP_REFERER'])){
			$referal = parse_url($_SERVER['HTTP_REFERER']);
			
		}
		
		$agent_referrer="";		
		$this->load->library('user_agent');
		if ($this->agent->is_referral())
		{

			$agent_referrer=$this->agent->referrer();
		}		
		//print_r($referal); exit;
		  $login_with_type = '';

		  $data['loginurl'] = '';
 
	
	/*--------------------------------Login with Google plus----------------*/

			$data['google_authUrl'] = '';



			if ($login_with_type == '') {

			/* Include the google api php libraries */
			include_once APPPATH."third_party/google-api-php-client/Google_Client.php";
			include_once APPPATH."third_party/google-api-php-client/contrib/Google_Oauth2Service.php";

			/* Google Project API Credentials */
			//$clientId = '157027549515-orf31dc505dh2vucdmm3kafdtjarbiki.apps.googleusercontent.com';
			//$clientSecret = 'GinUfdhB7n3MDSw00Eskq3dx';
			$clientId = '157027549515-j0t1kpq7vtfrqidqeovbk6pvtfupc3tr.apps.googleusercontent.com';
			$clientSecret = '-fZZemRXFmpb60pYt2LaUs2p';
	        $redirectUrl = base_url().'account/login';

			/* Google Client Configuration
	        $gClient = new Google_Client();
			$gClient->setApplicationName('Web client 2');
	        $gClient->setClientId($clientId);
	        $gClient->setClientSecret($clientSecret);
	        $gClient->setRedirectUri($redirectUrl);
	        $google_oauthV2 = new Google_Oauth2Service($gClient);*/
	        
			$gClient = new Google_Client();
			$gClient->setApplicationName("Web client 2");
			$gClient->setClientId($clientId);
			$gClient->setClientSecret($clientSecret);
			$gClient->setRedirectUri($redirectUrl);

			// Visit https://code.google.com/apis/console?api=plus to generate your
			// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
			// $client->setClientId('insert_your_oauth2_client_id');
			// $client->setClientSecret('insert_your_oauth2_client_secret');
			// $client->setRedirectUri('insert_your_redirect_uri');
			// $client->setDeveloperKey('insert_your_developer_key');
			$google_oauthV2 = new Google_Oauth2Service($gClient);
			if(!isset($_GET['state']))
			{
				$codeing_google = explode('?code=',$_SERVER['REQUEST_URI']);
				if (isset($codeing_google[1])) {
					$gClient->authenticate($codeing_google[1]);
					$gClient->getAccessToken();
					$this->session->set_userdata('Gtoken', $gClient->getAccessToken());
					$redirectUrl=base_url().'account/login';
					redirect($redirectUrl);
				}
		    }

/*

	       if ($login_with_type == '' && isset($_REQUEST['code']) && !empty($referal) && $referal['host'] == 'accounts.google.com') {

	            $gClient->authenticate();
	            $this->session->set_userdata('Gtoken', $gClient->getAccessToken());
	            redirect($redirectUrl);
	        }*/

	        $Gtoken = $this->session->userdata('Gtoken');
	        if($Gtoken !='')
	        {
				if (!empty($Gtoken)) {
					$gClient->setAccessToken($Gtoken);
				}

				if ($gClient->getAccessToken()) {

					$user_profile = $google_oauthV2->userinfo->get();
					if(isset($user_profile['id'])) {
						$login_with_type = 'google';
					}
				} 

				else 
				{  $data['google_authUrl'] = $gClient->createAuthUrl(); }
			}
	    }
    
		/*--------------------------------Login with Google plus----------------*/
		
		/*--------------------------------Login with Fb---------------*/			    		

	  $data['loginurl'] = '';
		if ($login_with_type == '') 
		{ 	
	 	  $fb = new \Facebook\Facebook([
		  'app_id' => '1059480927495510',
		  'app_secret' => '69533fdce0610b38de78f0db13869223',
		  'default_graph_version' => 'v2.8',
		  'persistent_data_handler'=>'session',
		  'default_access_token' => '1889464241329686|e4eae3e438646d70c9800fa5acb51691', // optional
		]);

		// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
		//   $helper = $fb->getRedirectLoginHelper();
		//   $helper = $fb->getJavaScriptHelper();
		//   $helper = $fb->getCanvasHelper();
		//   $helper = $fb->getPageTabHelper();

		try {
		  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
		  // If you provided a 'default_access_token', the '{access-token}' is optional.

			$helper = $fb->getRedirectLoginHelper();
			$_SESSION['FBRLH_state']=(isset($_GET['state']))?$_GET['state']:'';
			$accessTokenEntity = new Facebook\Authentication\AccessToken('1889464241329686|e4eae3e438646d70c9800fa5acb51691');
			$accessToken = $accessTokenEntity->getValue();

			try 
			{
			  $accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) 
			{
			  // When Graph returns an error
			  //echo 'Graph returned an error: ' . $e->getMessage();
			  //exit;
			   $this->session->set_flashdata('error',$e->getMessage());
		       redirect(base_url('account/login'));
			} catch(Facebook\Exceptions\FacebookSDKException $e) 
			{
			  // When validation fails or other local issues
			  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  //exit;
			  $this->session->set_flashdata('error',$e->getMessage());
		      redirect(base_url('account/login'));
			}


			if (isset($accessToken)) 
			{
				$response = $fb->get('/me?fields=name,email,first_name,last_name,gender',  $accessToken);
					//$response = $fb->get('/me',$accessToken);
					$user_profile= $response->getGraphUser();
					if($user_profile['id'] !='') {
						$login_with_type = 'facebook';
					}
			}
			else
			{
				$permissions = ['email']; // Optional permissions
				//$loginUrl = $helper->getLoginUrl('https://uat.copperchimney.com.sg/account', $permissions);
				
				$loginUrl = $helper->getLoginUrl(base_url().'account/login', $permissions);
				$data['loginurl'] = $loginUrl;
			}
		} catch(\Facebook\Exceptions\FacebookResponseException $e) 
		{
		  // When Graph returns an error
		  //echo 'Graph returned an error: ' . $e->getMessage();
		  //exit;
		  $this->session->set_flashdata('error',$e->getMessage());
		  redirect(base_url('account/login'));
		} catch(\Facebook\Exceptions\FacebookSDKException $e) 
		{
		  // When validation fails or other local issues
		 // echo 'Facebook SDK returned an error: ' . $e->getMessage();
		 // exit;
		  $this->session->set_flashdata('error',$e->getMessage());
		  redirect(base_url('account/login'));
		}
	}
		/*--------------------------------Login with Fb---------------*/		
		
	/*---------------------Twitter start----------------------------------*/

			$data['twitter_authUrl'] = '';
			$tw_consumer_key = '9OH3BhsYRZaAqDEs1zGt9UlXE'; 
			$tw_consumer_secret = 'rfwxqgDhJ2gc5UW5PpSegJNPJx321giitLVffdlh7s1WJsHFb5';
			$tw_redirectUrl = base_url().'account/login';

			include_once APPPATH."third_party/twitter/twitteroauth.php";

			if(isset($_GET['oauth_token']) && $this->session->userdata('Twtoken') == $_GET['oauth_token']) 
			{
				/*Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name*/
				$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret, $this->session->userdata('Twtoken') , $this->session->userdata('Twtoken_secret'));
				$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
				if($connection->http_code == '200')
				{
					/*Redirect user to twitter*/
					$_SESSION['status'] = 'verified';
					$_SESSION['request_vars'] = $access_token;

					/*User Details*/
					$user_profile = $connection->get('account/verify_credentials');
					if(isset($user_profile->id)) 
					{
					$login_with_type = 'twitter';
					}
				}
			}
			else 
			{
				/*Fresh authentication*/
				$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);
				$request_token = $connection->getRequestToken($tw_redirectUrl);

				/*Received token info from twitter*/
				if(!empty($request_token)) {

					$this->session->set_userdata('Twtoken', $request_token['oauth_token']);
					$this->session->set_userdata('Twtoken_secret', $request_token['oauth_token_secret']);
				}

				/*Any value other than 200 is failure, so continue only if http code is 200*/
				if($connection->http_code == '200')
				{
					/*redirect user to twitter*/
					$data['twitter_authUrl'] = $connection->getAuthorizeURL($request_token['oauth_token']);
				}
			}
	  
		/*---------------------Twitter start----------------------------------*/		
		



		/*----------------------if login with social media---------------------------*/
		if($login_with_type != '') 
		{
			$insert_data = array();
			if($login_with_type == 'facebook') 
			{
				$social_id = 'FB'.$user_profile['id'];
				$login_username = isset($user_profile['email'])?$user_profile['email']:'';
				$data['first_name'] = $insert_data['users_first_name'] = (isset($user_profile['first_name'])?$user_profile['first_name']:'');
				$data['last_name'] = $insert_data['users_last_name'] = (isset($user_profile['last_name'])?$user_profile['last_name']:'');
			}
			elseif($login_with_type == 'google') 
			{
				$social_id = 'GO'.$user_profile['id'];
				$login_username = isset($user_profile['email'])?$user_profile['email']:'';
				$data['first_name'] = $insert_data['users_first_name'] = (isset($user_profile['given_name'])?$user_profile['given_name']:'');
				$data['last_name'] = $insert_data['users_last_name'] = (isset($user_profile['family_name'])?$user_profile['family_name']:'');
			}
			elseif ($login_with_type == 'twitter') 
			{
				$social_id = 'TW'.$user_profile->id;
				$login_username = isset($user_profile->email)?$user_profile->email:'';
				$name = explode(" ",$user_profile->name);
				$fname = isset($name[0])?$name[0]:'';
				$lname = isset($name[1])?$name[1]:'';
				$data['first_name'] = $insert_data['users_first_name'] = $fname;
				$data['last_name'] = $insert_data['users_last_name'] = $lname;
				
				//echo '<pre>';print_r($user_profile); exit;

			} 
			else 
			{
			}

			/*Common values to registration*/
			$data['su_facebookid']= $social_id;
			$data['email']= $login_username;
			
			if($login_with_type == 'twitter'){
				$check_result = $this->Mydb->custom_query_single( "SELECT * FROM rxl_users WHERE users_fb_id ='$social_id'");
			} else {
				/*check by email, and fb_id*/
				$check_result = $this->Mydb->custom_query_single( "SELECT * FROM rxl_users WHERE (users_email = '$login_username' OR users_fb_id ='$social_id' )");
			}

			/*check result is empty*/
			if(!empty($check_result))
			{	
				$check_user_status = $check_result['users_status'];
				/*check password*/
				if($check_user_status == "A")
				{
					$this->Mydb->update($this->table,array('users_id'=>$check_result['users_id']),array('users_fb_id'=>$social_id));
					
					$session_values = array( 'users_id' => $check_result['users_id']);									
					$this->session->set_userdata($session_values);
					$user_details_check=$this->user_mandatory_fields_check($check_result['users_id']);
					if($user_details_check == '1')
					{ 	
						redirect(base_url().'myaccount/editprofile'); 
					}
					else
					{ 	
						redirect(base_url());
						$this->Mydb->update($this->table,array('users_id'=>$check_result['users_id']));	
					}		
				}
				else
				{
					$msg = ($response->message!='') ? $response->message:get_label('account_disabled');
					$this->session->set_flashdata('error',$msg);
					if($login_with_type == 'facebook') 
					{
						$this->facebook->destroySession();
					} 
					elseif ($login_with_type == 'google') 
					{
						 $this->session->set_userdata('Gtoken', '');
					} 
					elseif ($login_with_type == 'twitter') 
					{
						$this->session->set_userdata('Twtoken', '');
						$this->session->set_userdata('Twtoken_secret', '');

					} 
					else 
					{
					}
					/*acount is inactive response pass user_type true*/
					redirect(base_url().'account/login');
				}

			} 
			else 
			{
				if ($login_username != '') 
				{

                    $login_password=generateRandomString();
					$customer_email	= array ('users_email' => $login_username );
					$customer_password = trim($login_password);
					$customer_fb_id = $social_id;

					/*generate activation key*/	
					//$activation_key = get_guid ( $this->table, 'users_activation_key', $customer_email );			

					$insert_array = array(
							 	'users_first_name'   	=>$insert_data['users_first_name'],
							 	'users_last_name'    	=>$insert_data['users_last_name'],
								'users_username' 		=>$login_username,							 	
							 	'users_email'	    	=>$login_username,
							 	'users_password'	    =>do_bcrypt($customer_password),
							 	'users_status'		    =>'A',
							 	'user_type'				=>'Nonphysician',
							 	'users_created_ip'		=>get_ip(),
							 	'users_created_on'		=>current_date(),
							 	//'users_activation_key'	=>$activation_key,
							 	'users_fb_id'			=>$customer_fb_id
							);

					/*Insert the custome detail*/
					$insert_id=$this->Mydb->insert($this->table,$insert_array);
					if($insert_id)
					{   
								/*Send the mail to user for activation link*/
								//$site_url = $base_url."account/activation/".$activation_key;
								$email_logo = base_url()."media/email-logo/email_rxleaf_logo.png";

								$this->load->library('myemail');

								$check_arr = array('[LOGOURL]','[NAME]','[USERNAME]','[PASSWORD]','[SITEURL]');

								$name=($insert_data['users_first_name']!='')?ucwords(strtolower(($insert_data['users_first_name']." ".$insert_data['users_last_name']))):"";
								$replace_arr = array($email_logo,$name,$login_username,$customer_password,base_url());
								
								//$email_template_id = get_emailtemplate($app_id, 'facebook-user-registration');
								$email_template_id = get_label('social_signup_template');
								if($email_template_id != '') 
								{
									$this->myemail->send_client_mail($login_username,$email_template_id,$check_arr,$replace_arr,'','');
									$this->Mydb->update($this->table,array('users_id'=>$insert_id),array('user_ft_login'=>'1'));										
								}
								
								$session_values = array('users_id' => $insert_id);						
								$this->session->set_userdata($session_values);

								$user_details_check=$this->user_mandatory_fields_check($insert_id);
								if($user_details_check == '1')
								{
									redirect(base_url().'myaccount/editprofile'); 
								}
								else
								{
									redirect(base_url());
								}
					}

				}
				elseif($insert_data['users_first_name'] != "")
				{
					$customer_email	= array ('users_username' => $insert_data['users_first_name'] );
					$customer_fb_id = $social_id;
					$insert_array = array(  'users_first_name'   	=>$insert_data['users_first_name'],
											'users_last_name'    	=>$insert_data['users_last_name'],
											'users_username'	    =>$insert_data['users_first_name'],
											'users_status'		    =>'A',
											'user_type'				=>'Nonphysician',
											'users_created_ip'		=>get_ip(),
											'users_created_on'		=>current_date(),
											'users_fb_id'			=>$customer_fb_id
										  );

					/*Insert the custome detail*/
					$insert_id=$this->Mydb->insert($this->table,$insert_array);
					
								$session_values = array('users_id' => $insert_id);						
								$this->session->set_userdata($session_values);					
					
					$user_details_check=$this->user_mandatory_fields_check($insert_id);
					if($user_details_check == '1')
					{
						redirect(base_url('myaccount/editprofile'));
					}
					else
					{
						redirect(base_url());
					}
					redirect(base_url());//if email id fields is empty to be redirect signup page
				}				
				else 
				{
					$msg = ($response->message!='') ? $response->message:get_label('email_id_not_exists');
					$this->session->set_flashdata('error',$msg);					
					if($login_with_type == 'facebook') 
					{
								$this->facebook->destroySession();
					} 
					elseif ($login_with_type == 'google') 
					{
								$this->session->set_userdata('Gtoken', '');
					} 
					elseif ($login_with_type == 'twitter') 
					{
								$this->session->set_userdata('Twtoken', '');
								$this->session->set_userdata('Twtoken_secret', '');
					} 
					else 
					{
					}
					redirect(base_url());//if email id fields is empty to be redirect signup page
				}
			}
			$data['su_facebookid']='';
			$data['loginurl'] = $this->facebook->getLoginUrl( array('redirect_uri' => site_url('account/login'), 
															  'scope' => array("email") // permissions here
															));	
		}
		/* if login with social media end*/
		 redirect(base_url());//if login error redirect	
	}

	/*user registration form function*/
	public function registration()
	{	
		$this->authentication->user_authentication_login();	
		$data = array();

		if($this->input->post('signin')=="Sign up")
		 {

		 
			$this->form_validation
					->set_rules('first_name', 'lang:first_name','required|trim')			
					->set_rules('email_address', 'lang:email_address', 'required|trim|valid_email|callback_email_exists')
					->set_rules('password', 'Password', 'trim|required|min_length[6]');	

				if($this->form_validation->run($this) == true)	
				{
					/*get the client base url for sending mail acitvation link*/
					$base_url = base_url();
					
					$customer_email	= array ('users_email' => post_value('email_address') );
					$customer_password = trim(post_value('password'));
							
					/*generate activation key*/
					$activation_key = get_guid ( $this->table, 'users_activation_key', $customer_email );
					$user_type_check=trim(post_value('users_type')); 
					if($user_type_check=="sign_Physician")
					{
						$user_type='Physician';
					}
					else
					{
						$user_type='Nonphysician';
					}	

											
					$insert_array = array(
						'users_first_name'=>post_value('first_name'),
						'users_last_name'=>post_value('last_name'),					
						'users_username'=>post_value('email_address'),
						'users_email'=>post_value('email_address'),
						'users_password'=>do_bcrypt($customer_password),
						'users_certificate_no' => post_value('certificate_no'),
						'users_status'=>'P',
						'user_type'=>$user_type,					
						'users_created_ip'=>get_ip(),
			 			'users_created_on'=>current_date(),
			 			'users_activation_key'=>$activation_key,			 			
					); 
			/*Insert the custome detail*/
					$insert_id=$this->Mydb->insert($this->table,$insert_array);
					if($insert_id)
					{

						/*Send the mail to user for activation link*/
						$site_url = $base_url."account/activation/".$activation_key;
						$email_logo = $base_url."media/email-logo/email_rxleaf_logo.png";

						$this->load->library('myemail');

						$check_arr = array('[LOGOURL]','[NAME]','[USERNAME]','[PASSWORD]','[SITEURL]','[ACTIVATION-LINK]');

						$name=($this->input->post('first_name')!='')?ucwords(strtolower(($this->input->post('first_name')." ".$this->input->post('last_name')))):"";
					$replace_arr = array($email_logo,$name,$this->input->post('email_address'),$customer_password,$site_url,$base_url);

						$email_template_id = get_label('signup_template');

						if($email_template_id != '') 
						{
							$this->myemail->send_client_mail(   $this->input->post('email_address'),
																$email_template_id,
																$check_arr,
																$replace_arr,'', '');
						} 
					}
					if(!empty($insert_id)){

							$data['status'] = 'success';
							$data['msg'] = get_label('acount_created');
							$data['url'] = base_url('account/login');
							echo json_encode( $data); exit;
					}
					else
					{
						$data['status'] = 'error';
						$data['msg'] = 'Something went wrong';
						echo json_encode($data); exit;
					}
				}
				else
				{
					$data['status'] = 'error';
					$data['msg'] = validation_errors ();
					echo json_encode($data); exit;
		
				}
			}
			$data['meta_title']  =  get_meta_title("Sign up");	 
				   
						$data['status'] = 'error';
						$data['msg'] = 'Something went wrong';
						echo json_encode($data); exit;
	}

     /*activate the user by email*/
    public function activation()
	{
		$this->authentication->user_authentication_login();		
		/* activate user accounts */
		$activation = $data =  array();
		$activation = $this->uri->uri_to_assoc(2);

		if(!empty($activation) && isset($activation['activation']) && $activation['activation'] !="" )
		{
			$auth_key = trim(urldecode($activation['activation']));
			
			$activations=array('key'=>$auth_key);

			/* Input Validation */
			if(!empty($activations['key']))
			{	
						
				$get_user_data = $this->Mydb->get_record(array('users_id','users_status'),$this->table,array('users_activation_key'=>$activations['key'],'users_status'=>'P'));

				/*check valid key*/
				if(!empty($get_user_data))
				{	
					/*activate the user*/
					$this->Mydb->update($this->table,array('users_id'=>$get_user_data['users_id']),array('users_status'=>'A','users_activation_key'=>''));
					$this->session->set_flashdata('popup_alert','open');					
					$this->session->set_flashdata('account_success_msg',get_label('acount_activated'));
				  	redirect(base_url());
				}
				else
				{
					/*invalid key message*/
					$this->session->set_flashdata('popup_alert','open');						
					$this->session->set_flashdata('account_error_msg',get_label('acount_link_expired'));
					redirect(base_url());
				}	
			}
		}
	}


	/* this method used to reset ur account */
	function forgotpassword()
	{
		$this->authentication->user_authentication_login();
		$data = array();
		if($this->input->post('forgot')=="Send")
		{	
			$this->form_validation
			->set_rules('forgot_email_address', 'Email Address', 'required|trim|valid_email');
				if ($this->form_validation->run($this) == TRUE) // validation passed
				{
					$base_url = base_url();
					$email_address = trim(post_value('forgot_email_address')); 

					$user = $this->Mydb->get_record(array('users_id','users_first_name','users_last_name','users_email','users_status'),$this->table,array('users_email' => $email_address));
					if(!empty($user))
					 {
							if( $user['users_status'] == "A")
							{ 
								/*send the activation link to user*/
								$users_array = array ('users_email' => $user['users_email'] );

								$forgot_key = get_guid ( $this->table, 'users_forgot_key', $users_array ); 

								$this->Mydb->update($this->table,array('users_id'=>$user['users_id']),array('users_forgot_key'=>$forgot_key));

								$site_url =  $base_url."account/resetpassword/".$forgot_key;

								$email_logo = $base_url."media/email-logo/email_rxleaf_logo.png";

								$this->load->library('myemail');

								$check_arr = array('[LOGOURL]','[NAME]','[RESETLINK]','[BASEURL]');

								$name=!empty($user['users_first_name'])?ucwords(strtolower(($user['users_first_name']." ".$user['users_last_name']))):"User";

								$replace_arr = array($email_logo,$name,$site_url,$base_url);
				                        
								//$email_template_id = get_emailtemplate($app_id, 'user-forgotpassword');
								$email_template_id = get_label('forgot_template');

								if($email_template_id != '') {
									


									$check=$this->myemail->send_client_mail(
												$user['users_email'],
												$email_template_id,
												$check_arr,
												$replace_arr,
												'',
												'');
						
								}

							$data['status'] = 'success';
							$data['msg'] = get_label ('reset_password_link');
							echo json_encode( $data); exit;	

						    }
						    else
							{
							$data['status'] = 'error';
							$data['msg'] = get_label('account_disabled');
							echo json_encode( $data); exit;		
						    }
						}
						else
						{
							/*email not found message*/
							$data['status'] = 'error';
							$data['msg'] = get_label('forgot_error');
							echo json_encode( $data); exit;		
						}
					 }
				  else
					{
						/*email not found message*/
						$data['status'] = 'error';
						$data['msg'] = validation_errors ();
						echo json_encode( $data); exit;		
					}
					
				} 

			$data['meta_title']  =  get_meta_title("Forgot Password");
			//$this->template->set_data ($data);
			//$this->template->load('forgot',$data);
			if(isset($data))
			{
				    $res['view_page'] = $this->load->view('account/forgot',$data,true);				
				    $res['status'] = 'success';									
			}
			else
			{
					$res['view_page']='';
					$res['status'] = 'fail';
			}
	   echo json_encode($res);
	   exit;			
		}

	/* this method used to reset password..*/
	function resetpassword($resetpassword_key=null)
	{
		 $resetpassword_key = $resetpassword_key;
		 $where_array=array('users_forgot_key'=>$resetpassword_key);
		 $totla_rows = $this->Mydb->get_num_rows ('users_forgot_key',$this->table, $where_array,'', '', '', '', '' );	

		 	 
		 if($totla_rows == "1")
		 {
			 $this->session->set_userdata('resetpassword_key', $resetpassword_key);		 
			 if($resetpassword_key != '')
			 {	
				 
				/* reset password */
				if($this->input->post('Submit') == 'Submit')
				{	
					$this->form_validation
					->set_rules('reset_pass', 'New Password', 'trim|required|min_length[6]')
					->set_rules('reset_cpass', 'Confirm Password', 'trim|required|min_length[6]|matches[reset_pass]');

					if ($this->form_validation->run($this) == TRUE) // validation passed
					{	
							$password   = trim($this->input->post('reset_pass'));
							/*check valid key*/		
							$get_customer_data = $this->Mydb->get_record(array('users_id'),$this->table,array('users_forgot_key'=>$resetpassword_key));

							if(!empty($get_customer_data))
							{
								/*update new password*/
								$newpassword=do_bcrypt($password);

								$this->Mydb->update($this->table,array('users_id'=>$get_customer_data['users_id']),array('users_password'=>$newpassword,'users_forgot_key'=>''));
								$this->session->set_userdata('resetpassword_key', '');/*resetpassword_key to be empty */
								/*success message*/
								$data['status']='success';
								$data['msg']=get_label('changed_password');
								echo json_encode( $data); exit;	
							}
							else
							{
								/*Invalid key*/
								$data['status']='error';
								$data['msg']=get_label('password_link_expired');
								echo json_encode( $data); exit;	
							}

					 }
					 else
					 {
						$data['status']='error';
						$data['msg']=validation_errors ();
						echo json_encode( $data); exit;						

					 }
				}
				
				$data['meta_title']  =  get_meta_title("Forgot Password");
				$data['reset_key']  =  $resetpassword_key;
				$this->session->set_flashdata('popup_alert','open_reset');
				redirect(base_url());			
			 }
			 else 
			 {
			    $this->session->set_flashdata('account_error_msg',get_label('password_link_expired'));
				$this->session->set_flashdata('popup_alert','open_reset');
				redirect(base_url());				
			 }
	   }
	   else 
	   {
			$this->session->set_flashdata('account_error_msg',get_label('password_link_expired'));
			$this->session->set_flashdata('popup_alert','open_reset');
			redirect(base_url());			
	   }	 
	}

	/* this function used to clear all user session values */
	function logout()
	{
		$this->session->unset_userdata('users_id');
		session_destroy();
		redirect(base_url());
	}	 
	
	/*Check phone no exist*/
	public function userphoneno_exists() 
	{
		$users_phone = trim($this->input->post ( 'phone_no' ));

		$where = array ('users_phone' => trim ( $users_phone ));
		
		$result = $this->Mydb->get_record ( 'users_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'userphoneno_exists', get_label('userphone_exists') );
			return false;
		} else {
			return true;
		}
	}	

	/*Check username no exist*/
	public function username_exists() 
	{
		$users_name = trim($this->input->post ( 'username' ));

		$where = array ('users_username' => trim ( $users_name ));
		
		$result = $this->Mydb->get_record ( 'users_id', $this->table, $where );
		if (! empty ( $result )) 
		{
			$this->form_validation->set_message ( 'username_exists', get_label('username_exists') );
			return false;
		} 
		else
		{
			return true;
		}
	}	

	/* this method used to check email validation - callback function.. */
	public function email_exists($emailaddress=null)
	{	
		$emailaddress = trim(addslashes($emailaddress));
		/** input from post method  **/
		if($this->input->post('email_address') != '')
		{
			$customer_email = $this->input->post ( 'email_address' );
		}
		$where = array ( 'users_email' => trim ( $emailaddress ));

		$result = $this->Mydb->get_record ('users_id', $this->table, $where );
		if (! empty ( $result )) 
		{
			$this->form_validation->set_message('email_exists', 'This email already exists in our system, please try to reset password');
			return false;
		} 
		else 
		{
			return true;
		}
	}
	public function user_mandatory_fields_check($users_id=null)
	{
		
		$where=array();
		$where = "( `users_id` ='".$users_id."' and `users_status` = 'A' and  (`users_first_name` ='' or `users_email`='' or `users_profession`='' or `user_type` =''))";
		$result = $this->Mydb->get_num_rows('*',$this->table,$where );	
		return $result;
   }		

}
