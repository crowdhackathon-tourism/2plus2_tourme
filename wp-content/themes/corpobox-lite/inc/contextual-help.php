<?php
/**
 * Theme Contextual Help
 * @package Corpobox
 */
add_filter( 'contextual_help', 'corpobox_admin_contextual_help', 10 );

function corpobox_admin_contextual_help() {
	$screen = get_current_screen();

if ( $screen->id == 'themes' ) {

  $screen->add_help_tab( array(
      'id' => 'corpobox_wellcom_tab',
      'title' => __( 'Corpobox Theme', 'corpobox' ),
      'content' => '<p><strong>' . __( 'Thank you for choosing this Theme!', 'corpobox' ) . '</strong></p><p>' . __( 'The Theme has a contextual help for almost all admin screens. More information, help and support you will find on the website DinevThemes.com', 'corpobox' ) . '</p><p><strong>' . __( 'Quick Start', 'corpobox' ) . '</strong></p><p>' . __( 'Using Customizer set your color, upload a background image (or select any color), upload the image (or select any color) header and other settings.', 'corpobox' ) . '</p><p>' . __( 'The theme has page templates for the Home Page. In the Home Tagline section can be used shortcode. For example, instead of heading to place the slider using shortcode slideshow plugin Soliloquy Sliders.', 'corpobox' ) . '</p><p>' . __( 'If for Home page is the selected page with a default page template: featured image and the title of the child pages will be shown in two columns below the main content', 'corpobox' ) . '</p><p>' . __( 'If you want to display the posts without the sidebar just leave blank (no widgets) sidebar posts.', 'corpobox' ) . '</p><p>' . __( 'Get more features and support with Corpobox Premium</a>.', 'corpobox' ) . '</p>',
  ) );

}

if ( $screen->id == 'post' ) {

	$screen->add_help_tab( array(
		'id'      => 'corpobox-post-fimg',
		'title'   => __( 'Theme Features', 'corpobox' ),
		'content' => '<p><strong>' . __( 'Theme Features', 'corpobox' ) . '</strong></p><p><strong>' . __( 'Use Featured image', 'corpobox' ) . '</strong></p><p>' . __( 'Upload the image that will be displayed header on single post.', 'corpobox' ) . '</p><p><strong>' . __( 'Use Excerpt', 'corpobox' ) . '</strong></p><p>' . __( 'Enter text in Metabox Excerpt to show announcement or the focus of the post.', 'corpobox' ) . '</p><p><strong>' . __( 'Format', 'corpobox' ) . '</strong></p><p>' . __( '<b>Quote.</b> As title, type the author quotes. Quote place in the main text box without using tag blockquote (b-quote). Featured image and Excerpt are not used.<br /><b>Link.</b> As title, type the name Link. URL place in the main text box without using http (http://). Featured image and Excerpt are not used.', 'corpobox' ) . '</p><p><strong>' . __( 'Button', 'corpobox' ) . '</strong></p><p>' . __( 'To show the button, use the link class, , for example <code>class="btn blue"</code>. Color options: green, blue, red.', 'corpobox' ) . '</p><p><strong>' . __( 'Gallery shortcode', 'corpobox' ) . '</strong></p><p>' . __( 'For a slideshow gallery use the built-in parameter shortcode Themes <code>type="slider"</code>, sample: <code>[gallery columns="..." ids="..." type="slider"]</code>', 'corpobox' ) . '</p>',
  ) );

}

if ( $screen->id == 'page' ) {

  $screen->add_help_tab( array(
      'id' => 'corpobox_page_tab',
      'title' => __( 'Theme Features', 'corpobox' ),
	'content' =>  '<p><strong>' . __( 'Theme Features', 'corpobox' ) . '</strong></p><p><strong>' . __( 'Use Featured image', 'corpobox' ) . '</strong></p><p>' . __( 'Upload the image that will be displayed header on page.', 'corpobox' ) . '</p><p><strong>' . __( 'Use Excerpt', 'corpobox' ) . '</strong></p><p>' . __( 'Enter text in Metabox Excerpt to show announcement or the focus of the page.', 'corpobox' ) . '</p><p><strong>' . __( 'Templates', 'corpobox' ) . '</strong></p><p>' . __( 'The theme has several page templates. Use metabox Page Attributes > dropdown Template.', 'corpobox' ) . '</p><p><strong>' . __( 'Button', 'corpobox' ) . '</strong></p><p>' . __( 'To show the button, use the link class, , for example <code>class="btn blue"</code>. Color options: green, blue, red.', 'corpobox' ) . '</p><p><strong>' . __( 'Gallery shortcode', 'corpobox' ) . '</strong></p><p>' . __( 'For a slideshow gallery use the built-in parameter shortcode Themes <code>type="slider"</code>, sample: <code>[gallery columns="..." ids="..." type="slider"]</code>', 'corpobox' ) . '</p>',
  ) );

}

if ( $screen->id == 'widgets' ) {

	$screen->add_help_tab( array(
		'id'      => 'corpobox-widgets',
		'title'   => __( 'Theme Features', 'corpobox' ),
		'content' =>  '<p><strong>' . __( 'Custom widgets', 'corpobox' ) . '</strong></p><p>' . __( 'The theme has a widget Corpobox-Icon that used the Home Main page template (Home Page Section Sidebar).', 'corpobox' ) . '</p>',
	) );
}

if ( $screen->id == 'appearance_page_custom-header' ) {

	$screen->add_help_tab( array(
		'id'      => 'corpobox-header',
		'title'   => __( 'Theme Features', 'corpobox' ),
		'content' =>  '<p><strong>' . __( 'Custom Header background Color', 'corpobox' ) . '</strong></p><p>' . __( 'Background color header set using Customizer. Go to Customize > Colors: Header BG Color', 'corpobox' ) . '</p>',
	) );
}

if ( $screen->id == 'nav-menus' ) {

	$screen->add_help_tab( array(
		'id'      => 'corpobox-social-menus',
		'title'   => __( 'Social Menu', 'corpobox' ),
		'content' =>  '<p><strong>' . __( 'Custom widgets', 'corpobox' ) . '</strong></p><p>' . __( 'Menu icons social media is displayed in the footer. Included all popular icons of social media, and Feedburner. To create a menu item, use the tab Links (Edit Menus). And select Social Menu as Theme locations.', 'corpobox' ) . '</p><p>' . __( 'Example:<br />tab <strong>Links</strong><br /><em>URL</em> http://twitter.com/your<br /><em>Navigation Label</em> Twitter', 'corpobox' ) . '</p>',
	) );
	$screen->add_help_tab( array(
		'id'      => 'corpobox-top-menus',
		'title'   => __( 'Top Menu', 'corpobox' ),
		'content' => __('<p><strong>Top Menu</strong></p><p>The theme has an additional top menu bar.</p><p>If you create a menu item using Links tab (Edit Menus) and links will be http://tel: OR http://mailto: OR https://goo.gl (short link google map) it will be displayed icons Font Awesome.</p><p>Example:<br />tab <strong>Links</strong><br /><em>URL</em> http://tel:+1916000000<br /><em>Navigation Label</em> +1 916 00.00.00</p>', 'corpobox' ),
	) );
}

/**
*else
*/
      return;
}
?>