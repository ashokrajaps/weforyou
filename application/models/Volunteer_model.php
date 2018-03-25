        <?php
        if (!defined('BASEPATH'))
            exit('No direct script access allowed');

        class Volunteer_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->load->helper("string");
                $this->load->helper("common_settings");
                $this->load->helper("security");
                $this->load->library("form_validation");
                $this->page_token = $this->input->post("page_token");
                $this->page_token = $this->page_token ? $this->page_token : "";
                $this->form_validation->set_error_delimiters('<li>','</li>');
                
                $post_json_decoded = json_decode(file_get_contents("php://input"), true);
                if($post_json_decoded && count($post_json_decoded))
                    $_POST = array_merge($post_json_decoded, $_POST);

                $this->module_label = get_label('volunteer_manage_label');
                $this->module_labels =  get_label('volunteer_manage_labels');

                $this->table = "volunteer";
                $this->primary_key = 'volunteer_id';
                $this->status = 'volunteer_status';
            }
            /* this method used to add record . */
        public function volunteer_add() {
                $data = array();
                /* form submit */
                if ($this->input->post ( 'action' ) == "Add") {
                    check_ajax_request (); 
                $this->form_validation->set_rules ( 'volunteer_first_name', 'lang:volunteer_first_name', 'required|trim' )
                ->set_rules ( 'volunteer_last_name', 'lang:volunteer_last_name', 'required|trim' )
                ->set_rules ( 'volunteer_mobile_no', 'lang:volunteer_mobile_no', 'required|callback_volunteer_mobile_no_exists' )
                ->set_rules ( 'volunteer_email', 'lang:volunteer_email', 'trim|callback_volunteer_email_exists' )
                ->set_rules ( 'volunteer_gender', 'lang:volunteer_gender', 'required' )
                ->set_rules ( 'volunteer_age', 'lang:volunteer_age', 'required|trim' )
                ->set_rules ( 'volunteer_address', 'lang:volunteer_address', 'trim' )
                ->set_rules ( 'volunteer_city', 'lang:volunteer_city', 'required' )
                ->set_rules ( 'volunteer_zip_postal_code', 'lang:volunteer_zip_postal_code', 'required|trim' )
                ->set_rules ( 'volunteer_country', 'lang:volunteer_country', 'required|trim' )
                ->set_rules ( 'volunteer_way_to_contact', 'lang:volunteer_way_to_contact', 'required|trim' )
                ->set_rules ( 'volunteer_area_of_interest', 'lang:volunteer_area_of_interest', 'required|trim' )
                ->set_rules ( 'volunteer_previous_experience', 'lang:volunteer_previous_experience', 'trim' )
                ->set_rules ( 'volunteer_exp_if_yes_where', 'lang:volunteer_exp_if_yes_where', 'trim' )
                ->set_rules('volunteer_passionate_social_service','lang:volunteer_passionate_social_service','trim' )
                ->set_rules ( 'volunteer_profile_image', 'lang:volunteer_profile_image', 'trim' )
                ->set_rules ( 'status', 'lang:status', 'trim' );
                
                if ($this->form_validation->run ($this) == TRUE) {

                        $_POST['volunteer_previous_experience']=$this->input->post ( 'volunteer_exp_if_yes_where' ) ? 'yes' : 'no';
                        $insert_array = array (
                            'volunteer_first_name' => post_value ( 'volunteer_first_name' ),
                            'volunteer_last_name' => post_value ( 'volunteer_last_name' ),
                            'volunteer_mobile_no' => post_value ( 'volunteer_mobile_no' ),
                            'volunteer_email'=>post_value ( 'volunteer_email' ),
                            'volunteer_gender'=>post_value ( 'volunteer_gender' ),
                            'volunteer_age'=>post_value ( 'volunteer_age' ),
                            'volunteer_address'=>post_value ( 'volunteer_address' ),
                            'volunteer_city'=>post_value ( 'volunteer_city' ),
                            'volunteer_zip_postal_code'=>post_value ( 'volunteer_zip_postal_code' ),
                            'volunteer_country'=>post_value ( 'volunteer_country' ),
                            'volunteer_way_to_contact'=>post_value ( 'volunteer_way_to_contact' ),
                            'volunteer_area_of_interest'=>post_value ( 'volunteer_area_of_interest' ),
                            'volunteer_previous_experience'=>post_value ( 'volunteer_previous_experience' ),
                            'volunteer_exp_if_yes_where'=>post_value ( 'volunteer_exp_if_yes_where' ),
                            'volunteer_passionate_social_service'=>post_value ( 'volunteer_passionate_social_service'),
                            'volunteer_status' => ($this->input->post ( 'status' ) == "1" ? '1' : '0'),
                            'volunteer_created_on' => current_date (),
                            'volunteer_created_ip' => get_ip (),
                            'volunteer_updated_by' => '',//get_admin_id (),
                            );
                            if (isset ( $_FILES ['volunteer_profile_image'] ['name'] )) 
                            {
                             $insert_array['volunteer_profile_image']=$this->do_multi_upload('volunteer_profile_image');
                            }
                         $insert_id = $this->Mydb->insert ( $this->table, $insert_array );
                         //$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );

                         $result ['status'] = 'success';
                         $result ['message'] = sprintf ( $this->lang->line ( 'success_message_add' ),$this->module_label);
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
        public function do_multi_upload($file_name='')
        {
            $table_cause_file_array=array();    
            if (isset ( $_FILES [$file_name] ['name'] ) && $_FILES [$file_name] ['name'] != "") 
            {
                $config['upload_path']=constant ( 'volunteer_upload_path' );
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
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = constant ( 'volunteer_max_width' );
                    $config['height'] = constant ( 'volunteer_max_height' );
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) 
                    {
                        $error=$this->image_lib->display_errors();                      
                        $response = array("status"=>"error","message"=>$error);
                        echo json_encode($response); 
                        exit;                   
                    }
                    $this->image_lib->clear();
                    $profile_image=$image_data['file_name'];
                    return  $profile_image;
                }
            }               
        }

    }
