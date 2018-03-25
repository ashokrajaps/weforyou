<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Enquiry extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "enquiry";
		$this->module_label = get_label('enquiry_manage_label');
		$this->module_labels =  get_label('enquiry_manage_labels');
		$this->folder = "enquiry/";
		$this->table = "enquiry";
		$this->load->library ( 'common' );
		$this->primary_key = 'enquiry_id';
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
