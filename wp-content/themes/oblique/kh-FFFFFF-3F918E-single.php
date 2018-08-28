<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-3F918E
 */

get_header(); 

$custom_css = "
<style>
.post-template-kh-FFFFFF-3F918E-single-php .svg-container {
	    display: none !important;
}

.post-template-kh-FFFFFF-3F918E-single-php {
	    background-color: #3F918E;
}

.post-template-kh-FFFFFF-3F918E-single-php .entry-title {
	    color: #444;
        margin-top: 40px;
}

.post-template-kh-FFFFFF-3F918E-single-php article.post {
	    padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;

	    background: #FFFFFF;
}

.post-template-kh-FFFFFF-3F918E-single-php .sidebar-toggle {
	    color: #267C79;
}

.post-template-kh-FFFFFF-3F918E-single-php .site-footer,
.post-template-kh-FFFFFF-3F918E-single-php .widget-area {
	    background-color: #267C79;
}

</style>
";

echo $custom_css;

?>

	<div id="primary" class="content-area kh-FFFFFF-3F918E">
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
