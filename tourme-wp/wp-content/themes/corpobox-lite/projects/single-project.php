<?php
/**
 * The Template for displaying all single projects
 */

get_header(); ?>

<div id="primary" class="content-area<?php if ( !is_active_sidebar( 'project' ) ) { ?> no-sidebar<?php } ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php projects_get_template_part( 'content', 'single-project' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( is_active_sidebar( 'project' ) ) { get_sidebar( 'projects' ); } ?>

<?php get_footer(); ?>