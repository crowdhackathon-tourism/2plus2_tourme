<?php
/**
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() ) : ?>

	<div class="entry-content">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('corpobox-big'); ?></a>
			</div>
		<?php endif; //has_post_thumbnail() ?>

	<?php the_content(); ?>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'corpobox' ),
				'after'  => '</div>',
			) );
			?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
			
                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'corpobox' ), __( '1 Comment', 'corpobox' ), __( 'Comments: %', 'corpobox' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php else : // not single ?>

	<div class="entry-content<?php if ( !has_post_thumbnail() ) { ?> no-thumbnail<?php } ?>">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('corpobox-big'); ?></a></div>
		<?php } ?>

			<span class="entry-meta"><?php corpobox_posted_on(); ?></span>

			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( has_post_thumbnail() ) : ?>

			<?php if ( has_excerpt() ) { ?>
				<?php the_excerpt(); ?>
			<?php } ?>

			<?php if ( ! has_excerpt() ) { ?>
				<?php corpobox_excerpt( 30 ); ?>
			<?php } ?>

		<?php else : ?>

			<?php if ( has_excerpt() ) { ?>
				<?php corpobox_excerpt( 60 ); ?>
			<?php } ?>

			<?php if ( ! has_excerpt() ) { ?>
				<?php corpobox_excerpt( 95 ); ?>
			<?php } ?>

		<?php endif; //has_post_thumbnail() ?>

	</div><!-- .entry-content -->

<?php endif; ?>
</article>