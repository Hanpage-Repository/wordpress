<?php
$desktop_model					= array();
$tablet_model					= array();
$mobile_model				= array();
$desktop_model['version']		= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"50px","level":"10","class":"list_check"},
{"field":"fn_option_title","name":"구 분","width":"200px","mobile_width":"80px","type":"title","td_class":"text-left"},
{"field":"fn_option_value","name":"내 용","width":"","type":"db_type","type_field":"fn_option_type","data_field":"fn_option_data","label_field":"fn_option_label","style_field":"fn_option_style","class_field":"fn_option_class","event_field":"fn_option_event","attribute_field":"fn_option_attribute","description_field":"fn_description","td_class":"text-left"},
{"field":"admin_btn","name":"","name_btn":"수정","width":"60px","type":"admin_option_modify"}
';


//글보기 스킨 수정
$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"200px,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_option_title","name":"구 분","width":"300px","type":"title"},
{"field":"fn_option_name","name":"옵션 이름","width":"300px"},
{"field":"fn_option_value","name":"옵션 값","width":"300px"},
{"field":"fn_option_type","name":"INPUT 타입","width":"300px"},
{"field":"fn_option_label","name":"INPUT 옵션 이름","width":"600px"},
{"field":"fn_option_data","name":"INPUT 옵션 값","width":"600px"},
{"field":"fn_option_style","name":"INPUT Style 설정","width":"600px"},
{"field":"fn_option_class","name":"INPUT Class 설정","width":"600px"},
{"field":"fn_option_event","name":"INPUT Event 설정","width":"600px"},
{"field":"fn_option_attribute","name":"INPUT Attribute 설정","width":"600px"},
{"field":"fn_description","name":"옵션 설명","width":"600px"},
{"field":"fn_option_category","name":"카테고리","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

//글작성 스킨 수정
$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글쓰기","width":"200px,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_option_title","name":"구 분","width":"300px","type":"title"},
{"field":"fn_option_name","name":"옵션 이름","width":"300px"},
{"field":"fn_option_value","name":"옵션 값","width":"300px"},
{"field":"fn_option_type","name":"INPUT 타입","width":"300px","description":"<br>옵션 입력을 받을 Input 태그 설정 (text,select,textarea,radiobox)"},
{"field":"fn_option_label","name":"INPUT 옵션 이름","width":"600px","description":"<br>사용,미사용 (INPUT 타입이 select,radiobox 일 경우에만 사용)"},
{"field":"fn_option_data","name":"INPUT 옵션 값","width":"600px","description":"<br>true,false (INPUT 타입이 select,radiobox 일 경우에만 사용)"},
{"field":"fn_option_style","name":"INPUT Style 설정","width":"600px","description":"<br>옵션 INPUT 타입에 Style 설정"},
{"field":"fn_option_class","name":"INPUT Class 설정","width":"600px","description":"<br>옵션 INPUT 타입에 Class 설정"},
{"field":"fn_option_event","name":"INPUT Event 설정","width":"600px","description":"<br>옵션 INPUT 타입에 Event 설정"},
{"field":"fn_option_attribute","name":"INPUT Attribute 설정","width":"600px","description":"<br>옵션 INPUT 타입에 Attribute 설정"},

{"field":"fn_description","name":"옵션 설명","width":"600px"},
{"field":"fn_option_category","name":"카테고리","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;
mbw_set_fields("select_board",$mb_fields["options"]);

if(mbw_get_param("show")=="all"){
	mbw_set_param("page_size",100);	
}else{
	mbw_set_board_where(array("field"=>"fn_is_show", "value"=>"1"));
}


function mbw_options_api_footer(){	
	mbw_options_meta_refresh();	
}
add_action('mbw_board_api_footer', 'mbw_options_api_footer',5); 




function mbw_board_options_skin_footer(){	
	echo '<script type="text/javascript">jQuery(document).ready(function(){ jQuery(".mb-tr-hide").closest("tr").hide();});</script>';		
}
add_action('mbw_board_skin_footer', 'mbw_board_options_skin_footer',5); 


mbw_set_category_fields(array("fn_option_category"));		//카테고리 필드 수정
if(mbw_is_admin_page()){		//어드민 페이지에서만 실행	
	if(mbw_get_request_mode()=="Frontend"){		// 게시판 모드일 경우에만
		//카테고리 데이타 수정
		$category		= $mdb->get_distinct_values($mb_admin_tables["options"],$mb_fields["options"]["fn_option_category"]);		//option_category 필드에서 고유한 값을 배열로 가져옴
		if(!empty($category)) mbw_set_board_option("fn_category_data", implode(",",$category));
	}
}


?>