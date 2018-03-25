<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donar_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper("string");
        $this->load->helper("common_settings");
        $this->load->helper("security");
        $this->load->library("form_validation");
        $this->page_token = $this->input->post("page_token");
        $this->page_token = $this->page_token ? $this->page_token : "";
        
        $post_json_decoded = json_decode(file_get_contents("php://input"), true);
        if($post_json_decoded && count($post_json_decoded))
            $_POST = array_merge($post_json_decoded, $_POST);

            $this->table_donar="causes_donars";
            $this->table_causes_transaction="causes_transaction";
    }
    function donar_create()
    {
    }
    function donar_update()
    {
    }
    function donar_update_status()
    {
    }    
    function top_donar_list($donar_limit=4) 
    {
        $donar_list_array=array();

        $where=array("transaction_status"=>'1');
        $donar_list_array = $this->db->select("concat(donar_first_name,' ',donar_last_name) as donar_name,donar_profile_image as donar_image,transaction_amount as donate_amount")
                         ->from($this->table_donar)
                         ->where($where)
                         ->join($this->table_causes_transaction,"$this->table_causes_transaction.transaction_donar_id=$this->table_donar.donar_id ","inner")
                         ->order_by("transaction_amount", "desc")
                         ->limit($donar_limit)                         
                         ->get()->result_array();
         if(!empty($donar_list_array))
         {

            foreach($donar_list_array as $key=> $donar)
            {
                $donar_list_array[$key]['donar_image']=$this->get_donar_image_url($donar['donar_image']);
            }
                $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$donar_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }
    function donar_list() 
    {
        $donar_list_array=array();

        $where=array("transaction_status"=>'1');
        $donar_list_array = $this->db->select("concat(donar_first_name,donar_last_name) as donar_name,donar_profile_image as donar_image,transaction_amount as donate_amount")
                         ->from($this->table_donar)
                         ->where($where)
                         ->join($this->table_causes_transaction,"$this->table_causes_transaction.transaction_donar_id=$this->table_donar.donar_id ","inner")
                         ->order_by("transaction_amount", "desc")
                         ->get()->result_array();

         if(!empty($donar_list_array))
         {

            foreach($donar_list_array as $key=> $donar)
            {
                $donar_list_array[$key]['donar_image']=get_donar_image_url($donar['donar_image']);
            }
                $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$donar_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }
    function get_donar_image_url($image_url='')
    {
        $image_url = constant('donar_path').($image_url ? $image_url : "no_image.png");

        return $image_url;
    }
   
}
