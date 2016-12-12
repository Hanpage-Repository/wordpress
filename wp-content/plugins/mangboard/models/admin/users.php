<?php
$desktop_model				= array();
$tablet_model				= array();
$mobile_model			= array();
$desktop_model['version']	= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"50px","level":"10","class":"list_check"},
{"field":"fn_user_id","name":"아이디","width":"","width":"100px","mobile_width":"70px","link":"view"},
{"field":"fn_user_name","name":"이름","width":"100px","type":"text","mobile_width":"70px"},
{"field":"fn_user_level","name":"레벨","width":"50px","type":"select","data":"1,2,3,4,5,6,7,8,9,10","default":"1","description":""},
{"field":"fn_user_group","name":"그룹","width":"70px","type":"text","responsive":"mb-hide-mobile mb-hide-tablet"},
{"field":"fn_user_email","name":"이메일","width":"170px","type":"text","responsive":"mb-show-desktop-large"},
{"field":"fn_login_count","name":"로그인","width":"40px","responsive":"mb-hide-mobile"},
{"field":"fn_write_count","name":"글쓰기","width":"40px","responsive":"mb-hide-mobile"},
{"field":"fn_reply_count","name":"답변","width":"40px","responsive":"mb-hide-mobile"},
{"field":"fn_comment_count","name":"댓글","width":"40px","responsive":"mb-hide-mobile"},
{"field":"fn_user_point","name":"포인트","width":"70px","responsive":"mb-hide-mobile mb-hide-tablet"},
{"field":"fn_last_login","name":"가입/최종 접속일","width":"130px","type":"admin_reg_date_last_login","responsive":"mb-hide-mobile mb-hide-tablet","search":"false"},
{"field":"admin_btn","name":"","name_btn":"수정","width":"60px","type":"admin_option_modify"}
';



$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"15%,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_user_id","name":"아이디","width":"300px"},
{"field":"fn_user_name","name":"이름","width":"300px","type":"view"},
{"field":"fn_user_state","name":"상태 메시지","width":"300px"},
{"field":"fn_user_level","name":"레벨","width":"300px"},
{"field":"fn_user_group","name":"그룹","width":"300px"},
{"field":"fn_user_email","name":"이메일","width":"300px"},
{"field":"fn_user_point","name":"포인트","width":"300px"},
{"field":"fn_user_money","name":"코인","width":"300px"},
{"field":"fn_user_birthday","name":"생년월일","width":"300px"},
{"field":"fn_user_phone","name":"휴대폰","width":"300px"},
{"field":"fn_user_picture","name":"사진","width":"60px","type":"img"},
{"field":"fn_user_messenger","name":"메신져","width":"300px"},
{"field":"fn_user_homepage","name":"홈페이지","width":"300px"},
{"field":"fn_user_blog","name":"블로그","width":"300px"},
{"type":"user_home_address","name":"집 주소","width":"300px"},
{"field":"fn_home_tel","name":"집 전화","width":"300px"},

{"field":"fn_allow_mailing","name":"이메일 허용","width":"300px"},
{"field":"fn_allow_message","name":"쪽지 허용","width":"300px"},
{"field":"fn_login_count","name":"로그인수","width":"300px"},
{"field":"fn_write_count","name":"글쓰기수","width":"300px"},
{"field":"fn_reply_count","name":"답변수","width":"300px"},
{"field":"fn_comment_count","name":"댓글수","width":"300px"},
{"field":"fn_reg_mail","name":"메일 인증","width":"300px"},
{"field":"fn_reg_date","name":"가입 시간","width":"300px"},
{"field":"fn_last_login","name":"최종 접속일","width":"300px"},
{"field":"fn_user_memo","name":"회원 메모","width":"300px"},
{"field":"fn_admin_memo","name":"관리자 메모","level":"10","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';


$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"회원 정보 편집","width":"15%,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_user_id","name":"아이디","width":"300px","required":"(*)","required_action":"write","unique":"","modify":"static","maxlength":"20","pattern":"pattern_en_num_4ge","pattern_error":"아이디는 영문으로 시작하는 4~20자<br> \'영문\',\'숫자\',\'_\' 조합이여야 합니다"},
{"field":"fn_user_name","name":"이름","width":"300px","required":"(*)","maxlength":"30","pattern":"pattern_2ge","pattern_error":"이름은 최소 2자리 이상 입력하셔야 합니다"},
{"field":"fn_passwd","name":"비밀번호","width":"300px","type":"password","required":"(*)","maxlength":"16","pattern":"pattern_4ge","pattern_error":"비밀번호는 최소 4자리 이상 입력하셔야 합니다"},
{"field":"fn_user_group","name":"그룹","width":"300px","maxlength":"50"},
{"field":"fn_user_level","name":"레벨","width":"100px","type":"select","data":"1,2,3,4,5,6,7,8,9,10","default":"1","description":""},
{"field":"fn_user_email","name":"이메일","width":"300px","maxlength":"100"},
{"field":"fn_user_phone","name":"휴대폰","width":"300px"},
{"field":"fn_user_birthday","name":"생년월일","width":"300px"},
{"field":"fn_user_picture","name":"사진","width":"200px","type":"user_picture_upload"},
{"field":"fn_user_messenger","name":"메신져","width":"300px"},
{"field":"fn_user_homepage","name":"홈페이지","width":"600px"},
{"field":"fn_user_blog","name":"블로그","width":"600px"},
{"field":"fn_home_tel","name":"집 전화","width":"300px"},
{"type":"user_address_info","name":"주소","width":"100%"},
{"field":"fn_user_state","name":"상태 메시지","width":"600px","maxlength":"100"},
{"field":"fn_user_memo","name":"회원 메모","width":"600px","type":"textarea"},
{"field":"fn_admin_memo","name":"관리자 메모","level":"10","width":"600px","type":"textarea"},
{"tpl":"tag","tag_name":"table","type":"end"}
';


$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;
mbw_set_fields("select_board",$mb_fields["users"]);

mbw_set_pattern("pattern_en_num_4ge","/^[a-z]+[a-z0-9_]{3,19}$/i");
mbw_set_pattern("pattern_2ge","/^.{2,}$/");
mbw_set_pattern("pattern_4ge","/^.{4,}$/");

$mb_words["Write"]		= "W_USER_INSERT";

function mbw_user_synchronize(){	
	global $mstore;
	if(mbw_is_admin() && mbw_get_param("board_action")=="user_wp_synchronize"){
		$synchronize_count		= mbw_synchronize_wp_user_data();
		if($synchronize_count>0){
			$mstore->set_result_data(array("message"=>$synchronize_count."명의 회원이 동기화 되었습니다"));
		}else{
			$mstore->set_result_data(array("message"=>"동기화 가능한 회원이 존재하지 않습니다"));
		}
	}
}
add_action('mbw_board_api_body', 'mbw_user_synchronize',5);

function mbw_get_synchronize_template(){
	echo '<div class="border-bottom-ccc-1" style="margin-bottom:10px !important;padding:10px 0 !important;text-align:right;">';
	echo mbw_get_btn_template(array("name"=>"워드프레스 회원 동기화","onclick"=>"sendBoardListData({'board_action':'user_wp_synchronize'})","class"=>"btn btn-default btn-search margin-left-5"));
	echo '<span class="description"><br>(망보드 회원 데이타에 등록되지 않은 워드프레스 회원 데이타를 가져옵니다)</span>';
	echo '</div>';
}

if(mbw_is_admin_page()){		//어드민 페이지에서만 실행
	if(mbw_get_request_mode()=="Frontend"){		// 게시판 모드일 경우에만
		if(strtoupper(mbw_get_option("user_mode"))=="WP"){			
			add_action('mbw_board_skin_search', 'mbw_get_synchronize_template');
		}
	}
}

?>