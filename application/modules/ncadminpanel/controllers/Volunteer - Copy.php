<?php
/**************************
Project Name	: Weforyou
Created on		: 03 Feb, 2018
Last Modified 	: 03 Feb, 2018
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Volunteer extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->load->library ( 'common' );
		$this->module_label = get_label('volunteer_manage_label');
		$this->module_labels =  get_label('volunteer_manage_labels');
		$this->module = "volunteer";
		$this->folder = "volunteer/";
		$this->table = "volunteer";
		$this->primary_key = 'volunteer_id';
		$this->status = 'volunteer_status';
	}
	
	/* this method used to list all records . */
	public function index() {
		$data = $this->load_module_info ();	
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}

	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) 
	{
		check_ajax_request(); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$having ="";
		$having1="";
		$having2="";	
		$queryvar="";	
		$where_in = "";
		$or_where = array ();
		$where = array ( " $this->primary_key !=" => '');
		$order_by = array ($this->primary_key => 'DESC');
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
			//$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_search_status", $this->input->post('status') );
		}

		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
			
		}
		/* filter by status */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					$this->status => get_session_value ( $this->module . "_search_status" )
			) );
		//	print_r($where); exit;
		}
		
		 /* add sort bu option */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") 
		{	
			$order_by = array ( get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" );
		}
		
		if($having!='') {
           $this->db->having($having);
         }
         if($having1!='') {
           $this->db->having($having1);
         }

		$join = ''; 
        
		$groupby = $this->primary_key;	
		
		$totla_rows = $this->Mydb->get_num_rows($this->table.'.*', $this->table, $where,'','','',$like);

		/* pagination part start  */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;  
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		if($having!='') {
           $this->db->having($having);
         }
         if($having1!='') {
           $this->db->having($having1);
         }
		/* pagination part end */

		$data ['records'] = $this->Mydb->get_all_records ($this->table.'.*',$this->table,$where,$limit,$offset,$order_by,$like,'',$join);

	// echo $this->db->last_query();
	// exit;
		$page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records']))  ? 'Yes' : 'No';
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'page_reload' => $page_relod,
				'html' => $html 
		) );
		exit ();
	}
	
	/* this method used check email alredy exists or not */
	public function volunteer_name_exists() {
		$volunteer_name = $this->input->post ( 'volunteer_name' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'volunteer_name' => trim ( $volunteer_name ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"$this->primary_key !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( $this->primary_key, $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'volunteer_name_exists', get_label ( 'volunteer_name_exists' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check email alredy exists or not */
	public function volunteer_email_exists() {
		$volunteer_email = $this->input->post ( 'volunteer_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'volunteer_email' => trim ( $volunteer_email ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"$this->primary_key !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( $this->primary_key, $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'volunteer_email_exists', get_label ( 'volunteer_email_exists' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check email alredy exists or not */
	public function volunteer_mobile_no_exists() {
		$volunteer_mobile_no = $this->input->post ( 'volunteer_mobile_no' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'volunteer_mobile_no' => trim ( $volunteer_mobile_no ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"$this->primary_key !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( $this->primary_key, $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'volunteer_mobile_no_exists', get_label ( 'volunteer_mobile_no_exists' ) );
			return false;
		} else {
			return true;
		}
	}

	/* this method used to add record . */
	public function add() {
		$data = $this->load_module_info ();
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); 
			
			$this->form_validation->set_rules ( 'volunteer_name', 'lang:volunteer_name', 'required|callback_volunteer_name_exists' )
			->set_rules ( 'volunteer_mobile_no', 'lang:volunteer_mobile_no', 'required|callback_volunteer_mobile_no_exists' )
			->set_rules ( 'volunteer_email', 'lang:volunteer_email', 'required|callback_volunteer_email_exists' )
			->set_rules ( 'volunteer_gender', 'lang:volunteer_gender', 'required' )
			->set_rules ( 'volunteer_age', 'lang:volunteer_age', 'required' )
			->set_rules ( 'volunteer_address', 'lang:volunteer_address', 'required' )
			->set_rules ( 'volunteer_way_to_contact', 'lang:volunteer_way_to_contact', 'required' )
			->set_rules ( 'volunteer_area_of_interest', 'lang:volunteer_area_of_interest', 'required' )
			->set_rules ( 'volunteer_previous_experience', 'lang:volunteer_previous_experience', 'required' )
			->set_rules ( 'volunteer_exp_if_yes_where', 'lang:volunteer_exp_if_yes_where', 'required' )
		->set_rules('volunteer_passionate_social_service','lang:volunteer_passionate_social_service','required' )
			->set_rules ( 'volunteer_profile_image', 'lang:volunteer_profile_image', 'trim' )
			->set_rules ( 'status', 'lang:status', 'required' );
			
			if ($this->form_validation->run () == TRUE) {

				$insert_array = array (
						'volunteer_name' => post_value ( 'volunteer_name' ),
						'volunteer_mobile_no' => post_value ( 'volunteer_mobile_no' ),
						'volunteer_email'=>post_value ( 'volunteer_email' ),
						'volunteer_gender'=>post_value ( 'volunteer_gender' ),
						'volunteer_age'=>post_value ( 'volunteer_age' ),
						'volunteer_address'=>post_value ( 'volunteer_address' ),
						'volunteer_way_to_contact'=>post_value ( 'volunteer_way_to_contact' ),
						'volunteer_area_of_interest'=>post_value ( 'volunteer_area_of_interest' ),
						'volunteer_previous_experience'=>post_value ( 'volunteer_previous_experience' ),
						'volunteer_exp_if_yes_where'=>post_value ( 'volunteer_exp_if_yes_where' ),
						'volunteer_passionate_social_service'=>post_value ( 'volunteer_passionate_social_service'),
						'volunteer_profile_image'=>post_value ( 'volunteer_profile_image'),
						'volunteer_status' => ($this->input->post ( 'status' ) == "1" ? '1' : '0'),
						'volunteer_created_on' => current_date (),
						'volunteer_created_ip' => get_ip (),
						'volunteer_updated_by' => get_admin_id (),
 				);
				//print_r($insert_array);
				$insert_array['volunteer_profile_image']=$this->do_multi_upload('volunteer_profile_image');
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				$result ['status'] = 'success';
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = get_label ( 'add' );
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {


		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();
		
		$record = $this->Mydb->get_all_join_records ( '*', $this->table, array (
				$this->primary_key => $id,
		),'','','','','','' );
		$record = $record[0];
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */

			$this->form_validation->set_rules ( 'volunteer_name', 'lang:volunteer_name', 'required|callback_volunteer_name_exists' )
			->set_rules ( 'volunteer_mobile_no', 'lang:volunteer_mobile_no', 'required|callback_volunteer_mobile_no_exists' )
			->set_rules ( 'volunteer_email', 'lang:volunteer_email', 'required|callback_volunteer_email_exists' )
			->set_rules ( 'volunteer_gender', 'lang:volunteer_gender', 'required' )
			->set_rules ( 'volunteer_age', 'lang:volunteer_age', 'required' )
			->set_rules ( 'volunteer_address', 'lang:volunteer_address', 'required' )
			->set_rules ( 'volunteer_way_to_contact', 'lang:volunteer_way_to_contact', 'required' )
			->set_rules ( 'volunteer_area_of_interest', 'lang:volunteer_area_of_interest', 'required' )
			->set_rules ( 'volunteer_previous_experience', 'lang:volunteer_previous_experience', 'required' )
			->set_rules ( 'volunteer_exp_if_yes_where', 'lang:volunteer_exp_if_yes_where', 'required' )
		->set_rules('volunteer_passionate_social_service','lang:volunteer_passionate_social_service','required' )
			->set_rules ( 'volunteer_profile_image', 'lang:volunteer_profile_image', 'trim' )
			->set_rules ( 'status', 'lang:status', 'required' );
			
			if ($this->form_validation->run () == TRUE) {

				$insert_array = array (
						'volunteer_name' => post_value ( 'volunteer_name' ),
						'volunteer_mobile_no' => post_value ( 'volunteer_mobile_no' ),
						'volunteer_email'=>post_value ( 'volunteer_email' ),
						'volunteer_gender'=>post_value ( 'volunteer_gender' ),
						'volunteer_age'=>post_value ( 'volunteer_age' ),
						'volunteer_address'=>post_value ( 'volunteer_address' ),
						'volunteer_way_to_contact'=>post_value ( 'volunteer_way_to_contact' ),
						'volunteer_area_of_interest'=>post_value ( 'volunteer_area_of_interest' ),
						'volunteer_previous_experience'=>post_value ( 'volunteer_previous_experience' ),
						'volunteer_exp_if_yes_where'=>post_value ( 'volunteer_exp_if_yes_where' ),
						'volunteer_passionate_social_service'=>post_value ( 'volunteer_passionate_social_service'),
						'volunteer_profile_image'=>post_value ( 'volunteer_profile_image'),
						'volunteer_status' => ($this->input->post ( 'status' ) == "1" ? '1' : '0'),
						'volunteer_created_on' => current_date (),
						'volunteer_created_ip' => get_ip (),
						'volunteer_updated_by' => get_admin_id (),
 				);
				if (isset ( $_FILES ['volunteer_profile_image'] ['name'] ) && $_FILES [$file_name] ['name'] != "")
				{ 
					$update_array['volunteer_profile_image']=$this->do_multi_upload('volunteer_profile_image');
				}
				$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $record[$this->primary_key] ), $update_array );

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		
		$data ['records'] = $record;
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[$this->primary_key] );
		
		$this->layout->display_admin( $this->folder . $this->module . '-edit', $data );
	}

	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		/* Delete */
		//$wherearray=array('customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id());
		$wherearray=array();
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			if (is_array ( $ids )) {
				$this->Mydb->delete_where_in($this->table,$this->primary_key,$ids,array());
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {
				$this->Mydb->delete($this->table,array($this->primary_key=>$ids));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		$where_array = array ();
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
				"volunteer_status" => '1',
				"volunteer_created_on" => current_date (),
				'volunteer_updated_by' => get_admin_id (),
				'volunteer_updated_ip' => get_ip () 				
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
				"volunteer_status" => '0',
				"volunteer_updated_on" => current_date (),
				'volunteer_updated_by' => get_admin_id (),
				'volunteer_updated_ip' => get_ip ()				
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		echo json_encode ( $response );
		exit ();
	}
	public function do_multi_upload($file_name='')
	{
					$table_cause_file_array=array('file_name'=>'');	
					if (isset ( $_FILES [$file_name] ['name'] ) && $_FILES [$file_name] ['name'] != "") 
					{
						$config['upload_path']=FCPATH ."media/images/volunteer/";
						$config['allowed_types']='gif|jpg|jpeg|pjpeg|x-png|png';
						$config['max_size']     = '3072';						
						$config['encrypt_name']=true;
						$config['remove_spaces']=true;					
						$this->load->library('upload',$config);	
						if(!$this->upload->do_upload($file_name))
						{
							$error=$this->upload->display_errors();						
							$response = array("status"=>"error","message"=>$error);
							echo json_encode($response); 
							exit;												
					    }
					    else
					    {
		                    $image_data = $this->upload->data();//store the file info
		                    $config['image_library'] = 'gd2';
		                    $config['source_image'] = $image_data['full_path']; //get original image
		                    $config['create_thumb'] = FALSE;
		                    $config['maintain_ratio'] = TRUE;
		                    $config['width'] = 270;
		                    $config['height'] = 221;

		                    $this->load->library('image_lib', $config);
		                    if (!$this->image_lib->resize()) 
		                    {
								$error=$this->image_lib->display_errors();						
								$response = array("status"=>"error","message"=>$error);
								echo json_encode($response); 
								exit;		            
		                    }
		                     $this->image_lib->clear();

							$table_cause_file_array['status']='success';
							$table_cause_file_array['file_name']=$image_data['file_name'];
					    }
					}				
				return $table_cause_file_array['file_name'];
	}
	/* this method used to view content...*/
	public function view($view_id) {
		
		$data = $this->load_module_info ();
		$data['result'] = $this->Mydb->get_record('*',$this->table,array($this->primary_key => decode_value($view_id)));
		// print_r($data);
		// exit;
		$this->load->view($this->folder."/".$this->module."-view",$data);
	}	
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );

		redirect ( admin_url () . $this->module );
	}
	

	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	
	
}
