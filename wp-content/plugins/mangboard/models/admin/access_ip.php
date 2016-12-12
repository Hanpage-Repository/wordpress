<?php
$desktop_model				= array();
$tablet_model					= array();
$mobile_model				= array();
$desktop_model['version']	= "1.0.0";

$desktop_model['list']		= '
{"type":"list_check","width":"50px","level":"10","class":"list_check"},
{"field":"fn_pid","name":"번호","width":"60px"},
{"field":"fn_type","name":"구분","width":"120px","search":"false","data":"0,1","label":"접근 차단,접근 허용"},
{"field":"fn_ip","name":"IP","width":"200px"},
{"field":"fn_description","name":"설명","width":""},
{"field":"fn_reg_date","name":"등록일","width":"150px"}
';

//글보기 스킨 수정
$desktop_model['view']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글보기","width":"20%,*","mobile_width":"90px,*","class":"table table-view"},
{"field":"fn_pid","name":"번호","width":"300px"},
{"field":"fn_type","name":"구분","width":"300px"},
{"field":"fn_ip","name":"IP","width":"300px"},
{"field":"fn_description","name":"설명","width":"300px"},
{"field":"fn_reg_date","name":"등록일","width":"300px"}
{"tpl":"tag","tag_name":"table","type":"end"}
';


//글작성 스킨 수정
$desktop_model['write']		= '
{"tpl":"tag","tag_name":"table","type":"start","name":"글쓰기","width":"20%,*","mobile_width":"90px,*","class":"table table-write"},
{"field":"fn_type","name":"구분","width":"100px","type":"select","data":"0,1","label":"접근 차단,접근 허용","default":"0","description":"<br>접근 허용으로 등록된 IP가 1개 이상이면 접속 허용으로 등록된 IP만 접근이 가능해 집니다"},
{"field":"fn_ip","name":"IP","width":"250px","required":"(*)"},
{"field":"fn_description","name":"설명","width":"600px"},
{"tpl":"tag","tag_name":"table","type":"end"}
';

$tablet_model									= $desktop_model;
$mobile_model								= $desktop_model;

mbw_set_fields("select_board",$mb_fields["access_ip"]);

$mb_words["Write"]							= "W_ADD";
?>
