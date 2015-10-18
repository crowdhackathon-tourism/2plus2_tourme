<?php
/**
 * Setup the WordPress Header feature.
 * @package Corpobox
 */

if ( ! function_exists( 'corpobox_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see corpobox_custom_header_setup().
 */
function corpobox_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			/*position: absolute;
			clip: rect(1px, 1px, 1px, 1px);*/
                                                display: none;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // corpobox_header_style



if ( ! function_exists( 'corpobox_admin_header_style' ) ) :

function corpobox_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			max-height: 250px;
		}
		#headimg img {
			display: block;
			margin: 0 auto;
			width: 100%;
			height: auto;
			max-height: 250px;
		}
		#headimg {
			background: <?php echo esc_attr( get_theme_mod( 'corpobox_headerbg_color', '#f16272' ) ); ?> url(<?php header_image(); ?>) no-repeat 50% 0;
			-webkit-background-size: cover;
			-moz-background-size:    cover;
			-o-background-size:      cover;
			background-size:         cover;
			width: 100%;
			height: 250px;
text-align:center;
padding-top:80px;
}
	</style>
<?php
}
endif; // corpobox_admin_header_style

if ( ! function_exists( 'corpobox_admin_header_image' ) ) :

function corpobox_admin_header_image() {
	$style = sprintf( ' style="line-height: 0.5;color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
<h1 class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'name' ); ?></h1>
<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
<img src="<?php //header_image(); ?>" />
		<?php endif; ?>
	</div>
<?php
}
endif; // corpobox_admin_header_image
