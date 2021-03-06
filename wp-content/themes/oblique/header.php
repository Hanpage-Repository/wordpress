<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Oblique
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<!-- added by KH  -->
<meta name="naver-site-verification" content="b676af98f9416dcfe882719998d94a34ba22dbcc"/>
<meta name="google-site-verification" content="V_P0JXxKqXKQHL1j_mL_W28WWfsW7QYEnFP05PB1_i8" />

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-91873110-1', 'auto');
ga('send', 'pageview');
</script>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
	<?php if ( get_theme_mod('site_favicon') ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
	<?php endif; ?>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'oblique' ); ?></a>
	
	<?php // added by KH
		$menu_arr = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object($menu_arr["primary"]);
		$menu_name = $menu->name;

		if($menu_name != "primary") {
	?>

	<?php $menu_text = get_theme_mod('menu_text'); ?>
	<div class="sidebar-toggle">
	<?php if( !$menu_text || is_customize_preview() ) : ?>
		<i class="fa fa-bars<?php echo $menu_text && is_customize_preview() ? " oblique-only-customizer" : ""; ?>"></i>
	<?php endif; ?>
	<?php if( $menu_text || is_customize_preview() ) : ?>
		<?php echo '<span class="' . (!$menu_text && is_customize_preview() ? " oblique-only-customizer" : "" ) . '">' . esc_html($menu_text) . '<span>'; ?>
		<?php endif; ?>
	</div>

	<?php // added by KH
		}
	?>

	<div class="top-bar container">
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation clearfix">
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'menu_class' => 'menu clearfix', 'fallback_cb' => false ) ); ?>
			</nav>
		<?php endif; ?>
		<?php if ( !get_theme_mod('search_toggle') || is_customize_preview() ) : ?>
			<div class="header-search<?php echo get_theme_mod('search_toggle') && is_customize_preview() ? " oblique-only-customizer" : ""; ?>">
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="svg-container nav-svg svg-block">
		<?php oblique_svg_3(); ?>
	</div>
	<header id="masthead" class="site-header" role="banner">
		<div class="overlay"></div>
		<div class="container">
			<div class="site-branding">
				<?php $oblique_site_logo = get_theme_mod('site_logo'); ?>
				<?php if ( !empty($oblique_site_logo) && get_theme_mod('logo_style', 'hide-title') == 'hide-title' ) : //Show only logo ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img class="site-logo" src="<?php echo esc_url($oblique_site_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
				<?php elseif ( get_theme_mod('logo_style', 'hide-title') == 'show-title' ) : ?>
					<?php if( !empty($oblique_site_logo) ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img class="site-logo show-title" src="<?php echo esc_url($oblique_site_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
					<?php }?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php else: //Show only site title and description ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>
			</div><!-- .site-branding -->
		</div>
		<div class="svg-container header-svg svg-block">
			<?php oblique_svg_1(); ?>
		</div>		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container content-wrapper">
