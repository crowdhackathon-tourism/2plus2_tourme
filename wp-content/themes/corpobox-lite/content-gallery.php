<?php
/**
 * The template for Gallery post format
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() ) : ?>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php if ( has_excerpt() ) : ?>
		<?php the_excerpt(); ?>
			<?php endif; //has_excerpt() ?>	
	</header><!-- .entry-header -->

	<div class="entry-content">
			<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta<?php if ( !is_active_sidebar( 'sidebar-1' ) ) { ?> no-sidebar<?php } ?>">
			
                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'corpobox' ), __( '1 Comment', 'corpobox' ), __( 'Comments: %', 'corpobox' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php else : // is_single() ?>

	<div class="entry-content">

		<?php echo get_post_gallery(); ?>

		<div class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php if ( has_excerpt() ) : ?>
			<?php the_excerpt(); ?>
				<?php endif; //has_excerpt() ?>	
		</div><!--.entry-header-->

	</div><!-- .entry-content -->

<?php endif; ?>
</article><!-- #post-## -->
