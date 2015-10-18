<?php
/**
 * @package Corpobox
 */
?>

<article id="post-<?php the_ID(); ?>">
	<div class="entry-content">
		<p><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
		<hr />
	</div><!-- .entry-content -->
</article><!-- #post-## -->