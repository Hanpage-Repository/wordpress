<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-7EB5CA
 */

get_header(); 

$custom_css = "
<style>
.post-template-kh-FFFFFF-7EB5CA-single-php .svg-container {
	    display: none !important;
}

.post-template-kh-FFFFFF-7EB5CA-single-php {
	    background-color: #7EB5CA;
}

.post-template-kh-FFFFFF-7EB5CA-single-php .entry-title {
	    color: #444;
        margin-top: 40px;
}

.post-template-kh-FFFFFF-7EB5CA-single-php article.post {
	    padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;

	    background: #FFFFFF;
}

.post-template-kh-FFFFFF-7EB5CA-single-php .sidebar-toggle {
	    color: #508CA3;
}

.post-template-kh-FFFFFF-7EB5CA-single-php .site-footer,
.post-template-kh-FFFFFF-7EB5CA-single-php .widget-area {
	    background-color: #508CA3;
}

</style>
";

echo $custom_css;

?>

	<div id="primary" class="content-area kh-FFFFFF-7EB5CA">
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
