<?php 
/************************************************
Project Name	: 
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: This class contains registration, Login, Reset password
**************************************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('mcurl');
		$this->module = 'viewer';
		$this->module_label = get_label('admin_label');
		$this->module_labels =  get_label('admin_labels');		
		$this->folder = "viewer/";
		$post_data = json_decode(trim(file_get_contents('php://input')), true);
		if(!empty($post_data))
		{
			$_POST=array_merge($_POST, $post_data);
		}

		$user_type_id = $this->session->userdata('user_type_id');
		if($user_type_id!='' && $user_type_id != '3')
		{
	    	$this->load->model('users_model');
			$response = $this->users_model->login_track_destroy();	
			//redirect('admin', 'refresh');
		}

	}

	public function index()
	{
		$data = $this->load_module_info();
				$this->load->model('event_model');
				$this->load->model('causes_model');
				$this->load->model('donar_model');

			$home_causes_lists=$this->causes_model->home_page_causes_list();
			$data['home_causes_lists']=($home_causes_lists['status_id']) ? $home_causes_lists['result_set'] : array();
			
			$event_lists=$this->event_model->event_list();
			$data['event_lists']=($event_lists['status_id']) ? $event_lists['result_set'] : array();


			$donar_lists=$this->donar_model->top_donar_list();
			$data['donar_lists']=($donar_lists['status_id']) ? $donar_lists['result_set'] : array();

		$data['title'] = $data['form_heading'] = "Home";//get_label('admin_heading').' '.$this->module_label;
		$this->load->view($this->folder.$this->module.'_home', $data);
	}
   
    function faq()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "FAQ";
		$_POST['cmspage_slug'] = 'faq';

		$this->load->view($this->folder.'faq_view', $data);	
    }

    function aboutus()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "About Us";
		$_POST['cmspage_slug'] = 'about_us';

		$this->load->view($this->folder.$this->module.'_about_us', $data);	
    }

    function contactus()
    {
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); 
			
			$this->form_validation->set_rules ( 'enquiry_name', 'lang:enquiry_name', 'required' )
			->set_rules ( 'enquiry_email', 'lang:email', 'required' )
			->set_rules ( 'enquiry_phone', 'lang:phone', 'required' )
			->set_rules ( 'enquiry_comment', 'lang:message', 'required' );
			
			if ($this->form_validation->run () == TRUE) {

				$insert_array = array (
						'enquiry_name' => post_value ( 'enquiry_name' ),
						'enquiry_email' => post_value ( 'enquiry_email' ),
						'enquiry_phone'=>post_value ( 'enquiry_phone' ),
						'enquiry_comment'=>post_value ( 'enquiry_comment' ),
						'enquiry_created_on' => current_date (),
						'enquiry_created_ip' => get_ip (),
 				);
				//print_r($insert_array);
				$insert_id = $this->Mydb->insert ( 'tbl_enquiry', $insert_array );
				$result ['status'] = 'success';
				$result ['message'] = sprintf ( $this->lang->line ( 'success_message_add' ), 'Enquiry' );
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}

		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Contact Us";
		$_POST['cmspage_slug'] = 'contact_us';

		$this->load->view($this->folder.$this->module.'_contact_us', $data);
    }
    function visionmission()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Contact Us";
		$_POST['cmspage_slug'] = 'contact_us';

		$this->load->view($this->folder.$this->module.'_vision_mission', $data);
    }
    function volunteer()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Volunteer";
		$_POST['cmspage_slug'] = 'contact_us';

		$this->load->view($this->folder.$this->module.'_volunteer', $data);
    }    
    function terms()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Terms & Conditions";
		$_POST['cmspage_slug'] = 'terms_n_conditions';

		$this->load->view($this->folder.'terms_view', $data);	
    }

    function privacy_policy()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Privacy Policy";
		$_POST['cmspage_slug'] = 'privacy_policy';

		$this->load->view($this->folder.'privacy_policy_view', $data);	
    }

	function services()
    {
		$data = $this->load_module_info();
		$data['title'] = $data['form_heading'] = "Services We Do";
		$_POST['cmspage_slug'] = 'services';
	
		$this->load->view($this->folder.$this->module.'_services', $data);
    }

	/* this method used to common module labels */
	function load_module_info() 
	{
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
    
}
