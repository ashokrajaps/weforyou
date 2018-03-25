<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation_model extends CI_Model {

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
            $this->table_trans_temp_request="causes_transaction_temp_request";
            $this->table_trans_request="causes_transaction";
            $this->table_causes="causes";
    }

    function donate_request() 
    {
        $donate_request_response_data=array();

        $posted=$this->input->post();
        $email_address=post_value('email_address');
        $contact_no=post_value('mobile_no');
        $where=array("donar_email_address = '$email_address' or donar_contact_no = '$contact_no' "=>NULL);
        $donar_details = $this->db->select("donar_id")
                         ->from($this->table_donar)
                         ->where($where)
                         ->get()->row_array();
            if(!empty($donar_details))
            {
                $donate_request_response_data['donar_id']=$donar_id=$donar_details['donar_id'];
            }
            else
            {
               $donar_field_array=array('donar_first_name' => post_value('donar_first_name'),
                                        'donar_last_name'=>post_value('donar_last_name'),
                                        'donar_email_address' => post_value('donar_email_address'), 
                                        'donar_contact_no' => post_value('donar_mobile_no'),
                                        'donar_address' => post_value('donar_address'),
                                        'donar_city' => post_value('donar_city'),
                                        'donar_zip_postal_code' => post_value('donar_zip_postal_code'),
                                        'donar_country' => post_value('donar_country'),
                                        'donar_ip' => get_ip (),
                                        'donar_created_on' => current_date(),
                                        );
                $donar_field_array['donar_profile_image']='';
            if (isset ( $_FILES ['donar_image'] ['name'] ) && $_FILES ['donar_image'] ['name'] != "") 
            {
                $config['upload_path']=constant ( 'donar_upload_path' );
                $config['allowed_types']=constant ( 'image_allowed_types' );
                $config['max_size']     = constant ( 'image_max_size' );                        
                $config['encrypt_name']=true;
                $config['remove_spaces']=true;  
                $this->load->library('upload',$config); 
                if(!$this->upload->do_upload('donar_image'))
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
                    $config['width'] = constant ( 'donation_max_width' );
                    $config['height'] = constant ( 'donation_max_height' );
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) 
                    {
                        $error=$this->image_lib->display_errors();                      
                        $response = array("status"=>"error","message"=>$error);
                        echo json_encode($response); 
                        exit;                   
                    }
                    $this->image_lib->clear();
                    $donar_field_array['donar_profile_image']=$image_data['file_name'];
                }
            }               
                $this->db->insert( $this->table_donar, $donar_field_array);//Insert Into Database
                $donate_request_response_data['donar_id']=$donar_id=$this->db->insert_id ();
            }
            $causes_temp_field_array=array('req_transaction_causes_id' => post_value('causes_id'),
                                'req_transaction_donar_id'=>$donar_id,
                                'req_transaction_amount' => post_value('amount'), 
                                'req_transaction_currency_code' => post_value('currency_code'), 
                                'req_transaction_payment_gateway' => post_value('payment_method'),
                                'req_transaction_paltform' => post_value('payment_platform'),
                                'req_transaction_date_of_transfer' => current_date(),
                                'req_transaction_ip' => get_ip (),
                                'req_transaction_request_response' => json_encode($posted)
                              );
            $this->db->insert( $this->table_trans_temp_request, $causes_temp_field_array);//Insert Into Database
            $donate_request_response_data['refer_id'] = $this->db->insert_id ();//get the last inert Id
            return $donate_request_response_data;
    }
    function payment_status()
    {
        $payinfo=$payment_array=$temp_trans_req_details=$transaction_exisit=$curr_reponse=array();
        $this->form_validation->set_rules("txn_id", "Transaction Id", "required|trim|numeric|xss_clean")
                    ->set_rules("refer_id", "Reference Id", "required|trim|numeric|xss_clean")
                    ->set_rules("payment_amount", "Payment Amount", "required|trim|xss_clean")
                    ->set_rules("payment_status_message", "Payment Status Message", "required|trim|xss_clean")
                    ->set_rules("payment_status", "Payment Status", "required|trim|xss_clean")
                    ->set_rules("payment_platform", "Payment platform", "trim|xss_clean|in_list[web,ios,android]")
                    ->set_rules("payment_response", "Payment Response", "required|trim|xss_clean")
                    ->set_rules("pending_reason", "Payment reason", "trim|xss_clean")
                    ->set_rules("reason_code", "Payment reason code", "trim|xss_clean|");
        if($this->form_validation->run()==TRUE)
        {
            $payinfo=$this->input->post();
            $where_trans_req_array=array("transaction_txnid"=>$payinfo['txn_id']);
            $transaction_exisit = $this->db->select("transaction_id")
                             ->from($this->table_trans_request)
                             ->where($where_trans_req_array)
                             ->get()->row_array();            
            if(empty($transaction_exisit))
            {
                $where_temp_req_array=array("req_transaction_refer_id"=>$payinfo['refer_id']);
                $temp_trans_req_details = $this->db->select("*")
                                 ->from($this->table_trans_temp_request)
                                 ->where($where_temp_req_array)
                                 ->get()->row_array();
                        if($temp_trans_req_details['req_transaction_currency_code'] == "USD")
                        {
                             $amount=$payinfo['payment_amount'];
                             $to_cc="INR";
                             $from_cc=$temp_trans_req_details['req_transaction_currency_code'];
                             $this->load->model('common_model');
                             $curr_reponse=$this->common_model->currency_convert($from_cc,$to_cc,$amount);
                            if($curr_reponse['status_id'])
                            {                         
                                $payinfo['exchange_rate']=1;
                                $payinfo['currency_code']=$curr_reponse['currency_code'];
                                $payinfo['currency_paid_amount']=$curr_reponse['payment_amount'];
                            }                         
                            else
                            {
                                $payinfo['exchange_rate']=0;
                                $payinfo['currency_code']=$curr_reponse['req_transaction_currency_code'];
                                $payinfo['currency_paid_amount']=$curr_reponse['payment_amount'];
                            }
                        }
                        else
                        {
                            $payinfo['exchange_rate']=1;
                            $payinfo['currency_code']=$temp_trans_req_details['req_transaction_currency_code'];
                            $payinfo['currency_paid_amount']=$payinfo['payment_amount'];
                        }                             
                    $payment_array=array(
                        'transaction_txnid'=>$payinfo['txn_id'],
                        'transaction_refer_id'=>$payinfo['refer_id'],
                        'transaction_causes_id'=>$temp_trans_req_details['req_transaction_causes_id'],
                        'transaction_donar_id'=>$temp_trans_req_details['req_transaction_donar_id'],
                        'transaction_total_amount'=>$payinfo['payment_amount'],
                        'transaction_discount_amount'=>0,
                        'transaction_amount'=>$payinfo['payment_amount'],
                        'transaction_currency_code'=>$payinfo['currency_code'],
                        'transaction_currency_paid_amount'=>$payinfo['currency_paid_amount'],
                        'transaction_exchange_rate'=>$payinfo['exchange_rate'],
                        'transaction_status'=>$payinfo['payment_status'],
                        'transaction_status_message'=>$payinfo['payment_status_message'],
                        'transaction_platform'=>$temp_trans_req_details['req_transaction_paltform'],
                        'transaction_payment_gateway'=>$temp_trans_req_details['req_transaction_payment_gateway'],
                        'transaction_ip'=>get_ip(),                                    
                        'transaction_date_of_transfer'=>current_date(),                                    
                        'transaction_reason_code'=>$payinfo['reason_code'],
                        'transaction_remarks'=>$payinfo['pending_reason'],
                        'transaction_response'=>$payinfo['payment_response']
                                );
                    $this->db->insert($this->table_trans_request, $payment_array); 
// echo "<pre>";
// print_r($payinfo);
// print_r($temp_trans_req_details);
// print_r($payment_array);
// echo $this->db->last_query();
// exit;
                    $last_insert_id=$this->db->insert_id ();
                    $status = $last_insert_id ? $last_insert_id : 0;
                    if($status)
                    {
                        $this->db->where (array('req_transaction_refer_id'=>$temp_trans_req_details['req_transaction_refer_id']))->delete ( $this->table_trans_temp_request );                   
                        $response =array("status_id"=>"1","status_message"=>"Payment is completed.","page_token"=>'',"action"=>"",'trans_id'=>$last_insert_id);
                    }
                    else
                    {
                        $response =array("status_id"=>"0","status_message"=>"Payment is completed. But unable stored.","page_token"=>'',"action"=>"");
                    }
              }
              else
              {
                $response =array("status_id"=>"0","status_message"=>"Already transaction id exisit.","page_token"=>'',"action"=>"",'trans_id'=>$transaction_exisit['transaction_id']);
              }  
        }
        else
        {
            $response =array("status_id"=>"0","status_message"=>validation_errors(),"page_token"=>'',"action"=>"");
        }        
        return $response;
    }
    function get_transaction_details($trans_id='')
    {
        if($trans_id == '')
            $trans_id=post_value('trans_id');

            $where_trans_request_array=array("transaction_id"=>$trans_id);
            $transaction_details = $this->db->select("transaction_refer_id,transaction_amount,transaction_status_message,transaction_date_of_transfer,causes_title,donar_email_address")
                             ->from($this->table_trans_request)
                             ->join($this->table_donar,"$this->table_donar.donar_id=$this->table_trans_request.transaction_donar_id")
                             ->join($this->table_causes,"$this->table_causes.causes_id=$this->table_trans_request.transaction_causes_id")
                             ->where($where_trans_request_array)
                             ->get()->row_array();  
            return $transaction_details;
    }    
   function clean_service_cache()
    {
        $this->load->driver('cache');
        $this->cache->redis->clean();
    }
}
