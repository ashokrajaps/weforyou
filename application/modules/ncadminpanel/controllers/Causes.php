<?php
/**************************
Project Name	: Weforyou
Created on		: 03 Feb, 2018
Last Modified 	: 03 Feb, 2018
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Causes extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->load->library ( 'common' );
		$this->module_label = get_label('causes_manage_label');
		$this->module_labels =  get_label('causes_manage_labels');
		$this->module = "causes";
		$this->folder = "causes/";
		$this->table = "causes";
		$this->table_cause_file = "causes_attachment";
		$this->primary_key = 'causes_id';
		$this->causes_status = 'causes_status';
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
				$this->causes_status => get_session_value ( $this->module . "_search_status" )
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
	public function causes_title_exists() {
		$causes_title = $this->input->post ( 'causes_title' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
			'causes_title' => trim ( $causes_title ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
				"$this->primary_key !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( $this->primary_key, $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'causes_title_exists', get_label ( 'causes_title_exists' ) );
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
			
			$this->form_validation->set_rules ( 'causes_title', 'lang:causes_title', 'required|callback_causes_title_exists' )
			->set_rules ( 'causes_description', 'lang:causes_description', 'required' )
			->set_rules ( 'causes_budget', 'lang:causes_budget', 'required' )
			->set_rules ( 'causes_is_volunteers_needed', 'lang:causes_is_volunteers_needed', 'required' )
			->set_rules ( 'causes_is_donation_need', 'lang:causes_is_donation_need', 'required' )
			->set_rules ( 'status', 'lang:status', 'required' );
			if (!isset ( $_FILES ['causes_image'] ['name'] )) 
			{
				$this->form_validation->set_rules ( 'causes_image', 'lang:causes_image', 'required|trim' );
			}

			if ($this->form_validation->run () == TRUE) {

				$insert_array = array (
					'causes_title' => post_value ( 'causes_title' ),
					'causes_description' => post_value ( 'causes_description' ),
					'causes_budget'=>post_value ( 'causes_budget' ),
					'causes_is_volunteers_needed'=>post_value ( 'causes_is_volunteers_needed' ),
					'causes_how_much_volunteers_need'=>post_value ( 'causes_how_much_volunteers_need' ),
					'causes_is_donation_need'=>post_value ( 'causes_is_donation_need' ),
					'causes_how_much_donation_need'=>post_value ( 'causes_how_much_donation_need' ),
					'causes_show_home_page' => ($this->input->post ( 'causes_show_home_page' ) == "yes" ? 'yes' : 'no'),
					'causes_status' => ($this->input->post ( 'status' ) == "1" ? '1' : '0'),
					'causes_created_on' => current_date (),
					'causes_created_ip' => get_ip (),
					'causes_updated_by' => get_admin_id (),
				);
				if (isset ( $_FILES ['causes_image'] ['name'] ) && $_FILES ['causes_image'] ['name'] != "") 
				{
					$insert_array['causes_image']=$this->do_multi_upload('causes_image');//to upload file
				}
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
			$this->form_validation->set_rules ( 'causes_title', 'lang:causes_title', 'required|callback_causes_title_exists' )
			->set_rules ( 'causes_description', 'lang:causes_description', 'required' )
			->set_rules ( 'causes_budget', 'lang:causes_budget', 'required' )
			->set_rules ( 'causes_is_volunteers_needed', 'lang:causes_is_volunteers_needed', 'required' )
			->set_rules ( 'causes_is_donation_need', 'lang:causes_is_donation_need', 'required' )
			->set_rules ( 'status', 'lang:status', 'required' );
			
			if ($this->form_validation->run () == TRUE) {

				$update_array = array (
					'causes_title' => post_value ( 'causes_title' ),
					'causes_description' => post_value ( 'causes_description' ),
					'causes_budget'=>post_value ( 'causes_budget' ),
					'causes_is_volunteers_needed'=>post_value ( 'causes_is_volunteers_needed' ),
					'causes_how_much_volunteers_need'=>post_value ( 'causes_how_much_volunteers_need' ),
					'causes_is_donation_need'=>post_value ( 'causes_is_donation_need' ),
					'causes_how_much_donation_need'=>post_value ( 'causes_how_much_donation_need' ),
					'causes_show_home_page' => ($this->input->post ( 'causes_show_home_page' ) == "yes" ? 'yes' : 'no'),
					'causes_status' => ($this->input->post ( 'status' ) == "1" ? '1' : '0'),
					'causes_updated_on' => current_date (),
					'causes_updated_ip' => get_ip (), 
					'causes_updated_by' => get_admin_id (), 
				);
				if (isset ( $_FILES ['causes_image'] ['name'] ) && $_FILES ['causes_image'] ['name'] != "") 
				{
					$update_array['causes_image']=$this->do_multi_upload('causes_image');//to upload file
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
		$where_array = array ('causes_status != 2'=> NULL);
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
				"causes_status" => '1',
				"causes_updated_on" => current_date (),
				'causes_updated_by' => get_admin_id (),
				'causes_updated_ip' => get_ip () 				
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
				"causes_status" => '0',
				"causes_updated_on" => current_date (),
				'causes_updated_by' => get_admin_id (),
				'causes_updated_ip' => get_ip ()				
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
		$table_cause_file_array=array();	
		$causes_image_file='';
		if (isset ( $_FILES [$file_name] ['name'] ) && $_FILES [$file_name] ['name'] != "") 
		{
			$config['upload_path']=constant ( 'causes_upload_path' );
			$config['allowed_types']=constant ( 'image_allowed_types' );
			$config['max_size']     = constant ( 'image_max_size' );						
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
                    $config['new_image'] = $image_data['full_path']; //get original image
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = false;
                    $config['width'] = constant ( 'causes_max_width' );
                    $config['height'] = constant ( 'causes_max_height' );
					$config['thumb_marker'] = '_t'; //Add this in your config array empty string

					$this->load->library('image_lib', $config);
					if (!$this->image_lib->resize()) 
					{
						$error=$this->image_lib->display_errors();						
						$response = array("status"=>"error","message"=>$error);
						echo json_encode($response); 
						exit;		            
					}
					$this->image_lib->clear();
					$causes_image_file=$image_data['file_name'];
			}
		}				
		return $causes_image_file;
	}
				/* this method used to view content...*/
				public function view($view_id) {
					
					$data = $this->load_module_info ();

					$join = $limit=$offset=''; 
					$order_by=$like=$groupby=array();
					$join [0] ['select'] = "s.status_title";
					$join [0] ['table'] = "status as  s";
					$join [0] ['condition'] = "s.status_id = causes_status";
					$join [0] ['type'] = "LEFT";
					
					$groupby = $this->primary_key;	
					$where_array=array($this->primary_key => decode_value($view_id));
					$result = $this->Mydb->get_all_records ($this->table.'.*',$this->table,$where_array,$limit,$offset,$order_by,$like,$groupby,$join);
					$data ['result']=$result[0];
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
