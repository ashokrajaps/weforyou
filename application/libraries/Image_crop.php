<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Image_Crop
{
	protected $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->helper('inflector');
	}

	function save_image($path=null,$minwidth=null,$minheight="")
	{

		$imagePath = $path;
		
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG"); /* image type */
		
		$temp = explode(".", $_FILES["img"]["name"]);
		$extension = end($temp);
		
		if ( in_array($extension, $allowedExts))
		{
		$size = getimagesize($_FILES["img"]["tmp_name"]);
		$uploadwidth = $size[0];
		$uploadheight = $size[1];
		 /*Image size validation */
		if($uploadwidth < $minwidth || $uploadheight < $minheight)
		{
		 		$response = array(
		 				"status" => 'imagesize',
		 				"message" => 'imagesize',
		 		);
        }
		else 
		{
			if ($_FILES["img"]["error"] > 0)
			{
				$response = array(
						"status" => 'error',
						"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
				);
				echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
			}
			else
			{
		
				$filename = $_FILES["img"]["tmp_name"];
				list($width, $height) = getimagesize( $filename );
		
				$file_real_name= underscore($_FILES["img"]["name"]);
				list($width, $height) = getimagesize( $filename );
				$source_url = $filename;
				$destination_url =  $imagePath .$file_real_name;
				$quality =60; /* image quality */
				$info = getimagesize($source_url);
				if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
				elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
				elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
				imagejpeg($image, $destination_url, $quality);
				
				$image = imagecreatefromstring(file_get_contents($_FILES['img']['tmp_name']));
				
				$exif = exif_read_data($_FILES['img']['tmp_name']);
				if(!empty($exif['Orientation'])) {
					switch($exif['Orientation']) {
						case 8:
							$image = imagerotate($image,90,0);
							break;
						case 3:
							$image = imagerotate($image,180,0);
							break;
						case 6:
							$image = imagerotate($image,-90,0);
							break;
					}
				}
				
				imagejpeg($image, $destination_url, $quality);  /* write new image */
				
			 /*	move_uploaded_file($filename,  $imagePath . underscore($_FILES["img"]["name"])); */
		
				$response = array(
						"status" => 'success',
						"url" => base_url().$imagePath.underscore($_FILES["img"]["name"]),
						"width" => $width,
						"height" => $height
				);
		
			}
		}	
			
		}
		else
		{
			$response = array(
					"status" => 'error',
					"message" => 'something went wrong',
			);
		}
		
		return json_encode($response);
		
		
	}	
	
/* */	
	function crop_image($path=null,$file_full_path=null)
	{	

		$imgUrl = $_POST['imgUrl'];
		// original sizes
		$imgInitW = $_POST['imgInitW'];
		$imgInitH = $_POST['imgInitH'];
		// resized sizes
		$imgW = $_POST['imgW'];
		$imgH = $_POST['imgH'];
		// offsets
		$imgY1 = $_POST['imgY1'];
		$imgX1 = $_POST['imgX1'];
		// crop box
		$cropW = $_POST['cropW'];
		$cropH = $_POST['cropH'];
		// rotation angle
		$angle = $_POST['rotation'];

		$jpeg_quality = 100;
		$png_quality = 90;

		$output_filename = $path."croppedImg_".rand();

		// uncomment line below to save the cropped image in the same location as the original image.
		//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

		$what = getimagesize($imgUrl);

		switch(strtolower($what['mime']))
		{
		    case 'image/png':
		        $img_r = imagecreatefrompng($imgUrl);
				$source_image = imagecreatefrompng($imgUrl);
				$type = '.png';
		        break;
		    case 'image/jpeg':
		        $img_r = imagecreatefromjpeg($imgUrl);
				$source_image = imagecreatefromjpeg($imgUrl);
				error_log("jpg");
				$type = '.jpeg';
		        break;
		    case 'image/gif':
		        $img_r = imagecreatefromgif($imgUrl);
				$source_image = imagecreatefromgif($imgUrl);
				$type = '.gif';
		        break;
		    default: die('image type not supported');
		}


		//Check write Access to Directory

		if(!is_writable(dirname($output_filename))){
			$response = Array(
			    "status" => 'error',
			    "message" => 'Can`t write cropped File'
		    );	
		}else{
		    // resize the original image to size of editor
		    $resizedImage = imagecreatetruecolor($imgW, $imgH);
			imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);		
		    // rotate the rezized image
		    $rotated_image = imagerotate($resizedImage, -$angle, 0);
		    // find new width & height of rotated image
		    $rotated_width = imagesx($rotated_image);
		    $rotated_height = imagesy($rotated_image);
		    // diff between rotated & original sizes
		    $dx = $rotated_width - $imgW;
		    $dy = $rotated_height - $imgH;
		    // crop rotated image to fit into original rezized rectangle
			$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
			imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
			imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
			// crop image into selected area

			$final_image = imagecreatetruecolor($cropW, $cropW);
			imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
			imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
			// finally output png image
			//imagepng($final_image, $output_filename.$type, $png_quality);
			imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
			
			$file_url = str_replace(FCPATH,base_url(),$output_filename);
			$response = Array(
			    "status" => 'success',
			    "url" => $file_url.$type
		    );
		}

		//print_r($response); exit;
		return json_encode($response);
		
	}
					
	


}
/* End of file Image_Crop.php */
/* Location: ./application/libraries/Image_Crop.php */
