<?php
/**
 * The Sidebar containing the Project widget areas.
 *
 * @package Corpobox
 */
?>
	<div id="secondary" class="widget-area" role="complementary">

		<?php if ( ! dynamic_sidebar( 'project' ) ) : ?>
		<?php endif; // end sidebar widget area ?>

	</div><!-- #secondary -->
