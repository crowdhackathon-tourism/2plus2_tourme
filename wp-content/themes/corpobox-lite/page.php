<?php
/**
 * The template for displaying pages.
 *
 * @package Corpobox
 */

get_header(); ?>

<?php if ( !is_front_page() ) : ?>

	<div id="primary" class="content-area<?php if ( !is_active_sidebar( 'sidebar-2' ) ) { ?> no-sidebar<?php } ?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( is_active_sidebar( 'sidebar-2' ) ) { get_sidebar(); } ?>

<?php endif; // !is_front_page() ?>

<?php if ( is_front_page() ) : ?>	

	<div id="primary" class="site-content">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'homepage' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->
<?php endif; // is_front_page() ?>

<?php get_footer(); ?>
