<?php
$editor_type							= "S";
$editor_name							= "Smart Editor";
$mb_editors[$editor_type]			= array("type"=>$editor_type,"name"=>$editor_name,"script"=>"if(typeof(oEditors)!=='undefined'){ oEditors.getById[mb_options['table_prefix']+'i_content'].exec('UPDATE_CONTENTS_FIELD', []);}; sendBoardWriteData();");

if(!function_exists('mbw_load_editor_s')){
	function mbw_load_editor_s(){		
		if(mbw_get_trace("mbw_load_editor_s")==""){
			mbw_add_trace("mbw_load_editor_s");
			wp_enqueue_script('smart-editor-js');
		}
	}
}
add_action('mbw_load_editor_'.$editor_type, 'mbw_load_editor_s',1); 
if(!function_exists('mbw_editor_smart_init')){
	function mbw_editor_smart_init(){
		if(mbw_get_vars("device_type")=="desktop"){
			wp_register_script('smart-editor-js', MBW_PLUGIN_URL.'plugins/editors/smart/js/HuskyEZCreator.js');
		}else{
			wp_register_script('smart-editor-js', MBW_PLUGIN_URL.'plugins/editors/smart/js/HuskyEZCreator_mobile.js');
		}
		
		if(mbw_get_board_option("fn_editor_type")=="S" && mbw_get_param("mode")=="write"){			
			mbw_load_editor_s();			
		}
	}
}
add_action('wp_enqueue_scripts', 'mbw_editor_smart_init',5);
add_action('admin_enqueue_scripts', 'mbw_editor_smart_init',5);

if(!function_exists('mbw_editor_smart_template')){
	function mbw_editor_smart_template($action, $data){
		
		/*if(mbw_get_vars("device_type")=="mobile" || mbw_get_vars("device_type")=="tablet"){		
			if(function_exists('mbw_editor_ck_template')){
				mbw_editor_ck_template($action, $data);
				echo '<script type="text/javascript">setEditorType("C");</script>';
			}else{
				echo mbw_get_default_editor($data);
			}
		}else */{
			if(mbw_get_trace("mbw_load_editor_s")==""){
				mbw_load_editor_s();
			}
			$item_html		= "";
			mbw_set_board_option("fn_editor_type","S");
			if(empty($data["width"])) $data["width"]			= '100%';
			if(empty($data["height"])) $data["height"]		= '360px';
			$editor_skin		= "SmartEditor2Skin.html";

			if(mbw_get_vars("device_type")!="desktop") $editor_skin		= "SmartEditor2Skin_mobile.html";

			$item_html		= "";
			$item_html		.= '<input type="hidden" name="'.mbw_set_form_name("data_type").'" id="data_type" value="html" />';
			$item_html		.= '<textarea'.$data["ext"].__STYLE("width:".$data["width"].";height:".$data["height"].";".$data["style"].";visibility:hidden;").' name="'.$data["item_name"].'" id="'.$data["item_id"].'" title="'.$data["name"].'">'.$data["value"].'</textarea>';
			$item_html		.= '<script type="text/javascript">var oEditors=[];jQuery(document).ready(function(){nhn.husky.EZCreator.createInIFrame({oAppRef: oEditors,elPlaceHolder: "'.$data["item_id"].'",sSkinURI:"'.MBW_PLUGIN_URL.'plugins/editors/smart/'.$editor_skin.'",fCreator: "createSEditor2"});});</script>';		
			echo $item_html;
		}	
	}
}
add_action('mbw_editor_'.$editor_type, 'mbw_editor_smart_template',1,2); 

?>