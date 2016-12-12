<?php
error_reporting(0);
@ini_set('display_errors',0);
require("mb-config.php");

if(!empty($_REQUEST['type']))
	$type		= $_REQUEST['type'];
else
	$type		= "";

if(!empty($_REQUEST['encoding']))
	$encoding		= $_REQUEST['encoding'];
else
	$encoding		= "UTF-8";


if(function_exists('mb_internal_encoding')) mb_internal_encoding($encoding);

function checkImagePath($path){
	$size		= "";
	if(!empty($_REQUEST['size']))
		$size		= $_REQUEST['size'];

	if($size=="small"){
		if(function_exists('mb_substr')) $small_path		= mb_substr($path,0,mb_strrpos($path, ".",0))."_small".mb_substr($path,mb_strrpos($path, ".",0),mb_strlen($path));
		else $small_path		= substr($path,0,strrpos($path, "."))."_small".substr($path,strrpos($path, "."),strlen($path));		
		if(is_file($small_path)) $path		= $small_path;
	}
	return $path;
}

if(!empty($_REQUEST['path'])){
	$path				= $_REQUEST['path'];
	if($type=="download") $path				= base64_decode($path);
	$path				= trim($path);
	$path				= strip_tags($path);
	$path				= str_replace("\\","",$path);	
	$path				= str_replace("#","＃",$path);
	$path				= str_replace("%","％",$path);

	$file_name		= basename($path);
	$file_array		= explode('.',$file_name);
	$file_ext			= array_pop($file_array);
	$file_ext			= strtolower($file_ext);

	$path				= str_replace($file_name,"",$path);	
	$path				= str_replace(".","",$path).$file_name;
	$file_path		= "../../../uploads/mangboard/".$path;

	if(is_file($file_path)){
		if($type=="download"){
			$check_ext		= $mb_board_upload_files;
		}else{
			$check_ext		= $mb_image_upload_files;
		}

		if(in_array($file_ext, $check_ext)){
			if($file_ext=="php") exit;
			if(strpos($file_name, '_')!==false){
				if(function_exists('mb_substr')) $file_name		= mb_substr($file_name,mb_strpos($file_name, '_',0)+1, mb_strlen($file_name));
				else $file_name		= substr($file_name,strpos($file_name, '_')+1, strlen($file_name));
			}
			if($type=="download"){			
				header("Content-type: application/unknown");
				if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE")>0){
					header("Content-Disposition: attachment; filename=".rawurlencode($file_name));	
				}else{
					header("Content-Disposition: attachment; filename=".($file_name));
				}
				readfile(checkImagePath($file_path));
			}else{
				header("Content-type: image/".$file_ext);
				header("Content-Disposition: inline; filename=".rawurlencode($file_name));			
				header('Location: '. checkImagePath($file_path));
			}
		}
	}
}
exit;
?>