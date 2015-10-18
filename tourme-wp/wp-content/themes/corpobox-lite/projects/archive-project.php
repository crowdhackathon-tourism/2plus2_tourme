<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive
 */
get_header(); ?>
<?php if ( have_posts() ) : ?>

	<div id="primary" class="content-area<?php if ( !is_active_sidebar( 'project' ) ) { ?> no-sidebar<?php } ?>">
		<main id="main" class="site-main" role="main">

		<div class="projects grid<?php if ( !is_active_sidebar( 'project' ) ) { ?>3<?php }else{ ?>2<?php } ?> clearfix">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php projects_get_template_part( 'content', 'project' ); ?>

				<?php endwhile; // end of the loop. ?>

		</div><!-- .projects -->

		<?php else : ?>

			<?php projects_get_template( 'loop/no-projects-found.php' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( is_active_sidebar( 'project' ) ) { get_sidebar( 'projects' ); } ?>

<?php get_footer(); ?>