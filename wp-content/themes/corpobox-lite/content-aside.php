<?php
/**
 * The template for Aside post format
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( is_single() ) : ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta<?php if ( !is_active_sidebar( 'sidebar-1' ) ) { ?> no-sidebar<?php } ?>">
		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php else : ?>

	<div class="entry-content">
		<div><i class="fa fa-asterisk"></i><br /><p><?php corpobox_excerpt( 80 ); ?></p></div>
	</div><!-- .entry-content -->

<?php endif; ?>

</article><!-- #post -->
