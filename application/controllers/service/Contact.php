<?php defined("BASEPATH") OR exit("No direct script access allowed");

                require(APPPATH."/libraries/REST_Controller.php");

class Contact extends REST_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model("contact_model");
            #__construct#
        }
        public function index_get()
        {
            //$this->load->view("service/admin_view");
        }
        #:-1-:##start
        function add_post()
        {
            $response   = $this->contact_model->contact_add();
            $this->response( $response );
        }

} ?>