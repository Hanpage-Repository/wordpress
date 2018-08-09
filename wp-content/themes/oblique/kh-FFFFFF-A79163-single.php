<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-A79163
 */

?>
<?php


get_header(); 

//$atts['name'] = "kopubbatang";

//kh_shortcode_font($atts);

//wp_enqueue_style( 'oblique-style', get_stylesheet_uri() );

// oblique-style

$custom_css = "
.post-template-kh-FFFFFF-A79163-single-php .svg-container {
	display: none !important;
}";

wp_add_inline_style( 'oblique-style', $custom_css );


?>

	<div id="primary" class="content-area kh-FFFFFF-A79163">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
