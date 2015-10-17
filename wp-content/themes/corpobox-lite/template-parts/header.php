<?php
/**
 * @package Corpobox
 */
?>

<header class="page-header wrap">

<?php
	/**
	 * Page
	 */
	if ( is_page() ) { ?>

		<?php corpobox_breadcrumb(); ?>
<?php
	} ?>

<?php
	/**
	 * Post
	 */
	if ( is_single() ) { ?>

	<nav id="single-nav">
		<?php previous_post_link('<div id="single-nav-right">%link</div>', '<i class="fa fa-chevron-left"></i>', false); ?>
		<?php next_post_link('<div id="single-nav-left">%link</div>', '<i class="fa fa-chevron-right"></i>', false); ?>
	</nav><!-- /single-nav -->

		<?php corpobox_breadcrumb(); ?>
<?php
	} ?>

<?php
	/**
	 * Template Projects
	 */
if ( class_exists( 'Projects' ) ) {
	if ( is_projects() && !is_single() ) { ?>
			<h1 class="page-title"><?php projects_page_title(); ?></h1>
			<div class="taxonomy-description"><?php do_action( 'projects_archive_description' ); ?></div>
<?php
	}
} ?>

<?php
	/**
	 * Template WooCommerce
	 */
if ( is_woocommerce_activated() ) {
	if ( is_woocommerce() && !is_product() ) { ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<ul class="header-cart"><?php corpobox_cart_link(); ?></ul>
<?php
	}
} ?>

<?php
	/**
	 * Search
	 */
	if ( is_search() ) { ?>
		<h1 class="page-title">
		<?php printf( __( 'Search Results for: %s', 'corpobox' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
<?php
	} ?>

<?php
	/**
	 * Archives
	 */
	if ( is_archive() && !is_post_type_archive( array( 'product', 'project' ) ) && !is_tax( array( 'project-category', 'product_cat' ) ) || is_home() && !is_front_page() ) { ?>

		<h1 class="page-title">

		<?php
			if ( is_category() ) :
				single_cat_title();

			elseif ( is_tag() ) :
				_e( 'Tag: ', 'corpobox' );
				single_tag_title();

			elseif ( is_author() ) :
				the_post();
				printf( __( 'Author: %s', 'corpobox' ), '<span class="vcard">' . get_the_author() . '</span>' );
				rewind_posts();

			elseif ( is_day() ) :
				printf( __( 'Day: %s', 'corpobox' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Month: %s', 'corpobox' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Year: %s', 'corpobox' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				_e( 'Asides', 'corpobox' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				_e( 'Images', 'corpobox');

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				_e( 'Videos', 'corpobox' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				_e( 'Quotes', 'corpobox' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				_e( 'Links', 'corpobox' );

			elseif ( is_home() && !is_front_page() ) :
				_e( 'Blog', 'corpobox' );

			else :
				_e( 'Archives', 'corpobox' );

			endif;
		?>

		</h1>
		<?php
			// Show an optional term description.
			$term_description = term_description();

				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
		?>
<?php
	}
?>

<?php
	/**
	 * Not found
	 */
	if ( is_404() ) { ?>
		<h1 class="page-title">Error 404: Not Found</h1>
<?php
	} ?>

</header>