<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "dashboard";
		$this->module_label = "Dashboard";
		$this->module_labels = "Dashboard";
		$this->folder = "dashboard/";
	
	}
	/* this method used to list all records . */
	public function index() {
		
		$data = array();
		
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
			
		$this->layout->display_admin($this->folder.$this->module ,$data);
		
	}
	
}


