<?php
/**
 * The template for WooCommerce Shop
 * Template Name: WooCommerce
 *
 * @package Corpobox
 */

get_header(); ?>

	<div id="primary" class="content-area<?php if ( !is_active_sidebar( 'store' ) ) { ?> no-sidebar<?php } ?>">
		<main id="main-woocommerce" class="site-main" role="main">

			<?php woocommerce_content(); ?>

		</main><!-- #main-woocommerce -->
	</div><!-- #primary -->

	<?php if ( is_active_sidebar( 'store' ) ) { get_sidebar('store'); } ?>

<?php get_footer(); ?>
