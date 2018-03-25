<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Students extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "students";
		$this->module_label = get_label('students_manage_label');
		$this->module_labels =  get_label('students_manage_labels');
		$this->folder = "students/";
		$this->table = "students";
		$this->load->library ( 'common' );
		$this->primary_key = 'id';
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
		$where = array (
				" $this->primary_key !=" => ''
		);
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
		}

		
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
			
		}
		/* filter by status */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'customer_status' => get_session_value ( $this->module . "_search_status" )
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
		$data ['records'] = $this->Mydb->get_all_records ($this->table.'.*',$this->table,$where,$limit,$offset,$order_by,$like);


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
	public function customeremail_exists() {
		$customer_email = $this->input->post ( 'stu_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'stu_email' => trim ( $customer_email ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"id !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( 'id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'customeremail_exists', get_label ( 'studentemail_exists' ) );
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
			
			$this->form_validation->set_rules ( 'stu_first_name', 'lang:stu_first_name', 'required' );
			$this->form_validation->set_rules ( 'stu_last_name', 'lang:stu_last_name', 'required' );
			$this->form_validation->set_rules ( 'stu_father_name', 'lang:stu_father_name', 'required' );
			$this->form_validation->set_rules ( 'stu_course_name', 'lang:stu_course_name', 'required' );
			$this->form_validation->set_rules ( 'stu_email', 'lang:stu_email', 'required|callback_customeremail_exists' );
			$this->form_validation->set_rules ( 'stu_location', 'lang:stu_location', 'required' );
			$this->form_validation->set_rules ( 'stu_address', 'lang:stu_address', 'required' );
			$this->form_validation->set_rules ( 'stu_mobile', 'lang:stu_mobile', 'required' );
			$this->form_validation->set_rules ( 'stu_description', 'lang:stu_description', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			
			if ($this->form_validation->run () == TRUE) {

				$insert_array = array (
						'stu_first_name' => post_value ( 'stu_first_name' ),
						'stu_last_name' => post_value ( 'stu_last_name' ),
						'stu_father_name'=>post_value ( 'stu_father_name' ),
						'stu_course_name'=>post_value ( 'stu_course_name' ),
						'stu_email'=>post_value ( 'stu_email' ),
						'stu_location'=>post_value ( 'stu_location' ),
						'stu_address'=>post_value ( 'stu_address' ),
						'stu_mobile'=>post_value ( 'stu_mobile' ),
						'stu_description'=>post_value ( 'stu_description' ),
						'stu_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
						'stu_created_on' => current_date (),
						'stu_created_ip' => get_ip () 
				);
				
				//print_r($insert_array);
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
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'stu_first_name', 'lang:stu_first_name', 'required' );
			$this->form_validation->set_rules ( 'stu_last_name', 'lang:stu_last_name', 'required' );
			$this->form_validation->set_rules ( 'stu_father_name', 'lang:stu_father_name', 'required' );
			$this->form_validation->set_rules ( 'stu_course_name', 'lang:stu_course_name', 'required' );
			$this->form_validation->set_rules ( 'stu_email', 'lang:stu_email', 'required|callback_customeremail_exists' );
			$this->form_validation->set_rules ( 'stu_location', 'lang:stu_location', 'required' );
			$this->form_validation->set_rules ( 'stu_address', 'lang:stu_address', 'required' );
			$this->form_validation->set_rules ( 'stu_mobile', 'lang:stu_mobile', 'required' );
			$this->form_validation->set_rules ( 'stu_description', 'lang:stu_description', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			if ($this->form_validation->run () == TRUE) {

				$update_array = array (
						'stu_first_name' => post_value ( 'stu_first_name' ),
						'stu_last_name' => post_value ( 'stu_last_name' ),
						'stu_father_name'=>post_value ( 'stu_father_name' ),
						'stu_course_name'=>post_value ( 'stu_course_name' ),
						'stu_email'=>post_value ( 'stu_email' ),
						'stu_location'=>post_value ( 'stu_location' ),
						'stu_address'=>post_value ( 'stu_address' ),
						'stu_mobile'=>post_value ( 'stu_mobile' ),
						'stu_description'=>post_value ( 'stu_description' ),
						'stu_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I')
				);
				$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $record[0][$this->primary_key] ), $update_array );

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		
		$data ['records'] = $record[0];
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[0][$this->primary_key] );
		
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
				$this->Mydb->delete_where_in($this->table,'id',$ids,array());
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {
				$this->Mydb->delete($this->table,array('id'=>$ids));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		$where_array = array ();
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
				"stu_status" => 'A'
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
				"stu_status" => 'I',
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
