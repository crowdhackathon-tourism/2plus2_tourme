<?php
/**
 * The template for displaying Category pages.
 * @package Corpobox
 */

get_header(); ?>

<?php do_action( 'before_loop_posts' ); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

	<?php endwhile; ?>

<?php else : ?>
		<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif;  // have_posts() ?>

	</div> <!-- .grid -->
		</main><!-- #main -->

<?php do_action( 'after_main_posts' ); ?>

	</div><!-- #primary -->


<?php if ( is_active_sidebar( 'sidebar-1' ) ) { get_sidebar(); } ?>
<?php get_footer(); ?>
