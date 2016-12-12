<?php
//템플릿 함수 등록(템플릿 타입의 접두사, 템플릿 함수명)
if(function_exists('mbw_add_template')) mbw_add_template("kcaptcha","mbw_get_kcaptcha_template");

if(!function_exists('mbw_get_kcaptcha_template')){
	function mbw_get_kcaptcha_template($mode, $data){
		$template_start		= '';
		$item_type				= $data["type"];
		
		if($item_type=='kcaptcha_img'){
			if(empty($data["width"])) $data["width"]			= "60px";
			if(empty($data["height"])) $data["height"]		= "42px";
			$item_id				= "mb_kcaptcha";

			if(function_exists("imagejpeg") || function_exists("imagepng") || function_exists("imagegif")){
				$template_start	= '<img'.__STYLE("width:80px;height:32px;vertical-align:top;").' onclick="mb_reloadImage()" class="cursor_pointer" src="'.mbw_get_option("kcaptcha_image_url").'?mode='.$mode.'&board_action='.mbw_get_param("board_action").'" id="'.$item_id.'" class="border-ccc-1"/>';				
			}else{
				$session = @session_id();
				if(empty($session)) @session_start();

				if(!empty($_GET["mode"])){
					$mode		= $_GET["mode"];
					if(!empty($_GET["board_action"]))
						$mode		= $mode."_".$_GET["board_action"];
				}else
					$mode		= "mb";

				if(strpos($mode, 'comment') === false && isset($_SESSION[$mode.'_captcha_time']) && $_SESSION[$mode.'_captcha_time']>=time()-1) exit;

				$keystring												= rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
				$_SESSION[$mode.'_captcha_keystring']		= $keystring;
				$_SESSION[$mode.'_captcha_time']				= time();

				$template_start	.= '<input'.$data["ext"].__STYLE("width:".$data["width"].";height:".$data["height"]." !important;margin:0 !important;".$data["style"]).' maxlength="6" value="'.$keystring.'" type="text" readonly />';
			}
			$template_start	.= '<input'.$data["ext"].__STYLE("width:".$data["width"].";height:".$data["height"]." !important;".$data["style"]).' name="'.mbw_set_form_name($data["type"]).'" maxlength="6" id="'.$data["item_id"].'" value="'.$data["value"].'" type="text" />';
		}
		
		return $template_start;
	}
}
?>