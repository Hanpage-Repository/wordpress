<?php
$desktop_model					= array();
$tablet_model					= array();
$mobile_model				= array();
$desktop_model['version']		= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"50px","level":"10","class":"list_check"},
{"field":"fn_pid","name":"번호","width":"60px"},
{"field":"fn_board_name","name":"게시판 이름","width":"120px"},
{"field":"fn_cookie_type","name":"쿠키 타입","width":"140px"},
{"field":"fn_cookie_name","name":"쿠키 이름","width":"180px"},
{"field":"fn_cookie_value","name":"쿠키 값 ","width":""},
{"field":"fn_user_name","name":"회원 이름[Pid]","width":"120px","type":"admin_user_name_pid"},
{"field":"fn_agent","name":"Agent","width":"100px"},
{"field":"fn_ip","name":"IP","width":"140px"},
{"field":"fn_reg_date","name":"등록일","width":"150px"},
';

//글보기 스킨 수정
$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"20%,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_pid","name":"번호","width":"60px"},
{"field":"fn_board_name","name":"게시판 이름","width":"300px"},
{"field":"fn_cookie_type","name":"쿠키 타입","width":"300px"},
{"field":"fn_cookie_name","name":"쿠키 이름","width":"300px"},
{"field":"fn_cookie_value","name":"쿠키 값 ","width":"300px"},
{"field":"fn_user_pid","name":"회원 Pid ","width":"300px"},
{"field":"fn_agent","name":"Agent","width":"300px"},
{"field":"fn_ip","name":"IP","width":"300px"},
{"field":"fn_reg_date","name":"등록일","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';


//글작성 스킨 수정
$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글쓰기","width":"20%,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_board_name","name":"게시판 이름","width":"300px"},
{"field":"fn_cookie_type","name":"쿠키 타입","width":"300px"},
{"field":"fn_cookie_name","name":"쿠키 이름","width":"300px"},
{"field":"fn_cookie_value","name":"쿠키 값 ","width":"300px"},
{"field":"fn_user_pid","name":"회원 Pid ","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;
mbw_set_fields("select_board",$mb_fields["cookies"]);


if(mbw_is_admin_page()){		//어드민 페이지에서만 실행
	if(mbw_get_request_mode()=="Frontend"){		// 게시판 모드일 경우에만
		add_action('mbw_board_skin_search', 'mbw_get_date_search_template');		// 기간 설정 템플릿 추가
	}
}

?>