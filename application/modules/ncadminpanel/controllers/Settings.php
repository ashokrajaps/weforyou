<?php
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: Page contains site settings functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Settings extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "settings";
		$this->module_label = get_label('setting_label');
		$this->module_labels =  get_label('setting_labels');
		$this->folder = "settings/";
		$this->table = "master_admin_settings";
		$this->load->library ( 'common' );
		$this->primary_key = 'settings_id';
	}
	
	/* this method used to make settings. */
	public function index() {

		$data = $this->load_module_info ();
		$id=get_admin_id();
		$response =$image_arr = array () ;
		$record = $this->Mydb->get_record ( '*', $this->table);


		if ($this->input->post ( 'action' ) == "edit") {
			
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'settings_admin_records', 'lang:settings_records_perpage', 'required' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$update_array = array (
					
						'settings_admin_records' => post_value ( 'settings_admin_records' ),
						'settings_site_title' => post_value ( 'settings_site_title' ),
						'settings_from_email' => post_value('settings_from_email'),
						'settings_admin_email' => post_value('settings_admin_email'),
						'settings_email_footer' => post_value('settings_email_footer'),
						'settings_mail_from_smtp' => post_value('settings_mail_from_smtp'),
						'settings_smtp_host' => post_value('settings_smtp_host'),
						'settings_smtp_user' => post_value('settings_smtp_user'),
						'settings_smtp_pass' => post_value('settings_smtp_pass'),
						'settings_smtp_port' => post_value('settings_smtp_port'),
						'settings_mailpath' => post_value('settings_mailpath'),
						'setting_youtube_url' => post_value('site_youtube'),
						'setting_facebook_url' => post_value('site_facebook'),
						'setting_twitter_url' => post_value('site_twitter'),
						'setting_instagram_url' => post_value('site_instagram'),
						'setting_gplus_url' => post_value('site_google_plus'),
						'setting_pinterest_url' => post_value('site_pinterest'),
						'settings_updated_on' => current_date (),
						'settings_updated_by' => get_admin_id (),
						'settings_updated_ip' => get_ip (),
				);
				
				$this->Mydb->update( $this->table, array ($this->primary_key => $record ['settings_id'] ), $update_array );

				$this->session->set_userdata('master_admin_records_perpage',post_value ( 'settings_admin_records' ));
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			}
			else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode($response);
			exit;
		}
		$data['records'] = $record;

		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
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
