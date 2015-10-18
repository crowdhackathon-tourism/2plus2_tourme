<?php
/**
 * Excerpt related functions
 * Based on wp_trim_words
 * Learn more at http://codex.wordpress.org/Function_Reference/wp_trim_words
 */

if ( !function_exists( 'corpobox_excerpt' ) ) {
	function corpobox_excerpt($length=30, $readmore=false ) {
		global $post;
		$id = $post->ID;
		if ( has_excerpt( $id ) ) {
			$output = '<p class="corpobox-excerpt">' . wp_trim_words( strip_shortcodes( get_the_excerpt( $id ) ), 30) . '</p>';
			$output .= '<p>' . wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length) . '</p>';
		} else {
			$output = '<p>' . wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length) . '</p>';
			if ( $readmore == true ) {
				$readmore_link = '<span class="corpobox-readmore"><a href="'. get_permalink( $id ) .'" title="'. __('reading', 'corpobox' ) .'" rel="bookmark">'. __('Read more', 'corpobox' ) .'</a></span>';
				$output .= apply_filters( 'corpobox_readmore_link', $readmore_link );
			}
		}
		echo $output;
	}
}

/**
 * Change default excerpt read more style
*/
if ( !function_exists( 'corpobox_excerpt_more' ) ) {
	function corpobox_excerpt_more($more) {
		global $post;
		return '...';
	}
}
add_filter( 'excerpt_more', 'corpobox_excerpt_more' );