<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 * Template Name Posts: FFFFFF-CECCC4
 */

get_header(); 

$custom_css = "
<style>
.post-template-kh-FFFFFF-CECCC4-single-php .svg-container {
	    display: none !important;
}

.post-template-kh-FFFFFF-CECCC4-single-php {
	    background-color: #CECCC4;
}

.post-template-kh-FFFFFF-CECCC4-single-php .entry-title {
	    color: #444;
        margin-top: 40px;
}

.post-template-kh-FFFFFF-CECCC4-single-php article.post {
	    padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;

	    background: #FFFFFF;
}

.post-template-kh-FFFFFF-CECCC4-single-php .sidebar-toggle {
	    color: #AAA797;
}

.post-template-kh-FFFFFF-CECCC4-single-php .site-footer,
.post-template-kh-FFFFFF-CECCC4-single-php .widget-area {
	    background-color: #AAA797;
}

</style>
";

echo $custom_css;

?>

	<div id="primary" class="content-area kh-FFFFFF-CECCC4">
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
