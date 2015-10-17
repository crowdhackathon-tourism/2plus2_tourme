<?php
/**
 * Theme functions and definitions
 *
 * @package Corpobox
 */

/**
 * Set the content width for theme design
 */
if ( ! isset( $content_width ) ) {
	$content_width = 784; /* pixels */
}

if ( ! function_exists( 'corpobox_content_width' ) ) :

	function corpobox_content_width() {
		global $content_width;

		if ( is_page_template( array( 'template-fullpage.php', 'template-home-main.php' ) ) || is_front_page() ) {
			$content_width = 1200;
		}
	}

endif;
add_action( 'template_redirect', 'corpobox_content_width' );

if ( ! function_exists( 'corpobox_setup' ) ) :
function corpobox_setup() {

	 /** Markup for search form, comment form, and comments
	 * valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/**
	 * Make theme available for translation
	 */
	load_theme_textdomain( 'corpobox', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Excerpt on Pages.
	 * See http://codex.wordpress.org/Excerpt
	 */
	add_post_type_support( 'page', 'excerpt' );

	/**
	 * Enable support WooCommerce
	 */
	add_theme_support( 'woocommerce' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', corpobox_fonts_url() ) );

	/*
	 * Let WordPress 4.1+ manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

                set_post_thumbnail_size( 400, 350, true );

                add_image_size( 'corpobox-aside', 800, 9999, true );
                add_image_size( 'corpobox-medium', 1080, 9999, true );
	add_image_size( 'corpobox-small', 140, 140, true );
                add_image_size( 'corpobox-big', 1200, 9999, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'top' => __( 'Top Menu', 'corpobox' ),
		'primary' => __( 'Primary Menu', 'corpobox' ),
		'social' => __( 'Social Menu', 'corpobox' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'link', 'aside', 'status', 'gallery' ) );

	/**
	 * Setup the WordPress core custom header image.
	 */
	add_theme_support( 'custom-header', apply_filters( 'corpobox_custom_header_args', array(
                                'header-text'            => true,
		'default-text-color'     => 'fff',
		'width'                  => 1020,
		'height'                 => 450,
		'flex-height'            => true,
                                'flex-width'    => true,
		'wp-head-callback'       => 'corpobox_header_style',
		'admin-head-callback'    => 'corpobox_admin_header_style',
		'admin-preview-callback' => 'corpobox_admin_header_image',
	) ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'corpobox_custom_background_args', array(
		'default-color' => 'eaeaea',
		//'default-image' => get_template_directory_uri().'/img/bg.jpg',
	) ) );
}
endif; // corpobox_setup
add_action( 'after_setup_theme', 'corpobox_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function corpobox_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Posts', 'corpobox' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Pages', 'corpobox' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
       register_sidebar(array(
            'name' => __('Home Page Section', 'corpobox'),
            'description' => __('The area Home Main page template section content in 2,3,4 column.', 'corpobox'),
            'id' => 'home-page-section',
            'before_title' => '<p class="widget-title">',
            'after_title' => '</p>',
            'before_widget' => '<div class="col">',
            'after_widget' => '</div>'
        ));
       register_sidebar(array(
            'name' => __('Footer1', 'corpobox'),
            'description' => __('Located in the footer left.', 'corpobox'),
            'id' => 'footer1',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
       register_sidebar(array(
            'name' => __('Footer2', 'corpobox'),
            'description' => __('Located in the footer center.', 'corpobox'),
            'id' => 'footer2',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
       register_sidebar(array(
            'name' => __('Footer3', 'corpobox'),
            'description' => __('Located in the footer right.', 'corpobox'),
            'id' => 'footer3',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>'
        ));
}
add_action( 'widgets_init', 'corpobox_widgets_init' );

/**
 * Register Google fonts for Theme
 * Better way
 */
if ( ! function_exists( 'corpobox_fonts_url' ) ) :

function corpobox_fonts_url() {
    $fonts_url = '';
 
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'corpobox' );
 
    if ( 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:300italic,400italic,700italic,400,600,700,300';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,cyrillic' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}
endif;

/**
 *=Enqueue scripts
 */
function corpobox_scripts() {
                wp_enqueue_style( 'corpobox-style', get_stylesheet_uri() );

	wp_enqueue_script( 'corpobox-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '13072014', true );

	wp_enqueue_style( 'corpobox-fonts', corpobox_fonts_url(), array(), null );

	wp_enqueue_style( 'font-genericons', get_template_directory_uri() . '/genericons/genericons.css?v=3.2' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css?v=4.2' );

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ), '23062015', true );

	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '/css/flexslider.css?v=1307' );

	wp_enqueue_style('prettyPhoto-style', get_template_directory_uri().'/css/prettyPhoto.css', array(), '1.0', 'all' );

	wp_enqueue_script( 'script-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array(), '1.0', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '13072014', true );

	wp_enqueue_script( 'corpobox-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', get_template_directory_uri() . '/js/comment-reply.min.js', array(), '1.0', true );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '13072014' );
	}
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'corpobox-infinite', get_template_directory_uri() . '/js/infinite.grid2.js', array(), '10072015' );
	}
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) && ! is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'corpobox-infinite', get_template_directory_uri() . '/js/infinite.grid3.js', array(), '10072015' );
	}
}
add_action( 'wp_enqueue_scripts', 'corpobox_scripts' );

/**
 * Add lightbox prettyPhoto for link to image
 */
function corpobox_prettyPhoto( $html, $id, $size, $permalink, $icon, $text ) {
	
    if ( ! $permalink )
        return str_replace( '<a', '<a data-rel="prettyPhoto" ', $html );
    else
        return $html;
}

function corpobox_rel_replace ($content) {
global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox['.$post->ID.']"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
return $content;
}


if ( false === get_theme_mod( 'corpobox_lightbox_img' ) ) {
	add_filter( 'wp_get_attachment_link', 'corpobox_prettyPhoto', 10, 6 );
	add_filter('the_content', 'corpobox_rel_replace', 12);
}

/**
 * Add body class
*/
function corpobox_body_class_filter( $classes ) {

    if ( ! is_page() && ! is_single() && ! is_search() )
        $classes[] = sanitize_html_class( 'colgrid' );

    return $classes;
}
add_filter( 'body_class', 'corpobox_body_class_filter' );

/**
 * Add post class
*/
function corpobox_post_class_filter( $classes ) {

    if ( ! is_page() && ! is_single() && ! is_search() )
        $classes[] = sanitize_html_class( 'col' );

    return $classes;
}
add_filter( 'post_class', 'corpobox_post_class_filter' );

/**
 * Shorten excerpt length
 */
function corpobox_excerpt_length($length) {
	if ( is_sticky() && is_front_page() && !is_home() ) {
		$length = 90;
	} elseif ( is_sticky() && is_home() || is_sticky() && !is_home() && !is_front_page() ) {
		$length = 48;
	} elseif ( is_home() ) {
		$length = 35;
	} elseif ( is_page() ) {
		$length = 15;
	} else {
		$length = 30;
	}
	return $length;
}
add_filter('excerpt_length', 'corpobox_excerpt_length', 999);

/**
 * Replace [...] in excerpts with something new
 */
function corpobox_excerpt_more($more) {
	return '&hellip;';
}
add_filter('excerpt_more', 'corpobox_excerpt_more');

/**
 * Custom excerpt
 */
require_once( get_template_directory() .'/inc/excerpts.php' );

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom gallery layout
 */
require( get_template_directory() . '/inc/gallery-layout.php');

/**
 * Icons Set
 */
require_once( get_template_directory() .'/inc/awesome-icons.php' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Contextual Help Function File
 */
require( get_template_directory() . '/inc/contextual-help.php' );

/**
 * Wellcom Screen
 */
require_once( get_template_directory() . '/inc/welcome.php' );

/**
 * Theme hooks
 */
// see template-tags.php
add_action( 'display_submenu_sidebar', 'corpobox_get_submenu' );
add_action( 'before_content', 'corpobox_before_content' );
add_action( 'before_loop_posts', 'corpobox_before_loop_posts' );
add_action( 'after_main_posts', 'corpobox_after_main_posts' );
add_action( 'corpobox_credits', 'corpobox_txt_credits' );

/**
 * Theme Widgets
 */
require_once ( get_template_directory() . '/inc/widgets/widget-icontext.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * =Ready WooCommerce Plugin
 */
if ( is_woocommerce_activated() ) {

	function corpobox_woocommerce_css() {
		wp_enqueue_style( 'woocommerce-custom-style', get_template_directory_uri() . '/css/woocommerce.css' );
	}
add_action( 'wp_enqueue_scripts', 'corpobox_woocommerce_css' );

	function corpobox_woocommerce_widgets_init() {
		register_sidebar(array(
		'name' => __('Store Sidebar', 'corpobox'),
		'description' => __('Located in the sidebar woocommerce page.', 'corpobox'),
		'id' => 'store',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
		));
	}
add_action( 'widgets_init', 'corpobox_woocommerce_widgets_init' );

}

/**
 * WooProject Hooks&Custom
 */
if( class_exists( 'Projects' ) ) {

	// projects_before_single_project_summary hook
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_feature', 30 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );

	// projects_single_project_summary hook
	remove_action( 'projects_single_project_summary', 'projects_template_single_meta', 20 );
	remove_action( 'projects_single_project_summary', 'projects_template_single_description', 10 );

	add_action( 'projects_single_project_summary', 'projects_template_single_gallery', 10 );
	add_action( 'projects_single_project_summary', 'projects_template_single_description', 20 );
	add_action( 'projects_single_project_summary', 'projects_template_single_meta', 30 );

	// projects_after_loop_item hook
	remove_action( 'projects_after_loop_item', 'projects_template_short_description', 10 );

	// projects after single content hook
	//remove_action( 'projects_after_single_project', 'projects_output_testimonial', 1 );
	remove_action( 'projects_after_single_project', 'projects_single_pagination', 5 );

    	// remove_shortcode( 'projects' );
	add_filter( 'projects_enqueue_styles', '__return_false' );

	// functions see below
	add_action( 'projects_after_loop_item', 'corpobox_projects_cat', 10 );
	add_filter( 'projects_custom_fields', 'corpobox_projects_fields' );
	add_action( 'widgets_init', 'corpobox_wooproject_sidebar' );

} // class_exists( 'Projects' )

function corpobox_projects_fields( $fields ) {
	$fields['date'] = array(
	    'name' 			=> __( 'Date', 'corpobox' ),
	    'description' 	=> __( 'Enter a date for this project. (Optional)', 'corpobox' ),
	    'type' 			=> 'text',
	    'default' 		=> '',
	    'section' 		=> 'info'
	);

	return $fields;
}
function corpobox_projects_cat() {
	global $post;
	$terms_as_text = get_the_term_list( $post->ID, 'project-category', '', ', ', '' );
			echo '<h5 class="shortcode-project-cat">';
			echo $terms_as_text;
			echo '</h5>';

}
function corpobox_wooproject_sidebar() {
	register_sidebar(array(
	'name' => __('Project', 'corpobox' ),
	'description' => __('Located into Project sidebar', 'corpobox' ),
	'id' => 'project',
	'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	));
}