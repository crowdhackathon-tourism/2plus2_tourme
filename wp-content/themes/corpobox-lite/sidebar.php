<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Corpobox
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>


<?php if ( is_page() ) { ?>

<?php
	if ( has_nav_menu( 'primary' ) && false === get_theme_mod( 'corpobox_submenu_pages' ) ) {
		do_action( 'display_submenu_sidebar' );	
	}
?>
		<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>


		<?php endif; // end sidebar widget area ?>

<?php }else{ // is_page() ?>

		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

		<?php endif; // end sidebar widget area ?>
<?php } // is_page() ?>

	</div><!-- #secondary -->
