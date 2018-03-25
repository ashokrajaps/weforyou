<?php
if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
error_reporting ( E_ALL );
class Cron extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
	}

	public function index() {
		$this->convert_video_format ();
	}
	
	/* video convertion part */
	function convert_video_format() 
	{
		$query = "SELECT p.post_id,p.post_user_id,pv.post_media_filename,pv.post_media_id,u.users_id FROM rxl_post as p, rxl_post_media as pv, rxl_users as u 
		 		   WHERE pv.post_media_status = 'I' AND p.post_id = pv.post_id AND p.post_user_id = u.users_id AND u.users_status = 'A' AND pv.post_media_type='video' ";
		$result = $this->Mydb->custom_query ( $query ); /* Get un converted video list */
		if (!empty( $result )) 
		{
			foreach ( $result as $video ) 
			{
				$user_folder = FCPATH . "media/upload_video/";
				$user_image_folder = FCPATH . "media/upload_video/";
				$file_name = $video ['post_media_filename'];
				$directory_path_full = $user_folder . $file_name;
				$flv_file_name = strstr ( $file_name, '.', true );
				$video_name = $flv_file_name . ".flv";
				$new_file_with_path = $user_folder . $video_name;
				$video_name_mp4 = $flv_file_name . ".mp4";
				$new_file_with_path_mp4 = $user_folder . $video_name_mp4;
				$timeOffset = "0.30";
				$image_name = $flv_file_name . ".jpg";
				$jpgOutputPath = $user_image_folder . $image_name;

				exec ( "ffmpeg -i $directory_path_full -vf scale=440:240 $new_file_with_path" ); /* 748/300 */
				exec ( "ffmpeg -i $directory_path_full -vf scale=440:240 $new_file_with_path_mp4" ); /* 748/300 */
				exec ( "ffmpeg -i $directory_path_full -vf scale=768:353 $jpgOutputPath" );

				$this->Mydb->update ( 'rxl_post_media',array('post_media_id' => $video ['post_media_id']), 
													   array('post_media_status'=>'A',
															'post_media_image_frame' => $image_name,
															'post_media_filename' => $video_name 
															) );
			}
		}
	}
}
