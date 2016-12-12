<?php
$desktop_model					= array();
$tablet_model					= array();
$mobile_model				= array();
$desktop_model['version']		= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"50px","level":"10","class":"list_check"},
{"field":"fn_date","name":"날짜","width":"120px","mobile_width":"80px"},
{"field":"fn_today_join","name":"가입자 수","width":"70px","responsive":"mb-hide-mobile"},
{"field":"fn_today_write","name":"게시물 수","width":"70px","responsive":"mb-hide-mobile"},
{"field":"fn_today_reply","name":"답글 수","width":"70px","responsive":"mb-hide-mobile"},
{"field":"fn_today_comment","name":"덧글 수","width":"70px","responsive":"mb-hide-mobile"},
{"field":"fn_today_upload","name":"업로드 수","width":"70px","responsive":"mb-hide-mobile mb-hide-tablet"},
{"field":"fn_today_page_view","name":"페이지 뷰","width":"90px"},
{"field":"fn_today_visit","name":"방문 횟수","width":"90px"},
{"field":"fn_total_visit","name":"누적 방문 횟수","width":"100px","responsive":"mb-hide-mobile mb-hide-tablet","search":"false"}
';

//글보기 스킨 수정
$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"20%,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_date","name":"날짜","width":"300px"},
{"field":"fn_today_visit","name":"방문 횟수","width":"300px"},
{"field":"fn_today_join","name":"가입자 수","width":"300px"},
{"field":"fn_today_write","name":"게시물 수","width":"300px"},
{"field":"fn_today_reply","name":"답글 수","width":"300px"},
{"field":"fn_today_comment","name":"덧글 수","width":"300px"},
{"field":"fn_today_upload","name":"업로드 수","width":"300px"},
{"field":"fn_page_view","name":"페이지 뷰","width":"300px"},
{"field":"fn_total_visit","name":"전체 방문자 수","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';


//글작성 스킨 수정
$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글쓰기","width":"20%,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_date","name":"날짜","width":"300px"},
{"field":"fn_today_visit","name":"방문 횟수","width":"300px"},
{"field":"fn_today_join","name":"가입자 수","width":"300px"},
{"field":"fn_today_write","name":"게시물 수","width":"300px"},
{"field":"fn_today_reply","name":"답글 수","width":"300px"},
{"field":"fn_today_comment","name":"덧글 수","width":"300px"},
{"field":"fn_today_upload","name":"업로드 수","width":"300px"},
{"field":"fn_page_view","name":"페이지 뷰","width":"300px"},
{"field":"fn_total_visit","name":"전체 방문자 수","width":"300px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;
mbw_set_fields("select_board",$mb_fields["analytics"]);

?>