<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Eventuser extends CI_Controller 
{
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "eventuser";
		$this->module_label = get_label('event_user_manage_label');
		$this->module_labels =  get_label('event_user_manage_labels');
		$this->folder = "eventuser/";
		$this->table = "causes_donars";
		$this->load->library ( 'common' );
		$this->primary_key = 'donar_id';
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
		$offset=0;
		$or_where = array ();
		$where = array (
				" $this->primary_key !=" => '','donar_from'=>'event'
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
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'donation_status' ) );
			$this->session->set_userdata ( $this->module . "_donation_start_date", post_value ( 'donation_start_date' ) );
			$this->session->set_userdata ( $this->module . "_donation_end_date", post_value ( 'donation_end_date' ) );
		}
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
			
		}
		/* filter by status */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'transaction_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		if (get_session_value ( $this->module . "_donation_start_date" ) != "" && get_session_value ( $this->module . "_donation_end_date" ) != "") {
			$start_date=set_date_formart( get_session_value($this->module . "_donation_start_date" ));
			$end_date=set_date_formart( get_session_value($this->module . "_donation_end_date" ));			
			$where = array_merge ( $where, array (
					"transaction_date_of_transfer  >= '$start_date' and  transaction_date_of_transfer <= '$end_date'  "=> NULL 
			) );
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
		$select_array=array('*');

		$join = array(); 
		$join [0] ['select'] = "e.event_title";
		$join [0] ['table'] = "event as  e";
		$join [0] ['condition'] = "e.event_id = donar_causes_event_id";
		$join [0] ['type'] = "INNER";

		$join [1] ['select'] = "group_concat(',',ep.participation_name) as participation_name";
		$join [1] ['table'] = "event_participations as ep";
		$join [1] ['condition'] = "ep.participation_donar_id = donar_id";
		$join [1] ['type'] = "LEFT";
		// $totla_rows = $this->Mydb->get_num_rows($this->table.'.*', $this->table, $where,'','','',$like);

		$groupby = $this->primary_key;	
		
		$totla_rows = $this->Mydb->get_num_join_rows($this->table.'.*', $this->table, $where,'','','',$like,$groupby,$join,'');
// echo "<br>";
// echo $this->db->last_query();
// print_r($totla_rows);
// exit;
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
		$data ['records'] = $this->Mydb->get_all_records ($this->table.'.*',$this->table,$where,$limit,$offset,$order_by,$like,$groupby,$join);

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
	/* this method used to view content...*/
	public function view($view_id) {
		$data = $this->load_module_info ();
		 $limit =''; $offset =0; 
		$order_by=$like=$groupby=$join =array();
		$join [0] ['select'] = "e.event_title";
		$join [0] ['table'] = "event as  e";
		$join [0] ['condition'] = "e.event_id = donar_causes_event_id";
		$join [0] ['type'] = "INNER";

		$join [1] ['select'] = "group_concat(ep.participation_name) as participation_name";
		$join [1] ['table'] = "event_participations as ep";
		$join [1] ['condition'] = "ep.participation_donar_id = donar_id";
		$join [1] ['type'] = "LEFT";

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
		$this->session->unset_userdata ( $this->module . "_donation_start_date" );
		$this->session->unset_userdata ( $this->module . "_donation_end_date" );

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
