<?php
// 워드프레스 기본 에디터 액션 등록
$editor_type							= "W";
$editor_name							= "WP Editor";
$mb_editors[$editor_type]			= array("type"=>$editor_type,"name"=>$editor_name,"script"=>"if(typeof(tinyMCE)!=='undefined' && typeof(tinyMCE.get(mb_options['table_prefix']+'i_content').getContent)!=='undefined'){ jQuery('#data_type').val('html');sendBoardWriteData(tinyMCE.get(mb_options['table_prefix']+'i_content').getContent());}else{sendBoardWriteData();}");

if(!function_exists('mbw_load_editor_w')){
	function mbw_load_editor_w(){		
		if(mbw_get_trace("mbw_load_editor_w")==""){
			mbw_add_trace("mbw_load_editor_w");
		}
	}
}
add_action('mbw_load_editor_'.$editor_type, 'mbw_load_editor_w',1); 

if(!function_exists('mbw_editor_wp_template')){
	function mbw_editor_wp_template($action, $data){	
		if(mbw_get_trace("mbw_load_editor_w")==""){
			mbw_load_editor_w();
		}
		mbw_set_board_option("fn_editor_type","W");
		if(empty($data["height"])) $data["height"]		= '360px';

		$settings		= array('textarea_name' => $data["item_name"],'editor_height' =>$data["height"] ,'media_buttons' => false,'tinymce' => true,'quicktags' => false);
		wp_editor(mbw_htmlspecialchars_decode($data['value']), $data["item_id"], $settings);
		echo '<input type="hidden" name="data_type" id="data_type" value="html" />';
	}
}
add_action('mbw_editor_'.$editor_type, 'mbw_editor_wp_template',1,2);
?>