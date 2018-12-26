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
		$this->module_label = get_label('event_label');
		$this->module_labels =  get_label('event_labels');		
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
   function registration()
     {
	        $data = array();
	        /* form submit */
	        if ($this->input->post ( 'action' ) == "Add") {
	            check_ajax_request (); 
	        $this->form_validation->set_rules ( 'donar_event_team_name', 'lang:donar_event_team_name', 'required|trim' )
	        ->set_rules ( 'donar_college_name', 'lang:donar_college_name', 'trim' )
	        ->set_rules ( 'donar_first_name', 'lang:donar_first_name', 'required' )
	        ->set_rules ( 'donar_last_name', 'lang:donar_last_name', 'trim|required' )
	        ->set_rules ( 'donar_email_address', 'lang:donar_email_address', 'required|trim' )
	        ->set_rules ( 'donar_mobile_no', 'lang:donar_mobile_no', 'required|trim' )
	        ->set_rules ( 'donar_alternative_contact_no', 'lang:donar_alternative_contact_no', 'required|trim' )
	        ->set_rules ( 'donar_address', 'lang:donar_address', 'trim' )
	        ->set_rules ( 'donar_city', 'lang:donar_city', 'required|trim' )
	        ->set_rules ( 'donar_zip_postal_code', 'lang:donar_zip_postal_code', 'required|trim' )
	        ->set_rules ( 'donar_country', 'lang:donar_country', 'required|trim' )
	        ->set_rules ( 'event_register_member_name[]', 'lang:event_register_member_name', 'required|trim' )
	        ->set_rules ( 'donar_image', 'lang:donar_image', 'trim' )
	        ->set_rules ( 'status', 'lang:status', 'trim' );
	        
	        if ($this->form_validation->run ($this) == TRUE) {
					$event_id=decode_value(post_value('event_id'));
            		$refer_id= random_string('alnum',6);

	                $insert_array = array (
                                        'donar_event_team_name'=>post_value('donar_event_team_name'),
                                        'donar_refer_id'=>$refer_id,
	                					'donar_first_name' => post_value('donar_first_name'),
                                        'donar_last_name'=>post_value('donar_last_name'),
                                        'donar_email_address' => post_value('donar_email_address'), 
                                        'donar_contact_no' => post_value('donar_mobile_no'),
                                        'donar_alternative_contact_no' => post_value('donar_alternative_contact_no'),
                                        'donar_address' => post_value('donar_address'),
                                        'donar_city' => post_value('donar_city'),
                                        'donar_zip_postal_code' => post_value('donar_zip_postal_code'),
                                        'donar_country' => post_value('donar_country'),
                                        'donar_from' => 'event',
                                        'donar_causes_event_id' => $event_id,
                                        'donar_ip' => get_ip (),
                                        'donar_created_on' => current_date()
	                    				);
	                    if (isset ( $_FILES ['donar_image'] ['name'] )) 
	                    {
	                     	$insert_array['donar_profile_image']=$this->do_multi_upload('donar_image');
	                    }
	                 $insert_id = $this->Mydb->insert ( 'causes_donars', $insert_array );
	                 if($insert_id)
	                 {
	                 	$event_register_member_name=$this->input->post('event_register_member_name');
	                 	if(!empty($event_register_member_name))
	                 	{
		                 	foreach ($event_register_member_name as $key => $value) 
		                 	{
			                	$reg_insert_array[] = array (
		                                        'participation_event_id'=>$event_id,
		                                        'participation_donar_id'=>$insert_id,
		                                        'participation_name'=>$value,
			                    				);	                 	
		                 	}
		                 	$insert_id = $this->Mydb->insert_batch('event_participations', $reg_insert_array );
	                 	}
	                 	
	                 }
	                $result ['status'] = 'success';
	                $admin_setting=get_admin_setting();
					$support_contact_no =$admin_setting['settings_contact_no']." , ".$admin_setting['settings_alter_contact_no'];
					$check_array = array('[REFERID]','[SUPPORT_CONTACT_NO]');
					$replace_array = array($refer_id,$support_contact_no);
	                $temp_message=sprintf ( $this->lang->line ( 'success_message_registration' ));
					$message = str_replace($check_array, $replace_array, $temp_message);

	                 $result ['message'] = $message;//,$this->module_label
	                echo json_encode ( $result );
	                exit();
	            } 
	            else 
	            {
	                $result ['status'] = 'error';
	                $result ['message'] = validation_errors ();
	                echo json_encode ( $result );
	                exit();
	            }
	        }
	        else
	        {
	            $result ['status'] = 'error';
	            $result ['message'] = 'error';            
	            echo json_encode ( $result );
	            exit();
	        }
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