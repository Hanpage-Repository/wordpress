<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-293F2D
 */

get_header(); 

$custom_css = "
<style>
.post-template-kh-FFFFFF-293F2D-single-php .svg-container {
	    display: none !important;
}

.post-template-kh-FFFFFF-293F2D-single-php {
	    background-color: #293F2D;
}

.post-template-kh-FFFFFF-293F2D-single-php .entry-title {
	    color: #444;
        margin-top: 40px;
}

.post-template-kh-FFFFFF-293F2D-single-php article.post {
	    padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;

	    background: #FFFFFF;
}

.post-template-kh-FFFFFF-293F2D-single-php .sidebar-toggle {
	    color: #233626;
}

.post-template-kh-FFFFFF-293F2D-single-php .site-footer,
.post-template-kh-FFFFFF-293F2D-single-php .widget-area {
	    background-color: #233626;
}

</style>
";

echo $custom_css;

?>

	<div id="primary" class="content-area kh-FFFFFF-293F2D">
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
