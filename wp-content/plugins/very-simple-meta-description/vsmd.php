<?php
/*
 * Plugin Name: Very Simple Meta Description
 * Description: This is a very simple plugin to add meta description in the header of your WordPress website. For more info please check readme file.
 * Version: 3.8
 * Author: Guido van der Leest
 * Author URI: http://www.guidovanderleest.nl
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: very-simple-meta-description
 * Domain Path: /translation
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// load plugin text domain
function vsmd_init() { 
	load_plugin_textdomain( 'very-simple-meta-description', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'vsmd_init');


// add excerpt to pages
function vsmd_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'vsmd_page_excerpt' );


// add settings link
function vsmd_action_links ( $links ) { 
	$settingslink = array( '<a href="'. admin_url( 'options-general.php?page=vsmd' ) .'">'. __('Settings', 'very-simple-meta-description') .'</a>', ); 
	return array_merge( $links, $settingslink ); 
} 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'vsmd_action_links' ); 
 

// add admin options page
function vsmd_menu_page() {
	add_options_page( __( 'Meta Description', 'very-simple-meta-description' ), __( 'Meta Description', 'very-simple-meta-description' ), 'manage_options', 'vsmd', 'vsmd_options_page' );
}
add_action( 'admin_menu', 'vsmd_menu_page' );


// add admin settings and such 
function vsmd_admin_init() {
	add_settings_section( 'vsmd-section', __( 'Meta Description', 'very-simple-meta-description' ), 'vsmd_section_callback', 'vsmd' );
	add_settings_field( 'vsmd-field', __( 'Meta Description', 'very-simple-meta-description' ), 'vsmd_field_callback', 'vsmd', 'vsmd-section' );
	register_setting( 'vsmd-options', 'vsmd-setting', 'sanitize_text_field' );
	add_settings_field( 'vsmd-field-1', __( 'Homepage', 'very-simple-meta-description' ), 'vsmd_field_callback_1', 'vsmd', 'vsmd-section' );
	register_setting( 'vsmd-options', 'vsmd-setting-1', 'sanitize_text_field' );
	add_settings_field( 'vsmd-field-2', __( 'Excerpt', 'very-simple-meta-description' ), 'vsmd_field_callback_2', 'vsmd', 'vsmd-section' );
	register_setting( 'vsmd-options', 'vsmd-setting-2', 'sanitize_text_field' );

	add_settings_section( 'vsmd-section-2', __( 'Open Graph', 'very-simple-meta-description' ), 'vsmd_section_callback_2', 'vsmd' );
	add_settings_field( 'vsmd-field-3', __( 'Open Graph', 'very-simple-meta-description' ), 'vsmd_field_callback_3', 'vsmd', 'vsmd-section-2' );
	register_setting( 'vsmd-options', 'vsmd-setting-3', 'sanitize_text_field' );
	add_settings_field( 'vsmd-field-4', __( 'Open Graph default image', 'very-simple-meta-description' ), 'vsmd_field_callback_4', 'vsmd', 'vsmd-section-2' );
	register_setting( 'vsmd-options', 'vsmd-setting-4', 'sanitize_text_field' );

	add_settings_section( 'vsmd-section-3', __( 'Twitter Cards', 'very-simple-meta-description' ), 'vsmd_section_callback_3', 'vsmd' );
	add_settings_field( 'vsmd-field-5', __( 'Twitter Cards', 'very-simple-meta-description' ), 'vsmd_field_callback_5', 'vsmd', 'vsmd-section-3' );
	register_setting( 'vsmd-options', 'vsmd-setting-5', 'sanitize_text_field' );
	add_settings_field( 'vsmd-field-6', __( 'Twitter username', 'very-simple-meta-description' ), 'vsmd_field_callback_6', 'vsmd', 'vsmd-section-3' );
	register_setting( 'vsmd-options', 'vsmd-setting-6', 'sanitize_text_field' );
}
add_action( 'admin_init', 'vsmd_admin_init' );

function vsmd_section_callback() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'Search engines such as Google and Bing use the meta description in their search results.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'If no meta description is entered the tagline will be used.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'Using the same meta description for all posts and pages is not SEO friendly.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'While adding a post or page you can set an excerpt using the custom excerpt box.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'If these boxes are not present, they might be unchecked in Screen Options.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_section_callback_2() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'Open Graph offers a sharing integration between your website and social media platforms such as Facebook and Twitter.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'Upload your Open Graph default image in the media library and copy-paste link here.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'The recommended image size is at least 1200 x 630 pixels.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'The minimum image size is 200 x 200 pixels.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_section_callback_3() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'This requires a Twitter account.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'With Twitter Cards you can attach page or post content to tweets, helping to drive traffic to your website.', 'very-simple-meta-description' ).'</li>';
	echo '<li>'.esc_attr__( 'Twitter Cards uses Open Graph tags. This means that Open Graph should be activated too.', 'very-simple-meta-description' ).'</li>';
	echo '</ul>';
}

function vsmd_field_callback() {
	$vsmd_setting = esc_attr( get_option( 'vsmd-setting' ) );
	$vsmd_count = strlen(get_option( 'vsmd-setting' ) );
	echo "<input type='text' size='60' maxlength='160' name='vsmd-setting' value='$vsmd_setting' />";
	?>
	<p><?php printf( esc_attr__( 'You have used %s of 160 characters.', 'very-simple-meta-description' ), $vsmd_count ); ?></p>
	<?php
}

function vsmd_field_callback_1() {
	$value = esc_attr( get_option( 'vsmd-setting-1' ) );
	?>
	<input type='hidden' name='vsmd-setting-1' value='no'>
	<label><input type='checkbox' name='vsmd-setting-1' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use this meta description for homepage only.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_2() {
	$value = esc_attr( get_option( 'vsmd-setting-2' ) );
	?>
	<input type='hidden' name='vsmd-setting-2' value='no'>
	<label><input type='checkbox' name='vsmd-setting-2' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use the custom post and page excerpt as meta description.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_3() {
	$value = esc_attr( get_option( 'vsmd-setting-3' ) );
	?>
	<input type='hidden' name='vsmd-setting-3' value='no'>
	<label><input type='checkbox' name='vsmd-setting-3' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Support Open Graph on every post and page.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_4() {
	$vsmd_setting_4 = esc_url( get_option( 'vsmd-setting-4' ) );
	echo "<input type='text' size='60' maxlength='150' name='vsmd-setting-4' value='$vsmd_setting_4' />";
	?>
	<p><?php _e( 'For posts and pages without a featured image.', 'very-simple-meta-description' ); ?></p>
	<?php
}

function vsmd_field_callback_5() {
	$value = esc_attr( get_option( 'vsmd-setting-5' ) );
	?>
	<input type='hidden' name='vsmd-setting-5' value='no'>
	<label><input type='checkbox' name='vsmd-setting-5' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Support Twitter Cards on every post and page.', 'very-simple-meta-description' ); ?></label>
	<?php
}

function vsmd_field_callback_6() {
	$vsmd_setting_6 = esc_attr( get_option( 'vsmd-setting-6' ) );
	$vsmd_count = strlen(get_option( 'vsmd-setting-6' ) );
	echo "<input type='text' size='60' maxlength='150' name='vsmd-setting-6' value='$vsmd_setting_6' />";
	?>
	<p><?php _e( 'Example: @username', 'very-simple-meta-description' ); ?></p>
	<?php
}


// display admin options page
function vsmd_options_page() {
?>
<div class="wrap"> 
	<div id="icon-plugins" class="icon32"></div> 
	<h1><?php _e( 'Very Simple Meta Description', 'very-simple-meta-description' ); ?></h1> 
	<form action="options.php" method="POST">
	<?php settings_fields( 'vsmd-options' ); ?>
	<?php do_settings_sections( 'vsmd' ); ?>
	<?php submit_button(); ?>
	</form>
	<p><?php _e( 'More info', 'very-simple-meta-description' ); ?>: <a href="https://wordpress.org/plugins/very-simple-meta-description" target="_blank"><?php _e( 'click here', 'very-simple-meta-description' ); ?></a></p>
</div>
<?php
}


// include all tags in header 
function vsmd_meta_description() {
	if ( is_404() || is_search() ) 
		return;
	global $post;
	$vsmd_meta = esc_attr( get_option( 'vsmd-setting' ) );
	$vsmd_homepage = esc_attr( get_option( 'vsmd-setting-1' ) );
	$vsmd_posts = esc_attr( get_option( 'vsmd-setting-2' ) );
	$vsmd_og = esc_attr( get_option( 'vsmd-setting-3' ) );
	$vsmd_twitter = esc_attr( get_option( 'vsmd-setting-5' ) );
	$vsmd_twitter_user = esc_attr( get_option( 'vsmd-setting-6' ) );
	$vsmd_sitename = get_bloginfo( 'name' );
	$vsmd_tagline = get_bloginfo( 'description' );
	$vsmd_title = get_the_title($post->ID);
	$vsmd_excerpt = get_the_excerpt();
	$vsmd_homelink = get_home_url();
	$vsmd_permalink = get_permalink($post->ID);
	$vsmd_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	$vsmd_default_image = esc_url( get_option( 'vsmd-setting-4' ) );

	// meta description
	if ( $vsmd_homepage != 'yes' ) {
		if ( $vsmd_posts == 'yes' && is_singular( array('post', 'page', 'product') ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} elseif ( empty($vsmd_meta) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_tagline).'" />'."\n";
		} else {
			echo '<meta name="description" content="'.esc_attr($vsmd_meta).'" />'."\n";
		}
	} 
	if ( $vsmd_homepage == 'yes' && is_front_page() ) {
		if ( empty( $vsmd_meta ) ) {
			echo '<meta name="description" content="'.esc_attr($vsmd_tagline).'" />'."\n";
		} else {
			echo '<meta name="description" content="'.esc_attr($vsmd_meta).'" />'."\n";
		}
	} 
	if ( $vsmd_homepage == 'yes' && $vsmd_posts == 'yes' && is_singular( array('post', 'page', 'product') ) && has_excerpt($post->ID) ) {
		echo '<meta name="description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
	}

	// twitter cards
	if ( $vsmd_og == 'yes' && $vsmd_twitter == 'yes' ) {
		echo '<meta name="twitter:card" content="summary" />'."\n";
		if ( !empty( $vsmd_twitter_user ) ) {
			echo '<meta name="twitter:site" content="'.esc_attr($vsmd_twitter_user).'" />'."\n";
		}
	}

	// open graph
	if ( $vsmd_og == 'yes' ) {
		echo '<meta property="og:site_name" content="'.esc_attr($vsmd_sitename).'" />'."\n";
		if ( is_singular( 'post' ) ) { 
			echo '<meta property="og:type" content="article"/>'."\n";
		} elseif ( is_singular('product') ) {
			echo '<meta property="og:type" content="product"/>'."\n";
		} else {
			echo '<meta property="og:type" content="website"/>'."\n";
		}
		if ( is_front_page() || is_home() || is_archive() ) {
			echo '<meta property="og:title" content="'.esc_attr($vsmd_sitename).'" />'."\n";
			echo '<meta property="og:url" content="'.esc_url($vsmd_homelink).'" />'."\n";
		} else {
			echo '<meta property="og:title" content="'.esc_attr($vsmd_title).'" />'."\n";
			echo '<meta property="og:url" content="'.esc_url($vsmd_permalink).'" />'."\n";
		}
		if ( $vsmd_posts == 'yes' && is_singular( array('post', 'page', 'product') ) && has_excerpt($post->ID) ) {
			echo '<meta property="og:description" content="'.esc_attr($vsmd_excerpt).'" />'."\n";
		} elseif ( $vsmd_homepage != 'yes' ) {
			echo '<meta property="og:description" content="'.esc_attr($vsmd_meta).'" />'."\n";
		} else {
			echo '<meta property="og:description" content="'.esc_attr($vsmd_tagline).'" />'."\n";
		}
		if ( is_singular( array('post', 'page', 'product') ) && !empty($vsmd_featured_image) ) { 
			echo '<meta property="og:image" content="'.esc_url($vsmd_featured_image).'" />'."\n";
		} elseif ( !empty($vsmd_default_image) ) {
			echo '<meta property="og:image" content="'.esc_url($vsmd_default_image).'" />'."\n";
		}
	}
}
add_action( 'wp_head', 'vsmd_meta_description' );

?>