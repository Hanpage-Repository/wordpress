<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-ECC6BF
 */

get_header(); 

$custom_css = "
<style>
.post-template-kh-FFFFFF-ECC6BF-single-php .svg-container {
	    display: none !important;
}

.post-template-kh-FFFFFF-ECC6BF-single-php {
	    background-color: #ECC6BF;
}

.post-template-kh-FFFFFF-ECC6BF-single-php .entry-title {
	    color: #444;
        margin-top: 40px;
}

.post-template-kh-FFFFFF-ECC6BF-single-php article.post {
	    padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;

	    background: #FFFFFF;
}

.post-template-kh-FFFFFF-ECC6BF-single-php .sidebar-toggle {
	    color: #D46A6A;
}

.post-template-kh-FFFFFF-ECC6BF-single-php .site-footer,
.post-template-kh-FFFFFF-ECC6BF-single-php .widget-area {
	    background-color: #D46A6A;
}

</style>
";

echo $custom_css;

?>

	<div id="primary" class="content-area kh-FFFFFF-ECC6BF">
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
