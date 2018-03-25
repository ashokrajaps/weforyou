<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_Model {

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

            $this->table_event="event";
            $this->table_event_file="event_attachment";
    }
    function event_create()
    {
    }
    function event_update()
    {
    }
    function event_update_status()
    {
    }    
    function recent_event_list() 
    {
        $event_list_array=array();

        $where=array("event_status"=>'1','event_end_time  > '=>date("Y-m-d"));
        $event_list_array = $this->db->select("*")
                         ->from($this->table_event)
                         ->where($where)
                         ->order_by("event_start_date", "asc")
                         ->limit(constant('event_list_limit'))                         
                         ->get()->result_array();

         if(!empty($event_list_array))
         {
            foreach($event_list_array as $key=> $event)
            {
                $event_list_array[$key]['event_image']=$this->get_event_image_url($event['event_image']);
            }            
                $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$event_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }
    function event_list() 
    {
        $event_list_array=array();

        $where=array("event_status",array('1','2'));
        $event_list_array = $this->db->select("*")
                         ->from($this->table_event)
                         ->where_in($where)
                         ->order_by("event_start_date", "desc")
                         ->get()->result_array();

         if(!empty($event_list_array))
         {
            foreach($event_list_array as $key=> $event)
            {
                $event_list_array[$key]['event_image']=$this->get_event_image_url($event['event_image']);
            }            
            $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$event_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }

    function ended_event_list() 
    {
        $event_list_array=array();

        $where=array("event_status"=>'2');
        $event_list_array = $this->db->select("*")
                         ->from($this->table_event)
                         ->where($where)
                         ->order_by("event_start_date", "desc")
                         ->get()->result_array();

         if(!empty($event_list_array))
         {
            foreach($event_list_array as $key=> $event)
            {
                $event_list_array[$key]['event_image']=$this->get_event_image_url($event['event_image']);
            }            
            $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$event_list_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }

    function event_details($event_id='')
    {
        $event_details_array=array();
        if($event_id == '' )
            $event_id=post_value('event_id');
        
        $where=array("event_status"=>'1','event_id'=>$event_id);
        $event_details_array = $this->db->select("*")
                         ->from($this->table_event)
                         ->where($where)
                         ->get()->row_array();

         if(!empty($event_details_array))
         {
                $event_details_array['event_image']=$this->get_event_image_url($event_details_array['event_image']);

                $response = array("status_id"=>"1", "status_message"=>get_label('rest_ads_status_msg'), "action"=>"", "page_token"=>'','result_set'=>$event_details_array);
         }
         else
                $response = array("status_id"=>"0", "status_message"=>get_label('rest_ensure_status_message'), "page_token"=>'', "action"=>"");

         return $response;
    }
    function get_event_image_url($image_url='')
    {
        $image_url = constant('event_path').($image_url ? $image_url : "no_image.png");

        return $image_url;
    }   
}
