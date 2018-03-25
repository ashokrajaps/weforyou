<?php
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: Page contains Users add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Category extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "category";
		$this->module_label = get_label ( 'cate_module_label' );
		$this->module_labels = get_label ( 'cate_module_labels' );
		$this->folder = "category/";
		$this->table = "doctor_dispensary_category";
		$this->upload_folder = get_label('users_upload_folder');
		$this->load->library ( 'common' );
		$this->primary_key = 'category_id';
	}
	
	/* this method used to list all company . */
	public function index() {
		$data = $this->load_module_info ();
		
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
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
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
			
		}
		/* filter by status */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'category_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		
		 /* add sort bu option */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") 
		{	
			$order_by = array ( get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" );
		}
		
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where,$or_where, null, null, null, $like );
		/* pagination part start  */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;  
		$uri_segment = $this->uri->total_segments ();
		$uri_string = camp_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		
		/* pagination part end */
		
		$select_array = array ('*');
		
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, '', '' );

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

	
	/* this method used to add users . */
	public function add() { 
		
		$data = $this->load_module_info ();
		
		/* form submit */
		


		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			$insert_array = array ();
			//print_r($_POST); exit;		
			$this->form_validation->set_rules('category_name', 'lang:cate_name', 'trim|required|callback_cate_exists');
	
	
			if ($this->form_validation->run () == TRUE) {
			    
				$insert_array = array(
					'category_name' 	=> post_value('category_name'), 
					'category_status' 		=> ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
					'category_created_by' 	=> get_admin_id(),
					'category_created_ip' 	=> get_ip(),
					'category_created_on' 	=> current_date()
				);
			
					
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
		$data ['module_action'] = 'add';
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
		
	}

public function edit($edit_id = NULL) {


		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();
		
		$where = array($this->table.'.'.$this->primary_key => $id);

		$select_array = array ('*');
		
		 $records = $this->Mydb->get_all_records ($select_array, $this->table, $where, '', '', '', '', '', '' );
		 $record=$records[0];	
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules('category_name', 'lang:cate_name', 'trim|required|callback_cate_exists');

			
			if ($this->form_validation->run () == TRUE) {
				$update_array = array(
					'category_name' 	=> post_value('category_name'), 
					'category_status' 		=> ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
					'category_created_by' 	=> get_admin_id(),
					'category_created_ip' 	=> get_ip(),
					'category_created_on' 	=> current_date()
				);
			
					

				$this->Mydb->update($this->table, $where, $update_array);

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		
		$data['upload_folder'] = $this->upload_folder;
		$data ['records'] = $records[0];
		// print_r($data ['record']);

			
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[$this->primary_key] );
		
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);

		if ($postaction == 'Delete' && ! empty ( $ids )) {
			
			if (is_array ( $ids )) {

			
				
				$this->Mydb->delete_where_in($this->table,'category_id',$ids,'');
				

				if( count($ids) > 1 ){
					$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_labels );
				} else{
					$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				}
			} else {

				
				$this->Mydb->delete_where_in($this->table,'category_id',$ids,'');
				
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"category_status" 	 => 'A',
					"category_created_on" => current_date (),
					'category_created_by' => get_admin_id (),
					'category_created_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"category_status" 	 => 'I',
					"category_created_on" => current_date (),
					'category_created_by' => get_admin_id (),
					'category_created_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used to view content...*/
	public function view($view_id) {

		$data = $this->load_module_info ();

		$data['upload_folder'] = $this->upload_folder;

		$where = array($this->table.'.'.$this->primary_key => decode_value($view_id), $this->table);

		$select_array = array ('*');

		
		$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', '', '', '', '' );

		$data ['result'] = $records[0];

		$this->load->view($this->folder."/".$this->module."-view",$data);
	}
	
	/* this method used to add company . */
	
/* this method used check email address or alredy exists or not */
	public function email_exists() {
		
		$email = $this->input->post('users_email');
		$edit_id = $this->input->post ( 'edit_id' );
		$where = array (
			'users_email' => trim ( $email )
		);

		if ($edit_id != "") {

			$where = array_merge ( $where, array (
					"users_id !=" => $edit_id 
			) );
	
		} 

		$result = $this->Mydb->get_record( 'users_id', $this->table, $where );
		
		if ( !empty ( $result ) ) {
			$this->form_validation->set_message ( 'email_exists', get_label ( 'user_email_exist' ) );
			return false;
		} else {
			return true;
		}
	}

	/*Check phone no exist*/
	public function cate_exists() {
		$category_name = trim($this->input->post ( 'category_name' ));


		$edit_id = $this->input->post ( 'edit_id' );
		$where = array ( 'category_name' => trim ( $category_name ));

		if ($edit_id != "") {
			$where = array_merge ( $where, array ( "category_id !=" => $edit_id  ) );
		} 

		$result = $this->Mydb->get_record ( 'category_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'cate_exists', get_label('cate_exists') );
			return false;
		} else {
			return true;
		}
	}	

	/*Check username no exist*/
	public function category_exists() {
		$users_name = trim($this->input->post ( 'category_name' ));

		$where = array ('category_name' => trim ( $users_name ));
		
		$result = $this->Mydb->get_record ( 'category_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'cate_exists', get_label('username_exists') );
			return false;
		} else {
			return true;
		}
	}	

	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_field" );
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_labels;
		$data['module'] = $this->module;
		return $data;
	}
	
	/* View Store Details */
	public function export() { 
		$type = $this->uri->segment ( 4 );

		$uri_array = $this->uri->uri_to_assoc ( 3, array (
				'export' 
		) );

		// Export selected data
		if (($uri_array ['export'] == 'csv') || ($uri_array ['export'] == 'xls') && $type == "user") {
			$this->export_user ( $uri_array, $uri_array ['export'] );
		}
		
	}
	
	// Export Data
	function export_user($uriarray = NULL, $ext = "csv") {
		if (($uriarray != '') && is_array ( $uriarray )) {
			if ($ext == 'csv')
				$this->load->helper ( 'csv' );
			else if ($ext = 'xls')
				$this->load->helper ( 'xls' );
			$filename = '';
			$fExt = '.' . $ext;
			
			$labellist = array (
					"First Name",
					"Last Name",
					"Email",
					"DOB",
					"Age",
					"Gender",
					"Joining Date"
			);

			$current_query = "SELECT `users_first_name`, `users_last_name`, `users_email`, `users_birthdate`, FLOOR(DATEDIFF(CURRENT_DATE, users_birthdate)/365.25) as age, `users_gender`, `users_created_on` FROM `rxl_users` as u ORDER BY `users_first_name` ASC LIMIT 10";
			$current_query = strstr ( $current_query, ' LIMIT', true );

			// Get Current displaying data to export
			$query = $this->db->query ( $current_query );
			if ($query->num_rows () > 0) {
				$results = $query->result_array ();
				foreach ( $results as $res_key=>$res ) {
					unset ( $res ['user_id'] );
					/*if($res['user_last_login_date'] == '0000-00-00 00:00:00')
					{
						$res['user_last_login_date'] = '';
					}*/
					$result [] = $res;

				}
				$filename = 'users_' . date ( 'd_m_Y' ) . $fExt;
				array_unshift ( $result, $labellist );
				// Get Data according to file extension
				if ($ext == 'csv')
					array_to_csv ( $result, $filename );
				else if ($ext = 'xls')
					array_to_xls ( $result, $filename );
				exit ();
			} else {
				$this->session->set_flashdata ( 'error_msg', $this->lang->line ( 'invalid_process' ) );
				redirect ( admin_url () . $this->module );
			}
		}
	}
}
