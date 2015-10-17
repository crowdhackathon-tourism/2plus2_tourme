<?php
/**
 * The template 404 pages (Not Found).
 *
 * @package Corpobox
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">

				<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'corpobox' ); ?></h1>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'corpobox' ); ?></p>
				<?php the_widget( 'WP_Widget_Search' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>