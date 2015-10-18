<?php
/**
 * The template for Link post format
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<div class="entry-content" <?php background_post_formats(); ?>>
<?php
	$textlink = get_the_title();
	$content = get_the_content();
	$content = apply_filters('the_content', $content);

	$repl = array( '<p>', '</p>', '<br />', 'http://' );
	$torepl   = array( '', '">' . $textlink . '</a>', '', '' );

	$content = '<div class="metka genericon genericon-' . get_post_format() . '" style="color:#FFF;"></div><a style="color:#FFF;text-decoration:none;" href="http://' . str_replace( $repl, $torepl, $content );

	echo $content;
?>
		</div><!-- .entry-content -->

		<footer class="entry-meta<?php if ( !is_active_sidebar( 'sidebar-1' ) ) { ?> no-sidebar<?php } ?>">
			
                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'corpobox' ), __( '1 Comment', 'corpobox' ), __( 'Comments: %', 'corpobox' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- .entry-meta -->

	<?php else : ?>

		<div class="entry-content" <?php background_post_formats(); ?>>
<?php
	$textlink = get_the_title();
	$content = get_the_content();
	$content = apply_filters('the_content', $content);

	$repl = array( '<p>', '</p>', '<br />', 'http://' );
	$torepl   = array( '', '">' . $textlink . '</a>', '', '' );

	$content = '<h3 class="page-title" style="margin-top: 20px";><a style="color:#FFF;text-decoration:none;" href="http://' . str_replace( $repl, $torepl, $content );

	echo $content . '</h3><br /><i class="fa fa-link"></i>';
?>
		</div><!-- .entry-content -->

	<?php endif; // is_single() ?>

</article><!-- #post -->
