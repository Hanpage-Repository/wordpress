
function sendFormDataRequest(form, action, successCallback, errorCallback, type, dataType){
	if(typeof(type)==='undefined') type = "POST";
	if(typeof(dataType)==='undefined') dataType = "json";
	if(typeof(successCallback)==='undefined') successCallback	= function s(){};
	if(typeof(errorCallback)==='undefined') errorCallback	= function e(){};

	if(action.indexOf('http')==-1) {
		action	= ajax_object.ajax_url+"?action="+action+"&admin_page="+ajax_object.admin_page;
	}
	form.attr("action", action);
	form.ajaxForm({
		type: type,
		async: true,
		crossDomain: true,
		dataType : dataType, 
		xhrFields:{withCredentials:true},
		success:function(data, state){			
			hideLoadingBox();
			successCallback(data, state);
		},error:function(e){			
			//console.log(e);			
			hideLoadingBox();			
			errorCallback(e);
		}
	}); 	
	showLoadingBox();
	form.submit(); 
}

function sendDataRequest(action, param, successCallback, errorCallback, type, dataType){
	if(typeof(type)==='undefined') type = "POST";
	if(typeof(dataType)==='undefined') dataType = "json";
	if(typeof(successCallback)==='undefined') successCallback	= function s(){};
	if(typeof(errorCallback)==='undefined') errorCallback	= function e(){};

	if(param=="") param	= mb_options["nonce"];
	else param	= param+"&"+mb_options["nonce"];

	if(action.indexOf('http')==-1){		
		param	= param+"&action="+action+"&admin_page="+ajax_object.admin_page;
		action	= ajax_object.ajax_url;
	}
	showLoadingBox();

	jQuery.ajax({
		url: action,
		type: type,
		data: param,
		success:function(data,state){
			hideLoadingBox();
			successCallback(data, state);
		},error:function(e){			
			//console.log(e);
			hideLoadingBox();			
			errorCallback(e);
		},timeout: 15000,
		cache: false,
		dataType: dataType
	});
}

function mb_insertHtml(name,message){
	jQuery(name).html(message);	
}
function mb_appendHtml(name,message){
	jQuery(name).append(message);	
}

var checkState	= false;
function checkCSSDisplayID(id){
	if(jQuery("#"+id).css("display")=="none"){		
		checkState		= true;
		jQuery("#"+id).show();
	}else if(checkState) {		
		checkState		= false;
		jQuery("#"+id).hide();
	}
}

function checkBoxDisplayID(obj, id){
	if(jQuery(obj).prop('checked')){		
		jQuery("#"+id).show();
	}else{		
		jQuery("#"+id+" input").val("");
		jQuery("#"+id).hide();
	}
}

function set_category_data(data, id,value){
	if(typeof(data)!=='undefined'){

		jQuery("#"+id+" option").remove();
		var index		= id.substr(-1);

		if(typeof(mb_languages["selectbox"+index])!='undefined' && mb_languages["selectbox"+index]!="")
			jQuery("#"+id).append('<option value="">'+mb_languages["selectbox"+index]+'</option>');

		if(typeof(data)==='object'){		
			jQuery.each(data, function(key, entry) {				
				if(value!="" && key==value){
					jQuery("#"+id).append('<option value="'+key+'" selected>'+key+'</option>');
				}else{
					jQuery("#"+id).append('<option value="'+key+'">'+key+'</option>');
				}			 
			}); 	
			jQuery("#"+id).css("display","inline-block");
		}else{
			jQuery("#"+id).html('<option value=""></option>');
			jQuery("#"+id).hide();
		}	
	}else{
		jQuery("#"+id).html('<option value=""></option>');
		jQuery("#"+id).hide();
	}
}
function movePage(url, param){	
	moveURL(url, param)
}

function moveViewPage(pid,board_name,page){
	var param		= "mode=view&board_pid="+pid;
	if(typeof(board_name)!=='undefined'&& board_name!="") param		= param+"&board_name="+board_name;
	if(typeof(page)!=='undefined' && page!="") param			= param+"&page="+page;
	moveURL("", param)
}

function moveURL(url, param, loading){
	var isLoading		= true;
	if(typeof(loading)!=='undefined') isLoading = loading;
	if(isLoading) showLoadingBox();

	if(typeof(param)!=='undefined' && param!=""){
		if(url.indexOf('?')==-1){
			url		= url+'?';
		}else{
			url		= url+'&';
		}
		url		= url+param;
	}
	if(url=="reload")
		window.location.reload();
	else if(url=="back")
		window.history.back();
	else if(url=="forward")
		window.history.forward();
	else if(url=="referer" || url=="referrer")
		window.location.href		= decodeURIComponent(document.referrer);
	else
		window.location.href		= decodeURIComponent(url);
}

function openWindow(url,name,option){
	if(typeof(option)==='undefined') option	= "width=600,height=450,toolbar=no,location=no,status=no,menubar=no,top=200,left=300,scrollbars=no,resizable=no";
	var android							= navigator.userAgent.indexOf('Android') != -1;
	if(android) objSocialPopup	= window.open(url,name);
	else objSocialPopup				= window.open(url,name,option);
}

function category_select(index){
	if(index==0){
		set_category_data(category_data,mb_options["board_name"]+"_category1",mb_categorys["value1"]);			
		if(mb_categorys["value1"]!=undefined && mb_categorys["value1"]!=""){
			set_category_data(category_data[jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()],mb_options["board_name"]+"_category2",mb_categorys["value2"]);
		}else jQuery("#"+mb_options["board_name"]+"_category2").hide();
		if(mb_categorys["value2"]!=undefined && mb_categorys["value2"]!=""){
			set_category_data(category_data[jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()][jQuery("#"+mb_options["board_name"]+"_category2 option:selected").val()],mb_options["board_name"]+"_category3",mb_categorys["value3"]);
		}else jQuery("#"+mb_options["board_name"]+"_category3").hide();
	}else if(index==1){

		set_category_data(category_data[jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()],mb_options["board_name"]+"_category2","");
		if (jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()!=""){
			set_category_data(category_data[jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()][jQuery("#"+mb_options["board_name"]+"_category2 option:selected").val()],mb_options["board_name"]+"_category3","");
		}else{
			set_category_data("",mb_options["board_name"]+"_category3","");
		}

	}else if(index==2){
		if (jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()!=""){
			set_category_data(category_data[jQuery("#"+mb_options["board_name"]+"_category1 option:selected").val()][jQuery("#"+mb_options["board_name"]+"_category2 option:selected").val()],mb_options["board_name"]+"_category3","");
		}else{
			set_category_data("",mb_options["board_name"]+"_category3","");
		}		
	}
}
function sendBoardFileData(file_pid){
	var data				= "mode=file&board_action=file_download&board_name="+mb_options["board_name"]+"&file_pid="+file_pid;
	sendDataRequest(mb_urls["board_api"], data, sendBoardFileDataHandler);
}
function sendBoardFileDataHandler(response, state)
{
	if(response.state == "success"){
		if(typeof(response.data)!=='undefined' && typeof(response.data.file_path)!=='undefined')
			moveURL(mb_urls["file"],"path="+encodeURIComponent(response.data.file_path)+"&type=download",false);
	}else{
		showAlertPopup(response);
	}
}

var listTemplateMode		= "";
var listTemplateBoard		= "";
var listTemplateCheck		= true;
var listTemplateAction		= "";


function sendTabReload(data,idx){
	if(typeof(idx)==='undefined') idx	= "1";
	if(jQuery("input[name=category"+idx+"]")) jQuery("input[name=category"+idx+"]").val(data);
	sendSearchData();
}

function setEditorType(type){
	if(document.getElementById("editor_type")){
		document.getElementById("editor_type").value	= type;
	}
}
function sendListTemplateData(data){
	listTemplateCheck	= true;
	if(typeof(data)==='undefined') data = {};
	if(typeof(data.board_name)==='undefined' || data.board_name==='undefined') board_name = mb_options["board_name"];	
	else board_name = data.board_name;	
	if(typeof(data.mode)==='undefined' || data.mode==='undefined') mode = "";
	else mode = data.mode;
	if(typeof(data.page)==='undefined' || data.page==='undefined') page = 1;
	else page = data.page;	
	
	listTemplateBoard					= board_name;
	listTemplateMode					= mode;
	listTemplateAction				= document.forms[listTemplateBoard+'_form_board_list'].board_action.value;
	document.forms[listTemplateBoard+'_form_board_list'].board_action.value = "load";
	var params		= jQuery('#'+listTemplateBoard+'_form_board_search').serialize();
	params		= params+"&"+jQuery('#'+listTemplateBoard+'_form_board_list').serialize();

	if(typeof(data.category)!=='undefined'){
		if(typeof(data.idx)==='undefined') idx = "1";
		else idx = data.idx;
		params					= params+"&category"+idx+"="+encodeURIComponent(data.category);
	}

	if(typeof(data.page_type)!=='undefined'){
		params					= params+"&page_type="+encodeURIComponent(data.page_type);
	}		
	params					= params+"&board_page="+page;	
	sendDataRequest(mb_urls["template_api"], params, sendListTemplateDataHandler);			
}

function sendListTemplateDataHandler(response, state){		
	document.forms[listTemplateBoard+'_form_board_list'].board_action.value		= listTemplateAction;
	if(listTemplateCheck){
		if(response.state == "success"){
			if(listTemplateMode!="append"){
				jQuery("#"+listTemplateBoard+"_board_body>tr").remove();
				jQuery("#"+listTemplateBoard+"_board_body>div").remove();
			}

			if(response.data["body"]) jQuery("#"+listTemplateBoard+"_board_body").append(response.data["body"]);
			if(response.data["pagination"]!="") jQuery('#'+listTemplateBoard+'_pagination_box').html(response.data["pagination"]);
			else{
				jQuery('#'+listTemplateBoard+'_pagination_box').html("");				
			}
		}else{
			showAlertPopup(response);
		}
		listTemplateCheck		= false;
	}
}


function getPostcode(type) {
	new daum.Postcode({
		oncomplete: function(data) {
			var fullAddr = ""; 
			var extraAddr = "";

			if(data.userSelectedType === "R"){
				fullAddr = data.roadAddress;
			}else{
				fullAddr = data.jibunAddress;
			}

			if(data.userSelectedType === "R"){
				if(data.bname !== ""){extraAddr += data.bname;}
				if(data.buildingName !== ""){extraAddr += (extraAddr !== "" ? ", " + data.buildingName : data.buildingName);}
				fullAddr += (extraAddr !== "" ? " ("+ extraAddr +")" : "");
			}

			//document.getElementById(type+"_postcode").value = data.postcode1+"-"+data.postcode2;
			document.getElementById(type+"_postcode").value = data.zonecode;
			document.getElementById(type+"_address1").value = fullAddr;
			jQuery("#"+type+"_address2").focus();
		}
	}).open();
}
function template_match_handler(type,obj,name,match_type,match_value){
	var value		= "";
	if(type=="checkbox"){
		value		= jQuery(obj).prop('checked') ? "1":"0";
	}else{
		value		= jQuery(obj).val();
	}
	match_value	= ","+match_value+",";
	value				= ","+value+",";
	var target		= jQuery("#combo_"+name);
	if(match_type=="show"){
		if(match_value.indexOf(value)!=-1) target.show();
		else{
			target.hide();
		}
	}else if(match_type=="hide"){
		if(match_value.indexOf(value)!=-1){
			target.hide();
		}else target.show();
	}
}

function checkEnterKey(callback,param){
	if(event.keyCode == 13){

		if(typeof(param)==='undefined')
			callback();
		else
			callback(param);
	}
}
var openTarget;
var openPid				= "";
var openColspan			= 0;
var openColspanIndex	= 0;
function openContents(obj, name, index){		
	if(typeof(index)!=='undefined') openColspanIndex	= index;

	openTarget		= jQuery(obj).closest("tr");	
	if(openTarget.next().attr("class")=="mb-open-box"){
		if(openTarget.next().css("display")=="none"){
			openTarget.next().fadeIn('slow');
			openTarget.next().find(".mb-open-slide").slideDown("300");
		}else{			
			openTarget.next().fadeOut('slow');
			openTarget.next().find(".mb-open-slide").slideUp("300",function(){openTarget.next().hide();});
		}
	}else{
		//콘텐츠 데이타 불러오기		
		if(typeof(name)==='undefined') name	= mb_options["board_name"];
		var board_pid = jQuery(obj).attr("class").split("_").pop(); 
		if(openPid!=(name+board_pid)){
			var data		= "board_name="+name+"&mode=list&board_action=content&board_pid="+board_pid;
			openPid		= name+board_pid;
			sendDataRequest(mb_urls["template_api"], data, sendContentDataHandler);			
		}	
	}
	openTarget.find(".mb-icon-box").toggleClass('mb-icon-close');
}

function isJsonType(data){
	if(data.indexOf("{")!==-1) return true;
	else return false;
}
function sendContentDataHandler(response, state){		
	if(response.state == "success"){
		var content_html		= '<tr class="mb-open-box">';
		var colspan				= openTarget.find("td").length;
		if(openColspanIndex>0){
			colspan		= colspan - openColspanIndex;
			for(i=0;i<openColspanIndex;i++){
				content_html		= content_html+'<td></td>';
			}
		}
		content_html		= content_html+'<td colspan="'+colspan+'"><div class="mb-open-slide" style="display:none"><div class="mb-open-content">'+response.data+'</div></div></td></tr>';
		openTarget.after(content_html);		
		openTarget.next().hide();
		openTarget.next().fadeIn('slow');
		openTarget.next().find(".mb-open-slide").slideDown("300");
	}else{
		showAlertPopup(response);
	}
}

function mb_reloadImage(id){
	if(typeof(id)==='undefined') id = "mb_kcaptcha";

	var img_url			= jQuery("#"+id).attr("src");
	var timestamp		= new Date().getTime();

	if(img_url.indexOf('?')==-1){
		img_url		= img_url+'?time=';
	}else{
		img_url		= img_url+'&time=';
	}
	img_url		= img_url+timestamp;

	jQuery("#"+id).attr("src",img_url)
}

function checkMaxNumber(obj,max){
	if(typeof(max)!=='undefined'){
		if(max<parseInt(jQuery(obj).val())){
			jQuery(obj).val(max);		
		}		
	}	
}
Number.prototype.to2 = function(){return this<10?'0'+this:this;}
function setSearchDate(type){
	var date				= new Date();
	end_date			= date.getFullYear()+"-"+(date.getMonth()+1).to2()+"-"+(date.getDate()).to2();		

	if(type=="month"){
		start_date			= date.getFullYear()+"-"+(date.getMonth()).to2()+"-"+(date.getDate()).to2();
	}else if(type=="total" || type=="empty"){
		start_date			= ""; end_date			= "";		
	}else{
		if(type=="today"){
			start_date			= end_date;
		}else if(type=="yesterday"){
			date.setTime(date.getTime() - (24 * 60 * 60 * 1000));
			end_date			= date.getFullYear()+"-"+(date.getMonth()+1).to2()+"-"+(date.getDate()).to2();
		}else if(type=="week"){
			date.setTime(date.getTime() - (24 * 60 * 60 * 1000 * 7));		
		}else if(type=="this_month"){			
			date					= new Date(date.getFullYear(),date.getMonth(),1);
		}else if(type=="last_month"){			
			date					= new Date(date.getFullYear(),date.getMonth(),0);
			end_date			= date.getFullYear()+"-"+(date.getMonth()+1).to2()+"-"+(date.getDate()).to2();
			date					= new Date(date.getFullYear(),date.getMonth(),1);
		}
		start_date			= date.getFullYear()+"-"+(date.getMonth()+1).to2()+"-"+(date.getDate()).to2();
	}
	jQuery("input[name='start_date']").val(start_date);
	jQuery("input[name='end_date']").val(end_date);
}


function inputOnlyNumber(event){
	var code = event.which ? event.which : event.keyCode;
	if(code == 0 || code == 9 || code == 8 || code == 46 || code == 37 || code == 39 || code == 229){
		return;
	}
	if( (code < 48) || (code > 57) ){
		return false;
	}	
}


function imgResize(objImage,nWidth,nHeight)
{
	if(typeof(nWidth)==='undefined') nWidth = 50;
	if(typeof(nHeight)==='undefined') nHeight = nWidth;

	nWidth		= parseInt(nWidth);
	nHeight		= parseInt(nHeight);

	var imgFile			= new Image();
	imgFile.src			= objImage.src;

	var imgWidth		= imgFile.width;
	var imgHeight		= imgFile.height;
	
	if(imgWidth>imgHeight)
	{
		imgHeight = imgHeight * nWidth/imgWidth;
		imgWidth  = nWidth;
		
		if(imgHeight>nHeight)
		{
			imgWidth  = imgWidth * nHeight/imgHeight;
			imgHeight = nHeight;			
		}
		
	} else if(imgWidth<=imgHeight)
	{
		imgWidth  = imgWidth * nHeight/imgHeight;
		imgHeight = nHeight;
		
		if(imgWidth>nWidth)
		{
			imgHeight = imgHeight * nWidth/imgWidth;
			imgWidth  = nWidth;
		}
	} else
	{
		imgWidth  = nWidth;
		imgHeight = nHeight;
	}
	objImage.width		= imgWidth;
	objImage.height		= imgHeight;
}

jQuery(document).ready(function() {
	if(jQuery.isFunction(jQuery(".tooltip").tipTip)){
		jQuery(".tooltip").tipTip();
	}
});
