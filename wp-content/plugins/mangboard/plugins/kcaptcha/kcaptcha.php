<?php
mbw_set_option("kcaptcha_image_url", MBW_PLUGIN_URL.'plugins/kcaptcha/kcaptcha_image.php');

function mbw_api_header_kcaptcha(){	
	if(!empty($_REQUEST["mode"])){
		$mode		= $_REQUEST["mode"];
		if(!empty($_REQUEST["board_action"]))
			$mode		= $mode."_".$_REQUEST["board_action"];
	} else $mode		= "mb";

	if(isset($_REQUEST['kcaptcha_img']) && $_REQUEST['kcaptcha_img']==""){
		mbw_error_message("MSG_FIELD_EMPTY_ERROR1", "W_KCAPTCHA","1201","kcaptcha_img");
	}else if(!empty($_REQUEST['kcaptcha_img'])){
		$session = @session_id();
		if(empty($session)) @session_start();

		if(!empty($_SESSION[$mode.'_captcha_keystring'])){
			if($_SESSION[$mode.'_captcha_keystring'] !== $_REQUEST['kcaptcha_img']){
				mbw_error_message("MSG_MATCH_ERROR", "W_KCAPTCHA","1206","kcaptcha_img");
			}
		}
	}
}
add_action('mbw_board_api_header', 'mbw_api_header_kcaptcha');
add_action('mbw_comment_api_header', 'mbw_api_header_kcaptcha');

?>
