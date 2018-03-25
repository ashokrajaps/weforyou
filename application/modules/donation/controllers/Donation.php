<?php 
/************************************************
Project Name	: 
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: This class contains registration, Login, Reset password
**************************************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('mcurl');
		$this->load->model('donation_model');
		$this->folder = "donation/";
		$this->module = 'donation';
		$this->module_label = get_label('admin_label');
		$this->module_labels =  get_label('admin_labels');		
		$post_data = json_decode(trim(file_get_contents('php://input')), true);
		if(!empty($post_data))
		{
			$_POST=array_merge($_POST, $post_data);
		}
	}
	public function index($causes_id='')
	{
		$this->load->model('causes_model');
		$data = $this->load_module_info();

		$data['title'] = $data['form_heading'] = "Home";//get_label('admin_heading').' '.$this->module_label;
		if($causes_id != '')
		{
			$data['causes_id']=$causes_id;
			$causes_details=$this->causes_model->causes_details($causes_id);
			$data['causes_details']=($causes_details['status_id']) ? $causes_details['result_set'] : array();
			$this->load->view($this->folder.$this->module.'_pay', $data);
		}
		else
		{
			$causes_lists=$this->causes_model->causes_list();
			$data['causes_lists']=($causes_lists['status_id']) ? $causes_lists['result_set'] : array();

			$this->load->view($this->folder.$this->module.'_list', $data);
		}
	}
	public function pay($causes_id='')
	{
		$data = $this->load_module_info();
		if(!empty($_POST)) 
		{
			foreach($_POST as $key => $value) 
			{    
				$posted[$key] = isset($value) ? $value : ''; 
			}
		}
		if($causes_id == '')
			$posted['causes_id']=$_POST['causes_id'];
		else
			$posted['causes_id']= $_POST['causes_id'] = $causes_id;
		if($posted['causes_id'] != '' & $posted['causes_id'] >0 )
		{

			$_POST['payment_platform'] = "Web";
			$donate_request=$this->donation_model->donate_request();

			//Set variables for payment gateway form
			    $returnURL = base_url().'donation/paystatus'; //payment success url
			    $cancelURL = base_url().'donation/paycancel'; //payment cancel url
			    $notifyURL = base_url().'donations/payipn'; //ipn url
			    $quantity = 1;
			    $currency_code= isset($posted['currency_code']) ? $posted['currency_code'] : "USD";
			    $causes_product_info= isset($posted['causes_title']) ? $posted['causes_title'] : "Product  info";
			    // $causes_product_info='productinfo';

			    $refer_id=$donate_request['refer_id'];
			    $donar_id=$donate_request['donar_id'];
			    $amount=isset($posted['amount']) ? $posted['amount'] : 10 ;
			    $causes_id=$posted['causes_id'];
			    $donar_first_name=isset($posted['donar_first_name']) ? $posted['donar_first_name'] : 'User' ;
			    $donar_last_name=isset($posted['donar_first_name']) ? $posted['donar_last_name'] : 'lname';
			    $donar_email_address=isset($posted['donar_email_address']) ? $posted['donar_email_address'] : 'info@weforyou.ngo' ;
			    $donar_mobile_no=isset($posted['donar_mobile_no']) ? $posted['donar_mobile_no'] : '9876543210';
			    $donar_address=isset($posted['donar_address']) ? $posted['donar_address'] : $causes_product_info;

			    $posted['payment_method'] = isset($posted['payment_method'])? $posted['payment_method'] : "Payumoney";
			    if($posted['payment_method'] == "1")//Paypal
			    {
			    	$paypal_action_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
			    	$paypal_action_url='https://www.paypal.com/cgi-bin/webscr';

			    	$business = constant('paypal_business_email');
			    	$cmd = '_xclick';
			    	$item_number = $quantity;
			    	$item_name = $causes_product_info;
			    	$discount_rate = '0';
			    	$discount_amount = '0';
			    	$rm = '2';
			    	$data['pay_form']='';
			    	$data['pay_form']='<html>
			    	<head><title>Processing Payment...</title></head>
			    	<font face="Verdana"><center><font size="4" color="#3b4455">Redirected to the payment gateway is being processed,<br>Please wait ...</font><br><font size="1" color="#3b4455">(Please do not use "Refresh" or "Back" button)</font> <center><div id="canvas" align="center"><img src="'.base_url().'media/wait.gif" alt="Please wait"></div></center></center></font>                               
			    	<body style="text-align:center;"  onLoad="document.forms[\'paypal_form\'].submit();">
			    	<form action="'.$paypal_action_url.'" method="post" name="paypal_form">
			    	<input type="hidden" name="item_number" value="'.$item_number.'" />
			    	<input type="hidden" name="item_name" value="'.$item_name.'" />
			    	<input type="hidden" name="discount_rate" value="'.$discount_rate.'" />
			    	<input type="hidden" name="discount_amount" value="'.$discount_amount.'" />
			    	<input type="hidden" name="business" value="'.$business.'" />
			    	<input type="hidden" name="txnid" value="'.$refer_id.'" />
			    	<input type="hidden" name="amount" value="'.$amount.'" />
			    	<input type="hidden" name="productinfo" value="'.$causes_product_info.'" />
			    	<input type="hidden" name="first_name" value="'.$donar_first_name.'"" />
			    	<input type="hidden" name="last_name" value="'.$donar_last_name.'"" />
			    	<input type="hidden" name="email" value="'.$donar_email_address.'" />
			    	<input type="hidden" name="phone" value="'.$donar_mobile_no.'" />
			    	<input type="hidden" name="address1" value="'.$donar_address.'" />
			    	<input type="hidden" name="custom" value="'.$refer_id.'" />
			    	<input type="hidden" name="quantity" value="'.$quantity.'" />
			    	<input type="hidden" name="currencyCode" value="'.$currency_code.'" />
			    	<input type="hidden" name="cmd" value="'.$cmd.'" />
			    	<input type="hidden" name="rm" value="'.$rm.'" />
			    	<input type="hidden" name="cancel_return" value="'.$cancelURL.'" />
			    	<input type="hidden" name="return" value="'.$returnURL.'" />
			    	<input type="hidden" name="notify_url" value="'.$returnURL.'" />
			    	<input type="image" name="submit" border="0"
			    	src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
			    	alt="Buy Now">			                                        
			    	</form>
			    	</body>
			    	</html>';
			    	echo $data['pay_form'];

			    }
			    else if($posted['payment_method'] == "2")//Payumoney
			    {
			    	$key=constant('payumoney_key');
			    	$salt=constant('payumoney_salt');
			    	$hash_string = $key. '|'.$refer_id. '|'.$amount. '|'.$causes_product_info.'|'.$donar_first_name.'|' .$donar_email_address. '|'.$causes_id.'|' .$donar_id. '|||||||||'.$salt;
			    	$hash = strtolower(hash('sha512', $hash_string));            
			    	$service_provider = 'payu_paisa';
			    	$payumoney_action_url = 'https://secure.payu.in/_payment';
			    	$data['pay_form']='';
			    	$data['pay_form']='<html>
			    	<head><title>Processing Payment...</title></head>
			    	<font face="Verdana"><center><font size="4" color="#3b4455">Redirected to the payment gateway is being processed,<br>Please wait ...</font><br><font size="1" color="#3b4455">(Please do not use "Refresh" or "Back" button)</font> <center><div id="canvas" align="center"><img src="'.base_url().'media/wait.gif" alt="Please wait"></div></center></center></font>                               
			    	<body style="text-align:center;"  onLoad="document.forms[\'payumoney_form\'].submit();">
			    	<form action="'.$payumoney_action_url.'" method="post" name="payumoney_form">
			    	<input type="hidden" name="key" value="'.$key.'" />
			    	<input type="hidden" name="txnid" value="'.$refer_id.'" />
			    	<input type="hidden" name="amount" value="'.$amount.'" />
			    	<input type="hidden" name="productinfo" value="'.$causes_product_info.'" />
			    	<input type="hidden" name="quantity" value="'.$quantity.'" />
			    	<input type="hidden" name="firstname" value="'.$donar_first_name.'"" />
			    	<input type="hidden" name="lastname" value="'.$donar_last_name.'"" />
			    	<input type="hidden" name="email" value="'.$donar_email_address.'" />
			    	<input type="hidden" name="phone" value="'.$donar_mobile_no.'" />
			    	<input type="hidden" name="address1" value="'.$donar_address.'" />
			    	<input type="hidden" name="hash" value="'.$hash.'" />
			    	<input type="hidden" name="service_provider" value="'.$service_provider.'" />
			    	<input type="hidden" name="quantity" value="'.$quantity.'" />
			    	<input type="hidden" name="currencyCode" value="'.$currency_code.'" />
			    	<input type="hidden" name="udf1" value="'.$causes_id.'" />
			    	<input type="hidden" name="udf2" value="'.$donar_id.'" />
			    	<input type="hidden" name="curl" value="'.$cancelURL.'" />
			    	<input type="hidden" name="surl" value="'.$returnURL.'" />
			    	<input type="hidden" name="furl" value="'.$returnURL.'" />
			    	</form>
			    	</body>
			    	</html>';
			    	echo $data['pay_form'];
			    }
			    else if($posted['payment_method'] == "3")//CCavenue
			    {
			    }            
			    else
			    {
			    	$redirect_url=base_url()."/donation";
			    	if ( redirect( $redirect_url ) ) {
			    		exit;
			    	}
			    }
			}
			else
			{
				$redirect_url=base_url()."/donation";
				if ( redirect( $redirect_url ) ) {
					exit;
				}
			}             			
		}
		function paystatus()
		{
			$payment_info = $this->input->post();
			if(!empty($payment_info))
			{
				$_POST['payment_response'] = json_encode($payment_info);
				if(isset($payment_info["txn_id"]))
				{
					$_POST['txn_id'] = $payment_info["txn_id"];
					$_POST['refer_id'] = $payment_info["custom"];
					$_POST['payment_amount'] = $payment_info["mc_gross"];
					$_POST['payment_status_message'] = ($payment_info['status']=='success') ? $payment_info['status'] : 'failure'; 
	            $_POST['payment_status'] = ($payment_info['status']=='success') ? 1 : 0 ; //success/failure.
	            $_POST['pending_reason'] = isset($payment_info["pending_reason"])? $payment_info["pending_reason"]:'';
	            $_POST['reason_code'] = isset($payment_info["reason_code"]) ? $payment_info["reason_code"] : '' ;
	        }
	        else if(isset($payment_info["tx"]))
	        {
	        	$_POST['txn_id'] = $payment_info["tx"];
	        	$_POST['refer_id'] = $payment_info["cm"];
	        	$_POST['payment_amount'] = $payment_info["amt"];
	        	$_POST['payment_status_message'] = ($payment_info['st']=='success') ? $payment_info['st'] : 'failure'; 
	            $_POST['payment_status'] = ($payment_info['st']=='success') ? 1 : 0 ; //success/failure.
	            $_POST['pending_reason'] = isset($payment_info["pending_reason"])? $payment_info["pending_reason"]:'';
	            $_POST['reason_code'] = isset($payment_info["reason_code"]) ? $payment_info["reason_code"] : '';
	        }
	        else if(isset($payment_info["txnid"]))
	        {
	            $_POST['txn_id'] = isset($payment_info["payuMoneyId"]) ? $payment_info["payuMoneyId"] : $payment_info["txnid"]  ;//receipt_id
	            $_POST['refer_id'] = $payment_info["txnid"];
	            $_POST['payment_amount'] = $payment_info["amount"];
	            $_POST['payment_status_message'] = ($payment_info['status']=='success') ? $payment_info['status'] : 'failure'; //success/failure.
	            $_POST['payment_status'] = ($payment_info['status']=='success') ? 1 : 0; //success/failure.
	            $_POST['pending_reason'] = isset($payment_info["Error"])? $payment_info["Error"] : '';
	            $_POST['reason_code'] = isset($payment_info["bank_ref_num"]) ? '' : '' ;                
	        }        
	        $payment_status_info = $this->donation_model->payment_status();
	        $trans_id=($payment_status_info['status_id'])?$payment_status_info['trans_id'] : '';
	        if($trans_id)
	        	$redirect_url=base_url()."donation/status/$trans_id";
	        else
	        	$redirect_url=base_url()."donation/status/";

	        redirect($redirect_url);
	    }
	    else
	    {
	    	redirect(base_url()."donation/");
	    	exit;
	    }
	}
	function paycancel()
	{
		$this->load->view($this->folder .'cancel');
	}
	function payipn()
	{
		$this->load->view($this->folder .'cancel');
	}
	function status($trans_id=0)
	{
		$data['trans_id']=$trans_id;
		$transaction_details=$this->donation_model->get_transaction_details($trans_id);
		$data['transaction_details']=$transaction_details;
		$this->load->view($this->folder.$this->module.'_payment_status',$data);
	}
	/* this method used to common module labels */
	function load_module_info() 
	{
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}


}
?>
