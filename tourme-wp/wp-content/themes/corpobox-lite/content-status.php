<?php
/**
 * The template for Status post format
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( is_single() ) : ?>

	<div class="entry-content" style="margin-bottom:20px;">

		<div class="status">
<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 48 ); ?></a>
		</div><!--.status-->

		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		<p><?php echo mb_substr( strip_tags( get_the_content() ), 0, 140 ); ?></p>

	</div><!-- .entry-content -->


	<footer class="entry-meta<?php if ( !is_active_sidebar( 'sidebar-1' ) ) { ?> no-sidebar<?php } ?>">
			
                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'corpobox' ), __( '1 Comment', 'corpobox' ), __( 'Comments: %', 'corpobox' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php else : ?>

	<div class="entry-content">

		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 72 ); ?><br />
		<h3 class="page-title"><?php the_title(); ?></h3><br />
		<i class="fa fa-flag"></i><br />
		<p><?php echo mb_substr( strip_tags( get_the_content() ), 0, 80 ); ?></p>

	</div><!-- .entry-content -->

	<?php endif; ?>

</article><!-- #post-## -->
