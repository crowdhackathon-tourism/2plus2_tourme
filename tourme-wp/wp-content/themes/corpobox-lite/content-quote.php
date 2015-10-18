<?php
/**
 * The template for Quote post format
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( is_single() ) : ?>

	<div class="entry-content">
<?php
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'corpobox-medium' );

	$content = get_the_content();
	$content = apply_filters('the_content', $content);

	$repl = array('<p>', '</p>', '<br />');
	$torepl   = array('<blockquote>', '</blockquote>', '');

	$cite = get_the_title();

	$content = str_replace( $repl, $torepl, $content );

	echo '<cite>' . $cite . ':</cite>';
?>
		<div style="margin-bottom:10px;padding-top:20px;color:#FFF;background:<?php echo esc_attr( get_theme_mod( 'corpobox_link_color', '#00a5e7' ) ); ?><?php if  ( $thumbnail ) { ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-position: 50%; background-size: cover<?php } ?>;">
		<?php echo $content . '</div>'; ?>

	</div><!-- .entry-content -->

	<footer class="entry-meta<?php if ( !is_active_sidebar( 'sidebar-1' ) ) { ?> no-sidebar<?php } ?>">
		<?php edit_post_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php else : ?>

	<div class="entry-content" <?php background_post_formats(); ?>>
		<i class="fa fa-quote-left"></i><br />
		<?php corpobox_excerpt( 40 ); ?>
		<h5><?php the_title(); ?></h5>
	</div><!-- .entry-content -->
		
<?php endif; ?>

</article>
