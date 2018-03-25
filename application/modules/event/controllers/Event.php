<?php 
/************************************************
Project Name	: 
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: This class contains registration, Login, Reset password
**************************************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('mcurl');
		$this->load->model('event_model');
		$this->folder = "event/";
		$this->module = 'event';
		$this->module_label = get_label('admin_label');
		$this->module_labels =  get_label('admin_labels');		
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
		}
	}
	public function index($event_id='')
	{
		$this->load->model('event_model');
		$data = $this->load_module_info();

		$data['title'] = $data['form_heading'] = "Event";//get_label('admin_heading').' '.$this->module_label;
		if($event_id != '')
		{
			$data['event_id']=$event_id;
			$event_details=$this->event_model->event_details($event_id);
			$data['event_details']=($event_details['status_id']) ? $event_details['result_set'] : array();
			$this->load->view($this->folder.$this->module.'_list', $data);
		}
		else
		{
			$event_lists=$this->event_model->event_list();
			$data['event_lists']=($event_lists['status_id']) ? $event_lists['result_set'] : array();
			$this->load->view($this->folder.$this->module.'_list', $data);
		}
	}
   function status($trans_id=0)
     {
		$data['trans_id']=$trans_id;
		$transaction_details=$this->donation_model->get_transaction_details($trans_id);
		$data['transaction_details']=$transaction_details;
        $this->load->view($this->folder.$this->module.'_payment_status',$data);
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
?>