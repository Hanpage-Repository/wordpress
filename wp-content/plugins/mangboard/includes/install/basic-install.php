<?php
register_activation_hook(MBW_PLUGIN_FILE, 'mbw_basic_install_plugin');
 
// 테이블 생성 - Plugin 활성화 시
function mbw_basic_install_plugin(){	
	mbw_basic_install();	
	if(!is_dir(MBW_UPLOAD_PATH)){
		@mkdir(MBW_UPLOAD_PATH, 0707, true);		
		@chmod(MBW_UPLOAD_PATH, 0707);
	}	
}


function mbw_install_add_board_options($options,$name="mb_board_options"){
	$insert_prefix		= "INSERT INTO `".$name."` (`board_name`, `description`, `skin_name`, `model_name`, `table_link`, `mobile_skin_name`, `board_header`, `board_footer`, `board_content_form`, `editor_type`, `api_type`, `page_size`, `comment_size`, `block_size`, `category_type`, `category_data`, `use_board_vote_good`, `use_board_vote_bad`, `use_comment`, `use_comment_vote_good`, `use_comment_vote_bad`, `use_secret`, `use_notice`, `use_list_title`, `use_list_search`, `list_level`, `view_level`, `write_level`, `reply_level`, `delete_level`, `modify_level`, `secret_level`, `manage_level`, `comment_level`, `point_board_read`, `point_board_write`, `point_board_reply`, `point_comment_write`, `board_type`, `reg_date`, `is_show`) VALUES ";
	mbw_install_insert_query($insert_prefix,$options,$name,"board_name");
}
function mbw_install_add_options($options,$name="mb_options"){
	$insert_prefix		= "INSERT INTO `".$name."` (`option_load`, `option_category`, `option_title`, `option_name`, `option_value`, `option_data`, `option_label`, `option_class`, `option_style`, `option_event`, `option_attribute`, `option_type`, `description`) VALUES ";
	mbw_install_insert_query($insert_prefix,$options,$name,"option_name");
}
function mbw_install_add_options2($options,$name="mb_options"){
	$insert_prefix		= "INSERT INTO `".$name."` (`option_load`, `option_category`, `option_title`, `option_name`, `option_value`, `option_data`, `option_label`, `option_class`, `option_style`, `option_event`, `option_attribute`, `option_type`, `description`, `is_show`) VALUES ";
	mbw_install_insert_query($insert_prefix,$options,$name,"option_name");
}
function mbw_install_insert_query($insert_prefix,$options,$name="",$filed=""){
	global $wpdb;
	if(!empty($name)){
		$rows		= $options;	
		foreach($rows as $key=>$value){
			$row_check			= 0;
			if(!empty($filed))
				$row_check		= intval($wpdb->get_var("SELECT count(*) from ".$name." where ".$filed."='".$key."'"));
			if($row_check==0){
				$query		= $insert_prefix.$value;
				@$wpdb->query($query);
			}
		}	
	}
}

function mbw_basic_install(){
	require(MBW_PLUGIN_PATH."includes/mb-config.php");	
	require(MBW_PLUGIN_PATH."includes/mb-version.php");	
	require(MBW_PLUGIN_PATH."includes/install/schema/mb-schema.php");

	
	foreach($mb_admin_tables as $key=>$value){
		if(!empty($mb_schema[$key])) mbw_create_query($mb_admin_tables[$key],$mb_schema[$key]);
	}

	$board_options_rows							= array();
	$board_options_rows['board_options']		= "('board_options', '', 'bbs_basic', 'admin/board_options', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'TAB_AJAX', 'admin,board', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 10, 99, 10, 10, 10, 8, 0, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['users']					= "('users', '', 'bbs_basic', 'admin/users', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 10, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['files']					= "('files', '', 'bbs_basic', 'admin/files', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['options']				= "('options', '', 'bbs_basic', 'admin/options', '', '', '', '', '', 'N', 'mb', 50, 50, 10, 'TAB_RELOAD', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 10, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['h_editors']				= "('h_editors', '', 'bbs_basic', 'admin/heditors', '', '', '', '', '', 'N', 'mb', 10, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['cookies']				= "('cookies', '', 'bbs_basic', 'admin/cookies', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['logs']					= "('logs', '', 'bbs_basic', 'admin/logs', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['analytics']				= "('analytics', '', 'bbs_basic', 'admin/analytics', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['referers']				= "('referers', '', 'bbs_basic', 'admin/referers', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 99, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	$board_options_rows['access_ip']			= "('access_ip', '', 'bbs_basic', 'admin/access_ip', '', '', '', '', '', 'N', 'mb', 15, 50, 10, 'NONE', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 8, 8, 10, 99, 10, 10, 10, 8, 8, 0, 0, 0, 0, 'admin', '2015-02-24 18:49:59', 0)";
	mbw_install_add_board_options($board_options_rows,$mb_admin_tables["board_options"]);

	$options_rows										= array();	
	$options_rows['mb_version']					= "('setup', 'board', '망보드 버젼', 'mb_version', '".$mb_version."', '', '', '', 'width:300px;', '', '', 'text_static', '')";
	$options_rows['db_version']					= "('setup', 'board', '디비 버젼', 'db_version', '".$mb_db_version."', '', '', '', 'width:300px;', '', '', 'text_static', '')";
	$options_rows['admin_email']					= "('setup', 'board', '관리자 이메일', 'admin_email', '', '', '', '', 'width:300px;', '', '', 'text', '')";	
	$options_rows['google_analytics_id']		= "('setup', 'board', '구글 Analytics ID', 'google_analytics_id', '', '', '', '', 'width:300px;', '', '', 'text', '')";
	$options_rows['naver_analytics_id']			= "('setup', 'board', '네이버 Analytics ID', 'naver_analytics_id', '', '', '', '', 'width:300px;', '', '', 'text', '')";
	$options_rows['prevent_content_copy']	= "('setup', 'board', '콘텐츠 복사 방지 ', 'prevent_content_copy', '0', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>마우스 우클릭 및 드래그 안되도록 설정(관리자 예외)')";
	$options_rows['admin_level']					= "('setup', 'user', '관리자 레벨', 'admin_level', '10', '', '', '', 'width:100px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"3\"', 'text', '<br>관리자 레벨 설정(공지기능 사용 및 일부 제한 기능 예외됨)')";
	$options_rows['show_user_level']				= "('setup', 'user', '회원 레벨 표시', 'show_user_level', '1', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>회원 이름 옆에 레벨 표시')";
	$options_rows['show_user_picture']			= "('setup', 'user', '회원 썸네일 표시', 'show_user_picture', '1', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>회원 이름 앞에 사진 표시')";
	$options_rows['show_name_popup']		= "('setup', 'user', '회원 팝업창 표시', 'show_name_popup', '1', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>회원 이름 클릭시 회원정보 팝업창 표시')";
	$options_rows['user_login_point']			= "('setup', 'user', '회원 로그인 포인트', 'user_login_point', '0', '', '', '', 'width:100px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"5\"', 'text', '<br>로그인 포인트 (미사용시 0으로 설정)')";
	$options_rows['user_join_point']				= "('setup', 'user', '회원 가입 포인트', 'user_join_point', '0', '', '', '', 'width:100px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"5\"', 'text', '<br>회원 가입 포인트 (미사용시 0으로 설정)')";
	$options_rows['ssl_port']						= "('setup', 'board', 'SSL 포트번호', 'ssl_port', '443', '', '', '', 'width:200px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"6\"', 'text', '<br>SSL 포트번호를 입력합니다 (443 포트는 생략 가능)')";
	$options_rows['ssl_domain']					= "('setup', 'board', 'SSL 도메인주소', 'ssl_domain', '', '', '', '', '', '', '', 'text', '<br>SSL 도메인 주소를 입력합니다 (www.mangboard.com 접속 주소와 동일하면 생략 가능)')";
	$options_rows['ssl_mode']						= "('setup', 'board', 'SSL 인증서', 'ssl_mode', '0', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>SSL 인증서가 설치되어 있을 경우 회원 관련 주소에 인증서를 적용합니다')";

	$options_rows['upload_file_size']				= "('setup', 'file', '업로드 파일 용량', 'upload_file_size', '2', '', '', '', 'width:100px;', '', 'maxlength=\"5\"', 'text', '<br>파일 업로드 용량 (MB)')";
	$options_rows['make_img_small_size']		= "('setup', 'file', '이미지 크기(Small)', 'make_img_small_size', '140', '', '', '', 'width:100px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"5\"', 'text', '<br>지정된 크기로 업로드 이미지의 축소된 비율의 이미지를 생성 : 모델에서 (\"field\":\"fn_image_path\",\"size\":\"small\") 사이즈 지정 가능, small 이미지가 없으면 원본 이미지를 불러옴')";
	$options_rows['make_img_middle_size']	= "('setup', 'file', '이미지 크기(Middle)', 'make_img_middle_size', '0', '', '', '', 'width:100px;', 'onkeydown=\"return inputOnlyNumber(event)\"', 'maxlength=\"5\"', 'text', '<br>지정된 크기로 업로드 이미지의 축소된 비율의 이미지를 생성 : 모델에서 (\"field\":\"fn_image_path\",\"size\":\"middle\") 사이즈 지정 가능, middle 이미지가 없으면 원본 이미지를 불러옴')";
	$options_rows['login_log']						= "('setup', 'log', '로그인 로그', 'login_log', '1', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>로그인 로그를 저장하여  Log 관리 메뉴를 통해 확인 할 수 있습니다')";
	$options_rows['point_log']						= "('setup', 'log', '포인트 로그', 'point_log', '1', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>포인트 로그를 저장하여  Log 관리 메뉴를 통해 확인 할 수 있습니다')";
	$options_rows['error_log']						= "('setup', 'log', '에러 로그', 'error_log', '0', '1,0', '사용,사용안함', '', '', '', '', 'radio', '<br>에러 로그를  디비에 저장하여  Log 관리 메뉴를 통해 확인 할 수 있습니다')";
	mbw_install_add_options($options_rows,$mb_admin_tables["options"]);
}


?>