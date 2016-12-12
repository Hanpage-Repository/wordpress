<?php
/**
*
*	King Composer
*	(c) KingComposer.com
*	kc.actions.php
*
*/
if(!defined('KC_FILE')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}



/*
*	admin init
*/


add_action('admin_init', 'kc_admin_init');
function kc_admin_init() {
	
	global $kc;
	
	if (!function_exists('is_plugin_active'))
		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
		
	if (get_option('kc_do_activation_redirect', false)) 
	{

	    delete_option('kc_do_activation_redirect');

	    if (!isset($_GET['activate-multi'])) 
	    {
	    	$conflicts = array(
		    	'js_composer/js_composer.php',
		    	'siteorigin-panels/siteorigin-panels.php',
		    	'all-in-one-wp-builder/visual-editor.php',
		    	'aqua-page-builder/aqua-page-builder.php',
		    	'beaver-builder-lite-version/fl-builder.php',
		    	'beaver-builder/fl-builder.php',
		    	'beaver/beaver.php',
		    	'elementor/elementor.php',
		    	'fluxlive/plugneditflux.php',
		    	'forge/forge.php',
		    	'kopa-page-builder/kopa-page-builder.php',
		    	'live-composer-lite/lite-ds-live-composer.php',
		    	'live-composer-page-builder/ds-live-composer.php',
		    	'ds-live-composer/ds-live-composer.php',
		    	'motopress-content-editor-lite/motopress-content-editor.php',
		    	'motopress-content-editor/motopress-content-editor.php',
		    	'motopress/motopress-content-editor.php',
		    	'octonis-page-builder/oct.php',
		    	'pace-builder/pace-builder.php',
		    	'page-builder-sandwich/class-plugin.php',
		    	'page-layout-builder/page-layout-builder.php',
		    	'tailor/tailor.php',
		    	'tailor-portfolio/tailor-portfolio.php',
		    	'tx-onepager/tx-onepager.php',
		    	'wp-xprs-page-builder/wp-xprs.php',
		    	'wr-pagebuilder/wr-pagebuilder.php',
	    	);
	    	
	    	@session_start();
			$_SESSION['kc_disabled_plugins'] = array();
	
	    	foreach ($conflicts as $i => $name)
	    	{
		    	if (is_plugin_active($name)) 
		    	{
		    		deactivate_plugins ($name);
		    		$_SESSION['kc_disabled_plugins'][] = $name;
		    	}
	    	}
	    	
	    	wp_redirect("admin.php?page=kingcomposer&screen=welcome");
	    }
	}
		
	if ($kc->action == 'live-editor') 
	{	
		if (!class_exists('kc_pro')) 
		{
			wp_redirect ("admin.php?page=kingcomposer#kc_pro");
			exit;
		}
	
	}
	
	if (($kc->action == 'live-editor' || $kc->action == 'fonts-manager') && !defined('IFRAME_REQUEST'))
	{
		/*
		*	@live editor mode
		*	We sent the iframe request to wp system
		*/
		define ('IFRAME_REQUEST', true);
	}
	
	/* register kc options */
	register_setting ('kingcomposer_group', 'kc_options', 'kc_validate_options');
	
	$roles = array ('administrator', 'admin', 'editor');

	foreach ($roles as $role) 
	{
		if (!$role = get_role($role)) 
			continue;
			
		$role->add_cap('access_kingcomposer');
	}
		

}


register_activation_hook( KC_FILE, 'kc_plugin_activate' );
function kc_plugin_activate() {
	add_option('kc_do_activation_redirect', true);
}



/*
*	Load languages
*/



add_action('plugins_loaded', 'kc_load_lang');
function kc_load_lang() {
	load_plugin_textdomain( 'kingcomposer', false, KC_SLUG . '/locales/' );
}



/*
*	Register assets ( js, css, font icons )
*/


add_action('admin_enqueue_scripts', 'kc_assets', 1 );
function kc_assets(){
	
	global $kc;
	
	wp_enqueue_style('kc-global', KC_URL.'/assets/css/kc.global.css', false, KC_VERSION );
	
	if( $kc->action == 'fonts-manager' ){
		wp_enqueue_style('kc-icons', KC_URL.'/assets/css/icons.css', false, KC_VERSION );
		wp_enqueue_style('kc-fonts-manager-css', KC_URL.'/assets/css/kc.fonts.css', false, KC_VERSION );
		wp_register_script('kc-fonts-manager-js', KC_URL.'/assets/js/kc.fonts.js', null, KC_VERSION, true );
		wp_enqueue_script('kc-fonts-manager-js');
	}

	// Stop loading assets from admin if not in allows content type
	if( is_admin() && !kc_admin_enable() )
		return;
	
	$kc->enqueue_fonts();
	
	wp_enqueue_script('wp-util');
	
	$p = trailingslashit (KC_URL).'assets/css/';
	
	$args = array( 
		'builder' => $p.'kc.builder.css', 
		'params' => $p.'kc.params.css', 
		'animate' => $p.'animate.css',	
	);
	
	$icon_sources = $kc->get_icon_sources();
	if (is_array($icon_sources) && count ($icon_sources) > 0)
	{
		$i = 1;
		foreach ($icon_sources as $icon_source)
		{
			$args['sys-icon-'.$i++] = $icon_source;
		}
	}
	
	$args = apply_filters('kc-core-styles', $args);
	
	foreach ($args as $k => $v)
	{
		wp_enqueue_style ('kc-'.$k, $v, false, KC_VERSION);
	}

	wp_register_script ('kc-builder-backend-js', trailingslashit(KC_URL).'assets/js/kc.builder.js', array('jquery','wp-util'), KC_VERSION, true);
	wp_enqueue_script ('kc-builder-backend-js');
	wp_enqueue_script ('masonry');

	$p = trailingslashit (KC_URL).'assets/js/kc.';
	$args = apply_filters ('kc-core-scripts', array( 
		'tools' => $p.'tools.js', 
		'views' => $p.'views.js', 
		'params' => $p.'params.js', 
		'jscolor' => $p.'vendors/jscolor.js', 
		'pikaday' => $p.'vendors/pikaday.js', 
		'freshslider' => $p.'vendors/freshslider.min.js') 
	);
	
	foreach ($args as $k => $v)
	{
		wp_register_script ('kc-'.$k, $v, null, KC_VERSION, true);
		wp_enqueue_script ('kc-'.$k);
	}

	wp_enqueue_media();
	wp_enqueue_style('wp-pointer');
	
}


/**
*	Register filter for menu title
*/


add_filter( 'kc_admin_menu_title', 'kc_filter_admin_menu_title');

function kc_filter_admin_menu_title ($menu_title) {

	$current = get_site_transient ('update_plugins');
	
	$count = 0;
    if (isset($current->response[KC_BASE]))
    	$count++;
    
	if (defined('KCP_BASENAME') && isset($current->response[KCP_BASENAME]))
		$count++;
	
	if ($count > 0)
		$menu_title .= '&nbsp;<span class="update-plugins"><span class="plugin-count">'.$count.'</span></span>';
	
	return $menu_title;
	
}


/**
*	Register filter for adding body classes in backend
*/


add_filter ('admin_body_class', 'kc_admin_body_classes');

function kc_admin_body_classes ($classes) {
	
	global $kc;
	
	if ($kc->action == 'live-editor')
		return "$classes kc-live-editor kc-request-iframe";
		
	if ($kc->action == 'fonts-manager')
		return "$classes kc-fonts-manager kc-request-iframe";
	
	return $classes;
		
}


/*
*	Add Menu Page in Backend
*/

add_action ('admin_bar_menu', 'kc_admin_bar', 999);
function kc_admin_bar ($wp_admin_bar) {

	global $kc;
	if ($kc->user_can_edit() !== false)
	{
		do_action('kc-live-edit-link', $wp_admin_bar);	
	}
	
}

/*
*	Register settings page
*/


add_action ('admin_menu', 'kc_settings_menu', 0);
function kc_settings_menu() {
	
	$capability = apply_filters('access_kingcomposer_capability', 'access_kingcomposer');
	$icon = KC_URL.'/assets/images/icon_100x100.png';
	$menu_title = apply_filters('kc_admin_menu_title', __( 'KingComposer' , 'kingcomposer'));

	add_menu_page(
		 __( 'King Composer WP' , 'kingcomposer' ),
		$menu_title,
		$capability,
		'kingcomposer',
		'kc_main_page_screen',
		$icon
	);

	remove_submenu_page ('kingcomposer', 'kingcomposer');

	add_submenu_page(
		'kingcomposer',
		esc_html__('King Composer WP', 'kingcomposer'),
		esc_html__('General Settings', 'kingcomposer'),
		$capability,
		'kingcomposer',
		'kc_main_page_screen'
	);
		
	add_submenu_page(
		'kingcomposer',
		__('Shortcode Mapper', 'kingcomposer'), 
		__('Shortcode Mapper', 'kingcomposer'),
		$capability,
		'kc-mapper',
		'kc_shortcode_mapper_screen'
	);
	
}

add_action ('admin_head', 'kc_admin_header');
add_action ('edit_form_after_title', 'kc_after_title');
add_action ('edit_form_after_editor', 'kc_after_editor');
add_action ('admin_footer', 'kc_admin_footer');



/*
*	Header init
*/



function kc_admin_header(){

	if (is_admin() && !kc_admin_enable())
		return;
	
	global $kc;
	
	$meta = $kc->get_post_meta();
	/*
	*	The builder is active, force the wp editor to tinyMCE
	*	To load faster tinyMCE in the builder
	*/
	if ($meta['mode'] == 'kc') {
		add_filter ('wp_default_editor', 'kc_force_default_editor');
	}
?>
<script type="text/javascript">

	var kc_site_url = '<?php echo site_url(); ?>',
		kc_plugin_url = '<?php echo KC_URL; ?>',
		shortcode_tags = '<?php

			global $shortcode_tags;

			$arrg = array();
			$maps = $kc->get_maps();

			foreach( $maps as $key => $val ){
				array_push( $arrg, $key );
			}

			foreach( $shortcode_tags as $key => $val ){
				if( !in_array( $key, $arrg ) )
					array_push( $arrg, $key );
			}

			echo implode( '|', $arrg );
		
		?>',
		<?php 
			
		if( isset( $_GET['id'] ) ){
			echo 'kc_post_ID = "'.$_GET['id'].'",';
			echo 'kc_post_title = "'. esc_attr( get_the_title( $_GET['id'] ) ) .'",';
		}
				 
		?>
		kc_version = '<?php echo KC_VERSION; ?>',
		kc_url = '<?php echo KC_URL; ?>',
		kc_ajax_url = "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>",
		kc_profiles = <?php echo $kc->get_profiles_db( false ); ?>,
		kc_profiles_external = <?php echo json_encode( (object)$kc->get_profile_sections() ); ?>,
		kc_ajax_nonce = '<?php echo wp_create_nonce( "kc-nonce" ); ?>',
		kc_fonts_update = function( datas){ kc.ui.fonts_callback( datas ); },
		kc_fonts = <?php echo json_encode( get_option('kc-fonts') ); ?>,
		kc_action = '<?php echo $kc->action; ?>';
		
</script>
<?php
}

/*
*	Create KC buttons before wp editor
*/


function kc_after_title ($post) {

	if (!is_admin() || !kc_admin_enable())
		return;
	
	global $post;
	
	if (!empty( $post->post_content_filtered))
		$post->post_content = html_entity_decode (stripslashes_deep($post->post_content_filtered));

?>	
	<div id="kc-switcher-buttons">
		
		<?php do_action('kc-switcher-buttons'); ?>
		
		<a href="#" class="kc-button blue alignright" id="kc-switch-builder">
			<img src="<?php echo KC_URL; ?>/assets/images/icon.png" width="20"> 
			<?php _e('Edit with KingComposer', 'kingcomposer'); ?>
		</a>
		
	</div>
<?php		
}

/*
*	Put post settings forms after editor
*/


function kc_after_editor ($post) {

	if (!is_admin() || !kc_admin_enable())
		return;
		
	?>
	<div style="display:none;" id="kc-post-settings">
		
		<?php
			
			$data = array( "mode" => "", "classes" => "", "css" => "", "max_width" => "", 'thumbnail' => '' );
			
			if (isset($post ) && isset( $post->ID ) && !empty( $post->ID))
			{
				$get_data = get_post_meta ($post->ID , 'kc_data', true);
				if (!empty($get_data) && is_array($get_data))
				{
					foreach ($get_data as $name => $value)
					{
						$data[$name] = $value;
					}
				}
			}
		
		?>
		
		<input type="hidden" name="kc_post_meta[mode]" id="kc-post-mode" value="<?php echo esc_attr( $data['mode'] ); ?>" />
		<input type="hidden" name="kc_post_meta[classes]" id="kc-page-body-classes" value="<?php echo esc_attr( $data['classes'] ); ?>" />
		<input type="hidden" name="kc_post_meta[max_width]" id="kc-page-max-width" value="<?php echo esc_attr( $data['max_width'] ); ?>" />
		<input type="hidden" name="kc_post_meta[thumbnail]" id="kc-page-thumbnail" value="<?php echo esc_attr( $data['thumbnail'] ); ?>" />
		<textarea id="kc-page-css-code" name="kc_post_meta[css]" ><?php echo esc_attr( $data['css'] ); ?></textarea>
		
		<?php if ($data['mode'] == 'kc'){ ?>
		
			<style type="text/css">
				#postdivrich{
					visibility: hidden;
					position:relative;
				}
				#kc-switcher-buttons{
					display:none;
				}
			</style>
			<script tyle="text/javascript">
				if (document.getElementById("postdivrich"))
					document.getElementById("postdivrich").className += " first-load";
			</script>
		
		<?php } ?>
		
	</div>
	<?php
		
}


// stop TinyMCE from removing <br> tags
function kc_tinymce_fix($in) {
	
    //don't remove line breaks
    $in['remove_linebreaks'] = false;

    // convert newline characters to BR
    $in['convert_newlines_to_brs'] = true;

    // don't remove redundant BR
    $in['remove_redundant_brs'] = false;

    return $in;
    
}
add_filter ('tiny_mce_before_init', 'kc_tinymce_fix');


/*
*	Load builder template at footer
*/

function kc_admin_footer (){

	if (is_admin() && !kc_admin_enable())
		return;

	do_action('kc_before_admin_footer');
	
	require_once KC_PATH.'/includes/kc.js_languages.php';
	require_once KC_PATH.'/includes/kc.nocache_templates.php';
	
	do_action('kc_after_admin_footer');
	
}


/*
*	Save post settings
*/


add_action ('save_post', 'kc_process_save', 10, 2);
function kc_process_save ($post_id, $post) {

	if (!isset($_POST['content']) || !isset($_POST['post_ID']) || !current_user_can('publish_pages'))
		return;
		
	global $wpdb, $kc;
	$id = $_POST['post_ID'];
	
	if (!empty( $_POST['kc_post_meta']))
	{
		if (get_post_meta ($id, 'kc_data') === false)
			add_post_meta ($id, 'kc_data' , $_POST['kc_post_meta']);
		else update_post_meta ($id , 'kc_data' , $_POST['kc_post_meta']);
	}
	/*
	*	Create cache when KC active
	*/
	if (isset($_POST['kc_post_meta']) && isset($_POST['kc_post_meta']['mode']) && $_POST['kc_post_meta']['mode'] == 'kc')
	{
	
		require_once KC_PATH.'/includes/kc.front.php';	
		
		$content =  stripslashes_deep( $_POST['content'] );
		$content_processed = '';
		
		if (!empty($content))
		{
			/*
			* 	we don't have body class if the plugin was disabled
			*/
			$ext = '<style type="text/css" id="kc-basic-css">'.kc_basic_layout_css().'</style>';
			$ext .= '<p class="kc-off-notice">'.__('Notice: You are using wrong way to display KC Content', 'kingcomposer').', <a href="http://docs.kingcomposer.com/do-shortcode-for-kc-content" target=_blank>Correct It Now</a></p>';
			
			$content_processed = $kc->do_shortcode ($content);
			
			if (empty($content_processed))
			{
				$content_processed = $ext.$content_processed;
			
				$content_processed = str_replace( 
					array( "\n", 'body.kc-css-system' ), 
					array( "", 'html body' ), 
					$content_processed 
				);
			}
		
		}
		
		$data = array(
			'ID' => $id,
			'post_title'   => $_POST['post_title'],
			'post_content' => $content_processed,
			'post_content_filtered' => $content
		);
		
		if (current_user_can('publish_pages'))
			$data['post_status']  = 'publish';
		
		$wpdb->update( 
			
		    $wpdb->prefix.'posts', 
		    
		    $data,
		    
		    array( 'ID' => $id )
		);
		
	}
	else{
		
		if( $_POST['action'] !== 'inline-save'){
			$wpdb->update(
				
				$wpdb->prefix.'posts',
				
				array(
					'ID' => $id,
					'post_content_filtered' => ''
				),
				
				array( 'ID' => $id )
			);
		}
	}

}

/*
*	Include admin pages' file
*/


function kc_main_page_screen() {
	
	global $kc;
	
	if( $kc->action == 'live-editor' )
		$file = 'live.builder';
	else if( $kc->action == 'fonts-manager' )
		$file = 'fonts';
	else if( $kc->action == 'install-preset' )
		$file = 'install.preset';
	else $file = 'settings';

	require_once KC_PATH.KDS.'includes'.KDS.'kc.'.$file.'.php';
}

function kc_shortcode_mapper_screen() {

	require_once KC_PATH.KDS.'includes'.KDS.'kc.mapper.php';

}


add_action( 'kc-pro-settings-tab', 'kc_pro_settings_tab' );
function kc_pro_settings_tab() {
	
	require_once KC_PATH.KDS.'includes'.KDS.'kc.pro.php';
	
}

add_action( 'kc-top-nav', 'kc_ask2try_btn' );
add_action( 'kc-switcher-buttons', 'kc_ask2try_btn' );
function kc_ask2try_btn(){
	echo '<a class="kc-try-link" href="'.admin_url('/admin.php?page=kingcomposer#kc_pro').'">Try Front-End live editor?</a>';
}

function kc_force_default_editor() {
	// Force the editor switch to tinyMCE when the builder is active
	//allowed: tinymce, html, test
	return 'tinymce';
}

add_filter('single_template', 'kc_content_template');
function kc_content_template($single) {
	
    global $wp_query, $post;
    
    if ($post->post_type == "kc-section") 
    {    
        if (file_exists(KC_PATH.'/includes/single-section.php'))
            return KC_PATH.'/includes/single-section.php';
    }
    
    return $single;
    
}

add_filter('page_row_actions', 'kc_content_row_actions', 10, 2);
add_filter('post_row_actions', 'kc_content_row_actions', 10, 2);
 
function kc_content_row_actions ($actions, $post) {
	
	global $kc;
	if (!current_user_can('edit_posts'))
		return $actions;
	$kc_contents = $kc->get_support_content_types();
	
    // Check for your post type.
    if (in_array($post->post_type, $kc_contents)) 
    {
 
			$actions = array_merge($actions, array(
				'kc' => sprintf( '<a href="%1$s">%2$s</a>',
				    esc_url( admin_url('/post.php?action=edit&kc_action=enable_builder&post='.$post->ID) ), 
				    	__('Edit with KC', 'kingcomposer')
					) 
				)
			);
			/*
			*	Add link for KC Pro!
			*/
			if (class_exists( 'kc_pro'))
			{
				$actions = array_merge ($actions, array(
					'kc-pro' => sprintf( '<a href="%1$s">%2$s</a>',
					    esc_url( admin_url('/?page=kingcomposer&kc_action=live-editor&id='.$post->ID) ), 
					    	__('Live Edit with KC Pro!', 'kingcomposer')
						) 
					)
				);
			}
			
	}
 
    return $actions;
    
}

add_filter ('kc_autocomplete_widget_content', 'kc_widget_content_autocomplete');

function kc_widget_content_autocomplete(){
	
	global $kc;
	$kc_contents = $kc->get_support_content_types();
	$kc_contents = implode(',', $kc_contents);
	
	$query = array( 
		'post_type' => explode(',', $kc_contents), 
		'posts_per_page' => 30, 
		'post_status'  => 'publish', 
		's' => isset($_POST['s']) ? esc_attr($_POST['s']) : '' 
	);
	
	$posts = new WP_Query($query);
	$data = array();
	if ($posts->have_posts())
	{
	    	
	    while ($posts->have_posts())
	    {
	    	
	    	$posts->the_post();
	    	
	    	$type = get_post_type();
	    	$type = str_replace (array('kc-', '_', '-'),array('KC ', ' ', ' '), $type);
	    	$type = ucwords ($type);
	    	
	    	$data[get_the_ID()] = esc_attr( $type.' - '.get_the_title() );
	    	
	    }
	    
	}
	
	return $data;
	
}


add_action ('all_admin_notices', 'kc_notices_hub', 999);
function kc_notices_hub(){
	
	$screen = get_current_screen();
	$dismiss = get_option('kc_notices_dismiss', true);
	
	if (!$dismiss || !is_array($dismiss))
		$dismiss = array();
	
	if (!in_array(1, $dismiss)) {
		echo '<div class="notice notice-success"><p>'.__('New!!! KingComposer shortcode mapper is now ready, it\'ll help you to build any shortcodes very easy', 'kingcomposer').' <a href="'.admin_url('/admin.php?page=kc-mapper').'">'.__( 'Discover It Now', 'kingcomposer').'</a> <a href="?kc_action=dismiss&nid=1" class="alignright">'.__( 'Dismiss', 'kingcomposer').'</a></p></div>';
	}
	
	if ($screen->base == 'edit' && isset($_GET['post_type']) && $_GET['post_type'] == 'kc-section') {
		echo '<p><a href="'.admin_url('/edit-tags.php?taxonomy=kc-section-category&post_type=kc-section').'" class="button button-large button-primary">'.__('KC Section Categories', 'kingcomposer').'</a></p>';
	}
	
	if ($screen->base == 'edit-tags' && isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'kc-section-category' && isset($_GET['post_type']) && $_GET['post_type'] == 'kc-section') {
		echo '<p><a href="'.admin_url('/edit.php?post_type=kc-section').'" class="button button-large button-primary">'.__('Back to KC Sections List', 'kingcomposer').'</a></p>';
	}
	
}


//fix export content with post type use KC
add_filter( 'the_content_export', 'kc_the_content_export');

function kc_the_content_export( $data ){
	
	global $post, $kc;
	
	$allows_types = $kc->get_support_content_types();
	
	if (in_array($post->post_type, $allows_types) && !empty( $post->post_content_filtered))
		return $post->post_content_filtered;
	else
		return $data;
}
