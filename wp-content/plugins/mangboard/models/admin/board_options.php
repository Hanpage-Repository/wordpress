<?php
$desktop_model					= array();
$tablet_model					= array();
$mobile_model				= array();
$desktop_model['version']		= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"40px","level":"10","class":"list_check"},
{"field":"fn_board_name2","name":"게시판 이름","width":"","type":"admin_board_name","td_class":"text-left"},
{"field":"fn_skin_name","name":"스킨/모델","width":"130px","type":"admin_skin_model","responsive":"mb-hide-mobile mb-hide-tablet"},
{"type":"admin_board_level","name":"권한","width":"160px","td_class":"text-left","responsive":"mb-hide-mobile mb-hide-tablet"},
{"type":"admin_board_analytics","name":"게시물 현황","width":"80px","responsive":"mb-hide-mobile"},
{"field":"admin_btn","name":"","name_btn":"설정","width":"60px","type":"admin_board_modify"}
';


$desktop_model['view']		= '
{"tpl":"tag","tag_name":"div","text":"<strong>■ 게시판 설정</strong>","style":""},
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"20%,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_board_name2","name":"게시판 이름","width":"300px"},
{"field":"fn_description","name":"게시판 설명","width":"300px"},

{"field":"fn_skin_name","name":"스킨 이름","width":"250px"},
{"field":"fn_model_name","name":"모델 이름","width":"250px","type":"admin_select_model_list","attribute":"disabled=\'true\'"},
{"field":"fn_editor_type","name":"에디터 설정","width":"250px","type":"admin_select_editor_list","attribute":"disabled=\'true\'"},
{"field":"fn_page_size","name":"목록 개수","width":"200px","format":"count"},
{"field":"fn_comment_size","name":"댓글 개수","width":"200px","format":"count"},
{"field":"fn_block_size","name":"페이지 블럭 개수","width":"200px","format":"count"},
{"field":"fn_use_list_title","name":"목록 제목바 표시","width":"100px","data":"1,0","label":"사용,사용안함","default":"1","attribute":"disabled=\'true\'"},
{"field":"fn_use_comment","name":"댓글 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"1","attribute":"disabled=\'true\'"},
{"field":"fn_use_notice","name":"공지 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"1","attribute":"disabled=\'true\'"},
{"field":"fn_use_secret","name":"비밀글 기능","width":"100px","data":"1,2,0","label":"사용(선택),사용(필수),사용안함","default":"1","attribute":"disabled=\'true\'"},
{"field":"fn_post_id","name":"워드프레스 Post ID","width":"100px"},
{"field":"fn_table_link","name":"게시판 연결","width":"195px","type":"admin_select_board_link","data":"","label":"","class":"ext1","combo":{"field":"fn_table_link2","width":"200px","match_type":"show","match_value":"custom"},"attribute":"disabled=\'true\'"},
{"field":"fn_category_type","name":"카테고리 기능","width":"400px","type":"select","data":"NONE,TAB_RELOAD,TAB_AJAX,SELECT_NONE,SELECT_RELOAD,SELECT_AJAX","label":"사용안함,탭메뉴 (탭메뉴 클릭시 새로고침),탭메뉴 (탭메뉴 클릭시 AJAX 방식으로 데이타 불러옴),SELECT (검색 버튼 클릭시에만 카테고리 적용),SELECT (카테고리 변경시 새로고침),SELECT (카테고리 변경시 AJAX 방식으로 데이타 불러옴)","default":"NONE","attribute":"disabled=\'true\'"},
{"field":"fn_category_data","name":"카테고리 데이타","width":"600px"},
{"field":"fn_board_header","name":"게시판 상단 내용","width":"600px"},
{"field":"fn_board_footer","name":"게시판 하단 내용","width":"600px"},
{"field":"fn_board_content_form","name":"글쓰기 폼","width":"600px"},
{"tpl":"tag","tag_name":"table","type":"end"},

{"tpl":"tag","tag_name":"div","text":"<strong>■ 추천/비추천 기능 설정</strong>","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"추천/비추천 기능 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},

{"field":"fn_use_board_vote_good","name":"게시판 추천 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"0","attribute":"disabled=\'true\'"},
{"field":"fn_use_board_vote_bad","name":"게시판 비추천 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"0","attribute":"disabled=\'true\'"},
{"field":"fn_use_comment_vote_good","name":"댓글 추천 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"0","attribute":"disabled=\'true\'"},
{"field":"fn_use_comment_vote_bad","name":"댓글 비추천 기능","width":"100px","data":"1,0","label":"사용,사용안함","default":"0","attribute":"disabled=\'true\'"},
{"tpl":"tag","tag_name":"table","type":"end"},

{"tpl":"tag","tag_name":"div","text":"<strong>■ 게시판 권한 설정</strong> (0:비회원, 1~10:회원, 10:관리자)","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"게시판 권한 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},
{"field":"fn_list_level","name":"목록 권한","width":"100px","format":" Level"},
{"field":"fn_write_level","name":"글쓰기 권한","width":"100px","format":" Level"},
{"field":"fn_view_level","name":"글보기 권한","width":"100px","format":" Level"},
{"field":"fn_reply_level","name":"답변 권한","width":"100px","format":" Level"},
{"field":"fn_comment_level","name":"댓글 권한","width":"100px","format":" Level"},
{"field":"fn_modify_level","name":"수정 권한","width":"100px","format":" Level"},
{"field":"fn_secret_level","name":"비밀글 권한","width":"100px","format":" Level"},
{"field":"fn_delete_level","name":"삭제 권한","width":"100px","format":" Level"},
{"field":"fn_manage_level","name":"관리 권한","width":"100px","format":" Level"},

{"tpl":"tag","tag_name":"table","type":"end"},

{"tpl":"tag","tag_name":"div","text":"<strong>■ 포인트 설정</strong>","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"포인트 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},
{"field":"fn_point_board_read","name":"읽기 포인트","width":"100px","format":"point"},
{"field":"fn_point_board_write","name":"쓰기 포인트","width":"100px","format":"point"},
{"field":"fn_point_board_reply","name":"답변 포인트","width":"100px","format":"point"},
{"field":"fn_point_comment_write","name":"댓글 포인트","width":"100px","format":"point"},

{"tpl":"tag","tag_name":"table","type":"end"}
';

$desktop_model['write']		= '
{"tpl":"tag","tag_name":"div","text":"<strong>■ 게시판 설정</strong>","style":""},
{"tpl":"tag","tag_name":"table","type":"start","name":"게시판 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_board_name2","name":"게시판 이름","width":"250px","required":"(*)","unique":"","modify":"text_static","maxlength":"30","pattern":"pattern_en_num_4ge","pattern_error":"게시판 이름은 영문으로 시작하는 4~30자<br> \'영문\',\'숫자\',\'_\' 조합이여야 합니다","description":"<br>(게시판 이름은 영문으로 시작하는 4~30자 \'영문\',\'숫자\',\'_\' 조합으로 입력합니다)"},
{"field":"fn_description","name":"게시판 설명","width":"400px","description":"<br>(게시판에 대한 간단한 설명을 입력합니다)"},
{"field":"fn_board_type","name":"게시판 타입","type":"hidden","default":"board","display":"hide"},
{"field":"fn_skin_name","name":"스킨 이름","width":"250px","type":"admin_select_skin_list"},
{"field":"fn_model_name","name":"모델 이름","width":"250px","type":"admin_select_model_list","description":"<br>(\'models\' 폴더에 있는 게시판 모델을 설정할 수 있으며,  \'skin-model\'은 skins/스킨/includes/skin-model.php 파일을 선택합니다)"},
{"field":"fn_editor_type","name":"에디터 설정","width":"250px","type":"admin_select_editor_list","default":"S","description":"<br>(글쓰기 화면에서 내용 입력시 사용할 에디터를 선택합니다)"},

{"field":"fn_page_size","name":"목록 개수","width":"100px","type":"select","data":"1,2,3,4,5,6,7,8,9,10,15,20,25,30,50,100","default":"20","description":"<br>(한페이지에서 보여줄 게시물 개수를 설정합니다)"},
{"field":"fn_comment_size","name":"댓글 개수","width":"100px","type":"select","data":"1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40,45,50","default":"50","description":"<br>(한페이지에서 보여줄 댓글 개수를 설정합니다)"},
{"field":"fn_block_size","name":"페이지 블럭 개수","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10,100","default":"10","description":"<br>(페이지 블럭 개수를 설정합니다, 100으로 설정시 \"더보기\" 버튼 방식으로 변경됩니다)"},
{"field":"fn_use_list_title","name":"목록 제목바 표시","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"1","description":"<br>(게시물 목록에서 제목바 표시여부를 설정합니다)"},
{"field":"fn_use_comment","name":"댓글 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"1"},
{"field":"fn_use_notice","name":"공지 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"1"},
{"field":"fn_use_secret","name":"비밀글 기능","width":"100px","type":"select","data":"1,2,0","label":"사용(선택),사용(필수),사용안함","default":"1"},
{"field":"fn_post_id","name":"워드프레스 Post ID","width":"100px","write":"none","description":"<br>(망보드 Shortcode가 들어있는 워드프레스 Post ID를 입력합니다)"},
{"field":"fn_table_link","name":"게시판 연결","width":"195px","type":"admin_select_board_link","data":"","label":"","class":"ext1","combo":{"field":"fn_table_link2","width":"200px","match_type":"show","match_value":"custom"},"description":"<br>(게시판 연결은 기존에 생성한 게시판의 내용을 설정만 바꿔서 불러올 수 있는 기능입니다. \'연결안함\'을 선택할 경우 게시판 테이블을 새로 생성합니다)"},
{"field":"fn_category_type","name":"카테고리 기능","width":"400px","type":"select","data":"NONE,TAB_RELOAD,TAB_AJAX,SELECT_NONE,SELECT_RELOAD,SELECT_AJAX","label":"사용안함,탭메뉴 (탭메뉴 클릭시 새로고침),탭메뉴 (탭메뉴 클릭시 AJAX 방식으로 데이타 불러옴),SELECT (검색 버튼 클릭시에만 카테고리 적용),SELECT (카테고리 변경시 새로고침),SELECT (카테고리 변경시 AJAX 방식으로 데이타 불러옴)","default":"NONE","description":"<br>(카테고리 데이타를 보여줄 방식을 선택합니다)"},
{"field":"fn_category_data","name":"카테고리 데이타","width":"600px","type":"textarea","description":"<br>1단 (쉼표로 구분) : 111,222,333,444,555,666,777<br>2~3단 (JSON 타입) : { \"100\":{\"110\":{\"111\":\"111\",\"112\":\"112\"},\"120\":\"120\"}, \"200\":{\"210\":{\"211\":\"211\",\"212\":\"212\"},\"220\":\"220\"}, \"300\":\"300\"}"},
{"field":"fn_board_header","name":"게시판 상단 내용","width":"600px","type":"textarea","description":"<br>(게시판 상단에 보여줄 HTML 태그를 입력합니다)"},
{"field":"fn_board_footer","name":"게시판 하단 내용","width":"600px","type":"textarea","description":"<br>(게시판 하단에 보여줄 HTML 태그를 입력합니다)"},
{"field":"fn_board_content_form","name":"글쓰기 폼","width":"600px","type":"textarea","description":"<br>(글쓰기에서 기본으로 보여줄 글쓰기 폼을 입력합니다)"},
{"tpl":"tag","tag_name":"table","type":"end"},

{"tpl":"tag","tag_name":"div","text":"<strong>■ 추천/비추천 기능 설정</strong>","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"추천/비추천 기능 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},
{"field":"fn_use_board_vote_good","name":"게시판 추천 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"0"},
{"field":"fn_use_board_vote_bad","name":"게시판 비추천 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"0"},
{"field":"fn_use_comment_vote_good","name":"댓글 추천 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"0"},
{"field":"fn_use_comment_vote_bad","name":"댓글 비추천 기능","width":"100px","type":"select","data":"1,0","label":"사용,사용안함","default":"0"},
{"tpl":"tag","tag_name":"table","type":"end"},

{"tpl":"tag","tag_name":"div","text":"<strong>■ 게시판 권한 설정</strong> (0:비회원, 1~10:회원, 10:관리자)","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"게시판 권한 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},
{"field":"fn_list_level","name":"목록 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"0","description":"<br>(게시물 목록을 볼 수 있는 권한을 설정합니다)"},
{"field":"fn_write_level","name":"글쓰기 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"0","description":"<br>(글쓰기 권한을 설정합니다)"},
{"field":"fn_view_level","name":"글보기 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"0","description":"<br>(글보기 권한을 설정합니다)"},
{"field":"fn_reply_level","name":"답변 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"0","description":"<br>(답변 권한을 설정합니다)"},
{"field":"fn_comment_level","name":"댓글 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"0","description":"<br>(댓글 권한을 설정합니다)"},
{"field":"fn_modify_level","name":"수정 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"8","description":"<br>(다른 사용자가 작성한 글을 수정할 수 있는 권한을 설정합니다)"},
{"field":"fn_secret_level","name":"비밀글 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"8","description":"<br>(다른 사용자의 비밀글을 볼 수 있는 권한을 설정합니다)"},
{"field":"fn_delete_level","name":"삭제 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"8","description":"<br>(다른 사용자의 게시물을 삭제할 수 있는 권한을 설정합니다)"},
{"field":"fn_manage_level","name":"관리 권한","width":"100px","type":"select","data":"0,1,2,3,4,5,6,7,8,9,10","default":"8","description":"<br>(게시물 복사, 이동 등 게시판을 관리 할 수 있는 권한을 설정합니다)"},
{"tpl":"tag","tag_name":"table","type":"end"},


{"tpl":"tag","tag_name":"div","text":"<strong>■ 포인트 설정</strong>","style":"margin-top:20px;"},
{"tpl":"tag","tag_name":"table","type":"start","name":"포인트 설정","width":"20%,*","mobile_width":"90px,*","class":"table table-view","style":""},
{"field":"fn_point_board_write","name":"쓰기 포인트","width":"100px","default":"0","maxlength":"5","event":"onkeydown=\"return inputOnlyNumber(event)\"","description":"<br>(글작성시 지급할 포인트를 입력합니다)"},
{"field":"fn_point_board_reply","name":"답변 포인트","width":"100px","default":"0","maxlength":"5","event":"onkeydown=\"return inputOnlyNumber(event)\"","description":"<br>(답변 작성시 지급할 포인트를 입력합니다)"},
{"field":"fn_point_comment_write","name":"댓글 포인트","width":"100px","default":"0","maxlength":"5","event":"onkeydown=\"return inputOnlyNumber(event)\"","description":"<br>(댓글 작성시 지급할 포인트를 입력합니다)"},

{"tpl":"tag","tag_name":"table","type":"end"}
';



$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;
mbw_set_fields("select_board",$mb_fields["board_options"]);

if(mbw_get_param("show")=="all"){
	mbw_set_param("page_size",100);	
}else{
	mbw_set_board_where(array("field"=>"fn_is_show", "value"=>"1"));
}

mbw_set_pattern("pattern_en_num_4ge","/^[a-z]+[a-z0-9_]{3,29}$/i");



function mbw_board_options_api_body(){	
	global $mdb,$mb_fields,$mb_admin_tables,$mstore;
	$where_query			= "";
	$query_command	= "";
	$field						= $mb_fields["board_options"];
	if(mbw_is_admin()){
		//게시판 추가시 디비 테이블 추가 액션
		if(mbw_get_param("board_action")=="write"){		
			$query_command												= "INSERT";	
			if(empty($_POST["table_link"]) && mbw_get_param("board_name2")!=""){
				$board_table_name			= mbw_get_table_name(mbw_get_param("board_name2"),"board","mb");

				if(!$mstore->table_exists($board_table_name))	//게시판 테이블이 존재하지 않으면
					mbw_create_board_table(mbw_get_param("board_name2"));		//게시판 테이블 생성
			}
		//게시판 삭제시 디비 테이블 삭제하는 액션
		}else if(mbw_get_param("board_action")=="delete"){
			$query_command		= "DELETE";	
			$where_query				= $mdb->prepare(" WHERE ".$field["fn_pid"]."=%d", mbw_get_param("board_pid") );
		}else if(mbw_get_param("board_action")=="multi_delete"){
			$query_command		= "DELETE";	
			$pid_array					= mbw_get_param("check_array");		
			$pid_format				= array();
			foreach($pid_array as $key){
				$pid_format[]			= "%d";
			}
			$where_query				= $mdb->prepare(" WHERE ".$field["fn_pid"]." in (".implode(",",$pid_format).")", $pid_array );	
		}

		if($query_command=="DELETE"){
			$select_query				= "SELECT * FROM ".$mb_admin_tables["board_options"].$where_query;
			$items						= $mdb->get_results($select_query,ARRAY_A);

			foreach($items as $item){
				if($item[$field["fn_table_link"]]=="" && $item[$field["fn_board_type"]]=="board"){
					$board_table_name			= mbw_get_table_name($item[$field["fn_board_name2"]]);
					$comment_table_name		= mbw_get_table_name($item[$field["fn_board_name2"]],"comment");

					if($mstore->table_exists($board_table_name))	mbw_drop_query($board_table_name);
					if($mstore->table_exists($comment_table_name))	mbw_drop_query($comment_table_name);				
				}
			}	
		}
	}
}
add_action('mbw_board_api_body', 'mbw_board_options_api_body',5); 


function mbw_board_options_api_init(){	
	//게시판 연결 기능시 table_link2 데이타를 table_link에 설정
	if(mbw_get_param("table_link")=="custom"){
		mbw_set_param("table_link",mbw_get_param("table_link2"));
		mbw_set_param("use_comment","0");
		mbw_set_param("board_type","custom");
	}else if(mbw_get_param("table_link")!=""){
		mbw_set_param("board_type","link");
	}
}
add_action('mbw_board_api_init', 'mbw_board_options_api_init',5); 


function mbw_board_options_skin_header(){	
	//게시판 설정 복사
	if(mbw_get_param("board_action") == "write" && mbw_get_param("board_pid")!="") {
		$select_query				= mbw_get_add_query(array("column"=>"*"), array(array("field"=>"fn_pid","value"=>mbw_get_param("board_pid"))));
		$board_item				= mbw_get_board_item_query($select_query);
		mbw_set_board_item("fn_board_name2","");
	}
}
add_action('mbw_board_skin_header', 'mbw_board_options_skin_header',5); 


mbw_set_category_fields(array("fn_board_type"));		//카테고리 필드 수정
if(mbw_is_admin_page()){		//어드민 페이지에서만 실행	
	if(mbw_get_request_mode()=="Frontend"){		// 게시판 모드일 경우에만
		//카테고리 데이타 수정
		$category		= $mdb->get_distinct_values($mb_admin_tables["board_options"],$mb_fields["board_options"]["fn_board_type"],array(array("field"=>$mb_fields["board_options"]["fn_is_show"],"value"=>"1")));		//board_type 필드에서 고유한 값을 배열로 가져옴

		if(!empty($category)) mbw_set_board_option("fn_category_data", implode(",",$category));
	}
}

$mb_words["Write"]		= "W_BOARD_INSERT";

?>