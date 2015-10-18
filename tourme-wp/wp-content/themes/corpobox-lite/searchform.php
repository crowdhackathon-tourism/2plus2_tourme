<?php
/**
 * The template for displaying search forms
 *
 * @package Corpobox
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'corpobox' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search', 'corpobox' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr( _x( 'Search', 'submit button', 'corpobox' ) ); ?>">
</form>
