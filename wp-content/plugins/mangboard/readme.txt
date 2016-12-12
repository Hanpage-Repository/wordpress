=== Mang Board WP===
Contributors: kitae-park
Donate link: http://www.mangboard.com
Tags: board,mangboard,bbs,bulletin,gallery,image,calendar,seo,plugin,shortcode,social,korea,korean,kingkong,kboard,망보드,한국형게시판,게시판
Requires at least: 3.8.0
Tested up to: 4.6
Stable tag: 1.3.9
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Mang Board is bulletin board (홈페이지 제작에 필요한 다양한 기능을 제공하는 한국형 게시판 플러그인입니다)

== Description ==

**Mang Board WP란??**

* Mang Board WP는 워드프레스 플러그인 형태로 제공되는 프로그램으로
자료실 게시판, 갤러리(Gallery) 게시판, 캘린더(Calendar) 게시판, 회원관리, 통계관리, 쇼핑몰, 
소셜로그인, 소셜공유, 검색엔진최적화(SEO) 등의 다양한 기능을 제공합니다.

**Mang Board 특징**

* 빠르게 변화하는 기술, 플랫폼에 보다 쉽게 대응할 수 있다
* 커스터마이징을 위한 게시판으로 구조를 쉽게 변현할 수 있다
* 데스크탑, 태블릿, 모바일 등 다양한 디바이스에 맞는 반응형웹 구축이 가능하다
* 플러그인 기능을 통해 다양한 기능을 추가할 수 있다
* 다국어 기능 및 보안 인증서(SSL) 기능을 지원한다
* 다른 한국형 게시판(kboard,kingkong board)과 혼합해서 사용이 가능하다

**Mang Board 기능**

* MB-BASIC: 자료실, 갤러리, 캘린더, 문의하기, 웹진, 자주묻는질문 게시판
* MB-BUSINESS: 회원가입, 소셜 로그인, 회원정보, 회원관리, 소셜 공유, 검색 최적화 
* MB-COMMERCE: 반응형 쇼핑몰, 오픈마켓, 포인트, 쿠폰, 상품관리, 카트, 주문, 결제

**Mang Board Support**

* Homepage: http://www.mangboard.com
* Demo: http://demo.mangboard.com
* Manual: http://www.mangboard.com/manual/
* Community: http://cafe.naver.com/wpschool

== Installation ==

**Mang Board Installation (Korean)**

* 플러그인 압축파일을 다운로드 받아 워드프레스 “/wp-content/plugins” 폴더에 업로드 합니다
* “/wp-content/plugins/mangboard” 폴더가 보이시면 워드프레스 설치된 플러그인 목록에 나타납니다
* 워드프레스 관리자 화면에서 “플러그인>설치된 플러그인” 목록에서 “Mang Board WP” 플러그인을 찾아 활성화 버튼을 클릭합니다
* 왼쪽에 있는 워드프레스 관리자 메뉴에서 “Mang Board” 메뉴가 보이시면 설치가 정상적으로 완료 되었습니다

**Mang Board Installation (English)**

* Upload the entire "mangboard" folder to the "/wp-content/plugins/" directory.
* Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Mang Board 라이센스는 어떻게 되나요? =

* 상업적, 비상업적 용도에 상관없이 무료 사용 가능
* 기타 문제 발생시 GPL2 라이센스 내용 준수(http://www.gnu.org/licenses/gpl-2.0.html)

= Mang Board 설치에 필요한 서버 환경은 어떻게 되나요? =

* WordPress 3.8 or greater
* PHP version 5.3.0 or greater
* MySQL version 5.0.7 or greater

= Mang Board 게시판을 추가하려면 어떻게 해야 하나요? =

*  “Mangboard>게시판 관리” 메뉴를 클릭하고 “게시판 추가” 버튼을 클릭합니다
*  게시판 이름을 입력하고 기타 게시판 옵션들을 설정하고 “확인” 버튼을 클릭해서 게시판을 추가 합니다 ( 게시판 이름만 필수 입력 )
*  게시판 목록에 추가된 게시판의 이름과 워드프레스 페이지에 추가할 수 있는 Shortcode 가 나타납니다
*  원하는 형태의 Shortcode를 복사한 다음 관리자 메뉴 “페이지>새 페이지 추가” 메뉴를 클릭합니다
*  페이지 제목을 입력하고 복사한 Shortcode를 에디터 텍스트 영역에 복사한 다음 “공개하기” 버튼을 클릭하면 망보드 게시판이 워드프레스 페이지에 등록됩니다
*  등록된 페이지를 홈페이지 메뉴에 추가합니다

= Mang Board 회원 권한 설정은 어떻게 되나요? =

* 비회원 : Level 0
* 회원 : Level 1~10
* 관리자 : Level 10



== Screenshots == 

1. Mang Board > Board
2. Mang Board > Gallery
3. Mang Board > Calendar
4. Mang Board > Webzine
5. Mang Board > Frequently Asked Questions
6. Mang Board > Form

== Changelog ==

= 1.3.9 =
* 스마트 에디터 - 모바일에서 에디터 로딩 안되는 버그 수정
* 비밀글(필수) - 글수정시 비밀글 해제 안되는 버그 수정
* 글목록 - 카테고리 아이템 인덱스 CSS Class 추가 (category1-item1,category1-item2, ~)
* bbs_basic 스킨 아이콘 및 CSS 수정
* 보안 기능 수정

= 1.3.8 =
* 관리자 글작성시에만 HTMLPurifier 기능 작동 안하도록 수정
* HTMLPurifier 기능 Config 설정 수정
* 글보기 권한 설정 버그 수정

= 1.3.7 =
* 글작성시 HTMLPurifier 기능을 가진 다른 플러그인(kboard 등)과 충돌하는 버그 수정

= 1.3.6 =
* 한글 카테고리(새로고침) 설정시 로딩 안되는 버그 수정
* 모델링 - 멀티 체크박스 기능 추가({"field":"fn_ext1","name":"과일","type":"checkbox","label":"사과,바나나,포도"})
* 모델링 - 웹진모델 콘텐츠 최대 글자(content_maxlength) 속성 추가
* 자주묻는질문(faq) - 제목 클릭시 로딩 없이 슬라이드 되도록 수정
* HTMLPurifier 플러그인 기능 추가
* 회원 로그인 상태에서 안보이게(display:none) 하는 "mb-hide-login" CSS Class 추가
* 비로그인 상태에서 안보이게(display:none) 하는 "mb-hide-logout" CSS Class 추가

= 1.3.5 =
* SSL(https) 설정시 로그인 세션 연결 끊기는 버그 수정
* HTML5 파일 업로드 보안 기능 수정(영문 파일명이 아닐경우 파일이름 유지 안함)
* 관리자 옵션설정 로딩 최적화(옵션 저장 방식 수정)
* 모델링 보안 기능 추가

= 1.3.4 =
* 한글파일 업로드시 파일이름 깨지는 버그 수정

= 1.3.3 =
* 캘린더 게시판 카테고리(AJAX) 기능 버그 수정
* 스마트 에디터 모바일 기능 추가 및 레이아웃 수정
* 보안 기능 수정
* minor bug 수정

= 1.3.2 =
* 커머스 패키지 호환성 기능 수정
* minor bug 수정

= 1.3.1 =
* 에디터 플러그인 로딩 방식 수정
* FAQ 게시판 모델 기능 수정 및 모션 기능 추가
* minor bug 수정

= 1.3.0 =
* 파일이름에 특수기호 사용된 파일 다운로드 버그 수정(base64 인코딩 방식으로 수정)
* 일부 환경에서 "게시판 추가" 버튼 클릭시 다른 페이지로 이동되는 버그 수정
* 템플릿 확장 기능 수정

= 1.2.9 =
* 글작성시 필수 입력 체크 안하는 버그 수정
* 템플릿 확장 기능 수정
* 커머스 패키지 지원 기능 추가

= 1.2.8 =
* 보안 기능 버그 수정

= 1.2.7 =
* 문의하기 게시판 메일 버그 수정 및 첨부파일 메일 발송 기능 추가
* 위젯 기능 수정 (워드프레스 5.3.x 방식으로 수정)
* 스킨 필터 기능 수정
* 보안 기능 수정

= 1.2.6 =
* 로그인 Redirect 접근권한 버그 수정
* 1단 카테고리 수정시 자동설정 안되는 버그 수정
* 댓글-리스트 모델링 버그 수정
* 회원 정보 멀티 수정 기능 추가
* 파일업로드 용량 설정 기능 수정(0.1~0.9 소수점 설정 가능)
* DB 스키마 수정(ENGINE=MyISAM 설정 삭제)

= 1.2.5 =
* 멀티사이트 파일 업로드 버그 수정
* 보안 기능 수정

= 1.2.4 =
* 멀티사이트- 스마트 에디터 파일 업로드 경로 자동 설정 기능 추가
* 비밀글(필수) 설정시 답글 안달리는 버그 수정
* 템플릿 확장 기능 수정
* 보안 기능 수정

= 1.2.3 =
* 게시판 글쓰기 권한이 1일 경우 목록화면에서 글쓰기 버튼 표시하고, 비회원 클릭시 로그인 페이지로 이동하도록 수정
* 게시판 설정 > 게시물 비밀글로 자동 설정 기능 추가
* 보안 기능 수정
* minor bug 수정

= 1.2.2 =
* 데이타 로딩화면 버그 수정

= 1.2.1 =
* 스킨, 템플릿 폴더 테마 연동 기능 추가(테마폴더에 mangboard/skins,mangboard/templates 폴더 복사해서 수정가능) 
* 관리자 기간설정 검색 기능 수정(어제, 이번달, 전체 선택 기능 추가)
* 게시판 페이지 블럭 설정기능 수정(0개, 더보기 방식 추가)
* 템플릿 확장 기능 및 에러 메시지 기능 수정
* 안정화 작업 및 데이타 로딩화면 기능 추가
* minor bug 수정

= 1.2.0 =
* HTML 태그 및 퓨전빌더(아바다) 내부에서 숏코드 사용할 수 있도록 구조 수정
* 회원 관련 필터 및 보안 기능 수정
* 최근 게시물 기능 수정
* 관리자 메뉴 위치 수정

= 1.1.8 =
* 회원 가입시 레벨 설정 버그 수정(무위자연님 감사합니다)
* 로그아웃 안되는 버그 수정

= 1.1.7 =
* 에디터 내부에 테이블 작성시 CSS 버그 수정(유쾌한님 감사합니다)
* 댓글 수정시 br 태그 추가되는 버그 수정(가이버님 감사합니다)
* 캘린더 게시판 모바일 반응형 화면 수정
* 게시판 및 회원관련 필터 기능 추가
* 게시판 보안 기능 수정

= 1.1.6 =
* 회원관련 플러그인에서 수정한 회원 관련 URL(로그인,회원가입 등) 반영되도록 수정
* 캘린더 게시판 일부 게시물 수정시 사라지는 버그 수정(호리a님 감사합니다)

= 1.1.5 =
* 대시보드 > 플러그인 업데이트 기능 추가
* 일반 회원 본인이 작성한 글 수정 안되는 버그 수정(메르배너님 감사합니다)
* 캘린더 게시판 카테고리 기능 버그 수정
* HTML Shortcode 사용 방식 추가 (게시판 상단에 HTML 코드 추가시 사용)
  [mb_extension tpl="html"]html tag[/mb_extension]

= 1.1.4 =
* 모바일에서 게시물 수정버튼 안보이는 버그 수정
* 캘린더 게시판 검색 안되는 버그 수정(수까커뮤니티님 감사합니다)
* 비밀글에 대한 비밀 답변글 내용을 비밀글의 패스워드로도 볼 수 있도록 수정
* 대시보드> 최대 업로드 파일 용량 표시 기능 및 매뉴얼 버튼 추가
* 통계기능 망보드 페이지뷰> 홈페이지 페이지뷰 기능으로 수정
* bbs_basic 스킨 CSS 수정

= 1.1.3 =
* 관리자에서 게시판 설정 변경 및 회원 수정 안되는 버그 수정

= 1.1.2 =
* 최근 게시물 Shortcode 다른 HTML 태그안에 들어갈 수 있도록 수정 및 "title" 속성 추가 
* CK 에디터 IE에서 안나오는 버그 수정(수까커뮤니티님 감사합니다)
* 비밀글 해제 안되는 버그 수정(가이버님 감사합니다)
* 외부 파일 읽어오는 쇼트코드 기능 추가 [mb_extension tpl="include_file" path="파일경로(skins/bbs_basic/)" file_name="파일이름"]
* 자주 묻는 질문 게시판 모델 추가 (models/faq.php)
* 웹진 게시판 모델 추가 (models/webzine.php)
* minor bug 수정

= 1.1.1 =
* 관리자 파일 관리 기능 수정 및 파일 삭제 기능 추가
* 폼 게시판 글 등록시 관리자에게 이메일 보내기 기능 추가
* 폼 게시판 답변시 작성자에게 이메일 보내기 기능 추가
* 회원ID 중복 체크시 필터 기능 추가
* 회원 정보 필터 기능 버그 수정
* 파일 용량(0MB) 표시 버그 수정
* 갤러리 이미지 정렬 버그 수정(스킨 CSS수정)
* 회원 폼 모드 지원할 수 있는 기능 추가
* 에디터 높이 모델에서 수정할 수 있도록 수정
* 이미지 쇼트코드 기능 추가 [mb_image type="img" value="이미지 주소"  width="200px" height="200px" style="" class="" align="center"]
* CK 에디터 기능 추가 및 모바일 디폴트 에디터로 설정
* 고정 로그아웃 주소 추가 ( http://홈페이지/?mb_user=logout )

= 1.1.0 =
* 자료실 스킨 리스트 제목 앞에 카테고리 표시 기능 추가
* bbs_skin 아이콘 수정 및 CSS 수정
* 일부 테마에서 로그아웃 안되는 버그 수정 (snu2han님 감사합니다)
* minor bug 수정

= 1.0.9 =
* 시간대 : UTC+9 시간 설정시 시간 오류 수정 (snu2han님 감사합니다)
* 우커머스 관련 테마와 충돌을 막기 위해 jquery-ui.css 파일을 관리자 페이지에서만 사용하도록 수정
* Gallery 스킨 : 카테고리 탭메뉴 Ajax 방식 버그 수정(snu2han님 감사합니다)
* Gallery 스킨 제목이 2줄로 넘어가지 않도록 CSS 수정
* Gallery,Calendar 스킨 우측 사이드바가 하단으로 내려가는 버그 수정 (전인수님 감사합니다)
* 최근 게시물 위젯 13자 넘어가는 제목 글자는 "..." 표시하도록 설정 (snu2han님 감사합니다)
* form 모델 연락처=>이메일로 수정

= 1.0.8 =
* 대시보드 최근글 목록 20개=>10개로 수정 및 버그 수정
* 비밀글 비밀번호 일치하지 않는 버그 수정 (snu2han님 감사합니다)
* 답글 작성시 카테고리 설정 기능 추가 (snu2han님 감사합니다)
* 최근 게시물 위젯 등록 안되는 버그 수정 (snu2han님 감사합니다)
* 갤러리 스킨 이미지 세로 높이 고정 (쿡프레스님 감사합니다)
* 관리자 회원 동기화 기능 추가
* 댓글 개행 문자 기능 추가
* minor bug 수정

= 1.0.7 =
* 관리자 검색 버그 수정
* 게시판 설정 버그 수정(2~3단 카테고리, 게시판 상,하단 내용)
* 버튼 CSS 코어=>스킨으로 이동

= 1.0.6 =
* 대시보드 버그 수정
* 워드프레스 플러그인 readme.txt 파일 수정

= 1.0.5 =
* 대시보드 기능 추가
* 최근 게시물 버그 수정

= 1.0.4 =
* 워드프레스 플러그인 readme.txt 파일 수정

= 1.0.3 =
* 워드프레스 플러그인 등록을 위한 전체적인 API 구조 변경
* 파일 관리 시스템 버그 수정 및 구조 변경
* 첨부파일 다운로드 방식 수정
* 보안 취약점 점검 및 수정
* bbs_basic 스킨 CSS 파일 수정

= 1.0.2 =
* 업데이트 호환성을 높이기 위해 버젼별 파일 분리 작업
* 보안 기능 수정

= 1.0.1 =
* 스마트 에디터 2.3.10 => 2.8.2 업그레이드
* 네이버 애널리틱스 기능 추가
* RSS 기능 추가
* 디비 버젼체크 기능 추가
* 테스트 코드 삭제

= 1.0.0 =
* Mang Board WP Release (2015.09.01)