<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/Stripe/lib/Stripe.php');

class Stripep
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/* Creating Token  */
	function __getToken($api_key='', $card){
		
		Stripe::setApiKey($api_key);		
		$result = Stripe_Token::create($card);
		return $result['id'];
	}

	/* Payment processing */
	public function process($payment){
		
		/* getting values from the config */
		try{
		$this->ci()->config->load('stripe');
		$api_key = $this->ci()->config->item('stripe_api_key');
		$currency_code = $this->ci()->config->item('currency_code');
		
		$card = array("card" => $payment['card']);
	    $token =$this->__getToken($api_key, $card);
		$response = Stripe_Charge::create(array(
  				"amount" =>$payment['amount']*100,
 				"currency" => $currency_code,
  				"source" => $token,
  				"description" => $payment['product_name']
				));
				
		
		}
		
		catch(Stripe_CardError $e) {
		
		}
		catch (Stripe_InvalidRequestError $e) {
			
		} catch (Stripe_AuthenticationError $e) {
			
		} catch (Stripe_ApiConnectionError $e) {
			
		} catch (Stripe_Error $e) {
			 
		} catch (Exception $e) {
			
		}
		if(isset($e)){
			$e_json = $e->getJsonBody();
			return $error = $e_json['error'];  //error message here
		}else{
			return $response;
		}
	}
}
