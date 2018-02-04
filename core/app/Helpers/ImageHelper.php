<?php

namespace App\Helpers;

/**
 * Description of Helper
 *
 * @author acer
 */
class ImageHelper
{
	public static function save_base64_image($base64_image_string, $output_file_without_ext, $path_with_end_slash="" ) {
		//usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }      
		//
		//data is like:    data:image/png;base64,asdfasdfasdf
		$splited = explode(',', substr( $base64_image_string , 5 ) , 2);
		$mime=$splited[0];
		$data=$splited[1];

		$mime_split_without_base64=explode(';', $mime,2);
		$mime_split=explode('/', $mime_split_without_base64[0],2);
		if(count($mime_split)==2)
		{
			$extension=$mime_split[1];
			if($extension=='jpeg')$extension='jpg';
			//if($extension=='javascript')$extension='js';
			//if($extension=='text')$extension='txt';
			$output_file_with_ext=$output_file_without_ext.'.'.$extension;
		}
		file_put_contents( $path_with_end_slash . $output_file_with_ext, base64_decode($data) );
		return $output_file_with_ext;
	}
	
	public static function test()
	{
		return true;
	}
}
