<?php
/**
 * Oblique functions and definitions
 *
 * @package Oblique
 */


if ( ! function_exists( 'oblique_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function oblique_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Oblique, use a find and replace
	 * to change 'oblique' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'oblique', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1040;
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('oblique-entry-thumb', 370);
	add_image_size('oblique-single-thumb', 1040);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'oblique' ),
		'social'  => __( 'Social', 'oblique' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'oblique_custom_background_args', array(
		'default-color' => '1c1c1c',
	) ) );
}
endif; // oblique_setup
add_action( 'after_setup_theme', 'oblique_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function oblique_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'oblique' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'oblique_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function oblique_scripts() {

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
	} else {
	    wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
	} else {
	    wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic');
	}

	wp_enqueue_style( 'oblique-style', get_stylesheet_uri() );

	wp_enqueue_style( 'oblique-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'oblique-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), true );

	wp_enqueue_script( 'oblique-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

	wp_enqueue_script( 'oblique-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );

	wp_enqueue_script( 'oblique-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('jquery', 'masonry'), true );

	wp_enqueue_script( 'oblique-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'oblique-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'oblique_scripts' );


/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function oblique_register_required_plugins() {
		$plugins = array(

			array(
				'name'     => 'Pirate Forms',
				'slug' 	   => 'pirate-forms',
				'required' => false
			));

	$config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'oblique' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'oblique' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'oblique' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'oblique' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'oblique' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'oblique' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'oblique' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'oblique' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'oblique' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'oblique' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'oblique' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'oblique' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'oblique' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'oblique' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'oblique' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'oblique' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'oblique' ),
            'nag_type'                        => 'updated'
        )
    );

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'oblique_register_required_plugins' );


/**
 * Enqueue Bootstrap
 */
function oblique_enqueue_bootstrap() {
	wp_enqueue_style( 'oblique-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'oblique_enqueue_bootstrap', 9 );

/**
 * Change the excerpt length
 */
function oblique_excerpt_length( $length ) {
	$excerpt = get_theme_mod('exc_lenght', '35');
	return esc_attr($excerpt);
}
add_filter( 'excerpt_length', 'oblique_excerpt_length', 999 );

/**
 * Hide the excerpt more if the excerpt is set to 0 words
 */
function oblique_excerpt_more( $more ) {
	$excerpt = get_theme_mod('exc_lenght', '35');
	if ($excerpt == '0') {
    	return '';
	} else {
		return '[...]';
	}
}
add_filter('excerpt_more', 'oblique_excerpt_more');

/**
 * Footer credits
 */
function oblique_footer_credits() {
		/* edit by KH
	echo '<span class="sep"> | </span>';
	printf( __( 'Theme: %2$s by %1$s.', 'oblique' ), 'Themeisle', '<a href="http://themeisle.com/themes/oblique/" rel="nofollow">Oblique</a>' );
	*/

	if(is_front_page()) {

	echo '<div style="width:100%; text-align:center;">';
		printf( __( '회사명 : 아이제너럴스토어 | 대표 : 배경환') );
	echo '<br>';
		printf( __( '사업자등록번호 : 632-13-00388') );
	echo '<br>';
		printf( __( '통신판매업 신고번호 : 제2016-부산남구-0006호') );
	echo '<br>';
		printf( __( '대표번호 : 010-6831-9307 | 팩스번호 : 050-4406-9308') );
	echo '<br>';
		printf( __( '부산 남구 용당동 부경대학교용당캠퍼스 신선로 365 (부경대학교 용당캠퍼스 內) 부산창업지원센터 325', 'oblique' ) );
	echo '</div>';

	} else {

	echo '<a href="' . esc_url( __( 'http://hanpage.net', 'oblique' ) ) . '" rel="nofollow" style="color:#ccc;float:right;margin-right:30px;">';
		printf( __( ' Made in %s', 'oblique' ), '<b>HAN PAGE</b>' );
	echo '</a>';

	}


	echo '<br>';
	echo '<br>';

	echo '<div style="color:white; text-align:center;">';
		printf( __( 'COPYRIGHT © 2016 - %d  HAN PAGE', 'oblique' ), date("Y") );
	echo '<br>';
		printf( __( 'ALL RIGHTS RESERVED', 'oblique' ) );
	echo '</div>';

}
add_action( 'oblique_footer', 'oblique_footer_credits' );

/**
 * Load html5shiv
 */
function oblique_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'oblique_html5shiv' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * SVGs
 */
require get_template_directory() . '/inc/svg.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Customizer styles
 */
function oblique_customizer_styles() {
	wp_enqueue_style( 'oblique-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'oblique_customizer_styles' );

/* added by KH */
// 곧바로 체크아웃시키기

add_filter ('add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
	return WC()->cart->get_checkout_url();
}

// 장바구니 텍스트 변경하기
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {
	return __( '바로 구매', 'woocommerce' );
}

// 장바구니 비우기, 
// 바로 구매 버튼 눌렸을 때 아이템이 중첩되거나 qty가 1인 아이가 늘어나는 상황에 에러를 리턴해서 페이지가 출력되면 장바구니를 아예 비워버리는 방식을 채택했다. 
add_action( 'woocommerce_before_single_product', 'kh_clear_cart', 10 );
function kh_clear_cart() {
	WC()->cart->empty_cart();
}


// added by KH
add_action( 'woocommerce_single_product_summary', 'woocommerce_total_product_price', 31 ); 
function woocommerce_total_product_price() { 
	return;// contents below is not necessary

	global $woocommerce, $product; 
	echo '<div id="product-total-price">'; 
	_e('총 결제 금액 : ','woocommerce'); 
	echo '<span class="currency">' . get_woocommerce_currency_symbol() . '</span><span class="price"></span>'; 
	echo '</div>'; 
	?> 
	    <script> 
	    jQuery(function($){ 
	            var current_cart_total = <?php echo $woocommerce->cart->cart_contents_total; ?>, currency = '<?php echo get_woocommerce_currency_symbol(); ?>'; 

	            <?php

	            	$phpQueryExist = 0; // as false value
	            	$phpQueryValue = 1;

	            	if( isset($_GET['set_quantity']) ) {
	            		$phpQueryExist = 1;
	            		$phpQueryValue = $_GET['set_quantity'];
	            	}

	            ?>

				// added by KH
	            var queryExist = <?php echo $phpQueryExist; ?>;
	            var queryValue = <?php echo $phpQueryValue; ?>;

	            $('.input-text.qty, .quantity_select .qty').on('change',function(){ 
	               	
	               	if(queryExist && $(this).attr("name")=="quantity[676]")
	               		$(this).val(queryValue); 

	                var overall_total = 0; 
	                $('.input-text.qty, .quantity_select .qty').each(function(){ 
	                    var price = $(this).parents('.grouped-product-item').data('price'); 
	                    var items = $(this).val(); 
	                    var total = price * items; 
	                    overall_total = overall_total + total; 
	                    }); 

	                if ( overall_total > 0 ) { 
	                $('#product-total-price').fadeIn('fast'); 
	                $('#product-total-price .price').html( overall_total.toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")); 
	                } 
	                else { 
	                $('#product-total-price .price').html('0'); } 
	                }).trigger('change');

	            }); 
	</script> 
<?php }

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
 	//unset($fields['billing']['billing_first_name']);
 	unset($fields['billing']['billing_last_name']);
 	unset($fields['billing']['billing_company']);
 	unset($fields['billing']['billing_address_1']);
 	unset($fields['billing']['billing_address_2']);
 	unset($fields['billing']['billing_city']);
 	unset($fields['billing']['billing_postcode']);
 	unset($fields['billing']['billing_country']);
 	unset($fields['billing']['billing_state']);
 	unset($fields['billing']['billing_phone']);
 	unset($fields['order']['order_comments']);
 	unset($fields['billing']['billing_address_2']);
 	unset($fields['billing']['billing_postcode']);
 	unset($fields['billing']['billing_company']);
 	unset($fields['billing']['billing_last_name']);
 	//unset($fields['billing']['billing_email']);
 	unset($fields['billing']['billing_city']);

 	$fields['billing']['billing_first_name']['label'] = "이름";

 	$fields['billing']['billing_email']['label'] = "파워포인트 파일을 보내주셨던 메일주소를 입력하시기 바랍니다";

 	return $fields;
}

function kh_shortcode_font($atts) {
	$style_name = $atts['name'] . '-css';

	wp_enqueue_style($style_name);
}
add_shortcode('KHFONT', 'kh_shortcode_font');

// google and google early access is allowed
function kh_font_enqueue_scripts() {
	$query_args_kopubbatang = array( 'family' => 'KoPub Batang' );
	$query_args_notosanskr = array( 'family' => 'Noto Sans KR' );

	//wp_register_style('kopubbatang-css', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), 'parent-stylesheet', '1.0', all );
	wp_register_style('kopubbatang-css', add_query_arg( $query_args_kopubbatang, "//fonts.googleapis.com/earlyaccess/kopubbatang.css" ), 'parent-stylesheet', '1.0', all );
	wp_register_style('notosanskr-css', add_query_arg( $query_args_notosanskr, "//fonts.googleapis.com/earlyaccess/notosanskr.css" ), 'parent-stylesheet', '1.0', all );
}
add_action( 'wp_enqueue_scripts', 'kh_font_enqueue_scripts' );

