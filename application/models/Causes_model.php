<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Causes_model extends CI_Model {

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

            $this->table_causes="causes";
            $this->table_cause_file="causes_attachment";
            $this->table_causes_transaction="causes_transaction";
            $this->primary_key = 'causes_id';

    }
    function causes_create()
    {

    }
    function causes_update()
    {

    }
    function causes_update_status()
    {

    }    
    function causes_list() 
    {
        $causes_list_array=array();

        $where=array("causes_status"=>'1',"causes_is_donation_need"=>'yes');
        $causes_list_array = $this->db->select("causes_id,causes_title_slug,causes_title,causes_description,causes_how_much_donation_need as causes_donation_need_amount,sum(transaction_amount) as total_amount,causes_image")
                         ->from($this->table_causes)
                         ->join($this->table_causes_transaction,"$this->table_causes_transaction.transaction_causes_id=$this->table_causes.causes_id and transaction_status='1'","left")
                         ->where($where)
                         ->group_by ( $this->primary_key )
                         ->get()->result_array();
         if(!empty($causes_list_array))
         {
            foreach($causes_list_array as $key=> $causes)
            {
                $causes_list_array[$key]['causes_image']=$this->get_causes_image_url($causes['causes_image']);
            }            
            $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$causes_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }
    function home_page_causes_list() 
    {
        $home_causes_list_array=array();

        $where=array("causes_status"=>'1',"causes_is_donation_need"=>'yes','causes_show_home_page'=>'yes');
        $home_causes_list_array = $this->db->select("causes_id,causes_title_slug,causes_title,causes_description,causes_how_much_donation_need as causes_donation_need_amount,sum(transaction_amount) as total_amount,causes_image")
                         ->from($this->table_causes)
                         ->join($this->table_causes_transaction,"$this->table_causes_transaction.transaction_causes_id=$this->table_causes.causes_id and transaction_status='1'","left")
                         ->where($where)
                         ->group_by ( $this->primary_key )
                         ->order_by("causes_id", "desc")
                         ->limit(constant('causes_list_limit'))
                         ->get()->result_array();    
         if(!empty($home_causes_list_array))
         {
            foreach($home_causes_list_array as $key=> $causes)
            {
                $home_causes_list_array[$key]['causes_image']=$this->get_causes_image_url($causes['causes_image']);
            }            
                $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$home_causes_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;

}
    function causes_details($causes_id='')
    {
        $causes_details_array=array();
        if($causes_id == '' )
            $causes_id=post_value('causes_id');
        
        $where=array("causes_status"=>'1',"causes_is_donation_need"=>'yes','causes_id'=>$causes_id);
        $causes_details_array = $this->db->select("causes_id,causes_title_slug,causes_title,causes_description,causes_how_much_donation_need as causes_donation_need_amount,sum(transaction_amount) as total_amount,causes_image")
                         ->from($this->table_causes)
                         ->join($this->table_causes_transaction,"$this->table_causes_transaction.transaction_causes_id=$this->table_causes.causes_id and transaction_status='1'","left")
                         ->where($where)
                         ->group_by ( $this->primary_key )
                         ->get()->row_array();

         if(!empty($causes_details_array))
         {

                $causes_details_array['causes_image']=$this->get_causes_image_url($causes_details_array['causes_image']);
         
            $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$causes_details_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;    
    }
    function get_causes_image_url($image_url='')
    {
        $image_url = constant('causes_path').($image_url ? $image_url : "no_image.png");

        return $image_url;
    }   
}
