<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	$this->load->view('welcome_message');
	}
	
// takes URL of image and Path for the image as parameter
function download_image2($image_url){
    $ch = curl_init($image_url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, "curl_callback");
    // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($ch);

    curl_close($ch);                              // closing curl handle
}

/** callback function for curl */
function curl_callback($ch, $bytes){
    global $fp;
    $len = fwrite($fp, $bytes);
    // if you want, you can use any progress printing here
    return $len;
}	
function get_data($url) {
	$ch = curl_init();
	$timeout = 500;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function  test_curl()
{
		$profile_Image = "https://scontent.xx.fbcdn.net/v/t1.0-1/p200x200/15871793_647748205428592_3249813113150339975_n.jpg?oh=2c3ab8333aee0fc561778ef90ee78c60&oe=5909BB86";
		$image_file = 'http://www.ezzysales.com/rxleaf/media/users/';
//image url
$userImage = 'myimg.jpg'; // renaming image
$path = '';  // your saving path
$ch = curl_init($profile_Image);
$fp = fopen($path . $image_file, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);
fclose($fp);		
	$returned_content = $this->get_data($html_brand);
	print_r($returned_content);exit;


		/// test the download function
		//$image_file = "local_image2.jpg";
		$fp = fopen ($image_file, 'wb');              // open file handle
		$this->download_image2($html_brand);
		fclose($fp); 
	}
}
