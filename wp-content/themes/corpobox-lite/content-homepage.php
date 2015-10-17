<?php
/**
 * The template used for displaying page content in homepage.php
 *
 * @package Corpobox
 */
?>

<section id="homehead">
<div class="entry-content" <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'corpobox-medium' ); ?> style="background:<?php echo esc_attr( get_theme_mod( 'corpobox_headerbg_color', '#f16272' ) ); ?><?php if  ( $thumbnail ) { ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-position: 50%; background-size: cover<?php } ?>; margin-bottom: 20px;">

	<div class="hero">		
		<h1><?php the_title(); ?></h1>
		<?php the_excerpt(); ?>
	</div>

</div><!-- .entry-content -->
</section>

<section id="homecontent">
	<div class="entry-content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
			<?php edit_post_link( __( 'Edit', 'corpobox' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
		</article>

<!-- ChildGrid -->
	<?php
		$child_pages = new WP_Query( array(
			'post_type'      => 'page',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $post->ID,
			'posts_per_page' => 9,
			'no_found_rows'  => true,
		) );
	?>

<?php
	if ( $child_pages->have_posts() ) : ?>
		<div class="grid2 clearfix">
			<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
				<div class="col">
				<?php get_template_part( 'content', 'childpage' ); ?>
				</div>
			<?php endwhile; ?>
		</div><!-- .grid2 -->

<?php
	endif;
	wp_reset_postdata();
?>
<!-- END ChildGrid -->

	</div><!-- .entry-content -->
</section><!-- .homecontent -->