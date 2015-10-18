<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Corpobox
 */

if ( ! function_exists( 'corpobox_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function corpobox_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'corpobox' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-arrow-left"></i>', 'Previous post link', 'corpobox' ) . '</span><br /> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-arrow-right"></i>', 'Next post link', 'corpobox' ) . '</span><br /> %title' ); ?>

<?php elseif ( $wp_query->max_num_pages > 1 && ( is_search() ) ) : // navigation links for search pages or is_home() || is_archive() ||  etc ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'corpobox' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'corpobox' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // corpobox_content_nav

if ( ! function_exists( 'corpobox_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function corpobox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'corpobox' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'corpobox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<time datetime="<?php comment_time( 'c' ); ?>">
	<?php printf( _x( '%1$s &middot; %2$s', '1: date, 2: time', 'corpobox' ), get_comment_date(), get_comment_time() ); ?>
					</time>
	<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">#<?php echo $comment->comment_ID; ?></a>
					<?php edit_comment_link( __( 'Edit', 'corpobox' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'corpobox' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for corpobox_comment()

if ( ! function_exists( 'corpobox_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function corpobox_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'corpobox_attachment_size', array( 1080, 9999 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'corpobox_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function corpobox_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span><span class="byline"> <i>by</i> %2$s</span>', 'corpobox' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

if ( ! function_exists( 'corpobox_posted_extra' ) ) :
/**
 * Prints HTML with meta info cat/tag
 */
function corpobox_posted_extra() {

	$categories_list = get_the_category_list( __( ', ', 'corpobox' ) );
	$tags_list = get_the_tag_list( '', __( ', ', 'corpobox' ) );

	if ( $categories_list && corpobox_categorized_blog() ) {

	echo '<span class="cat-links">' . __( 'Category: ', 'corpobox' ), $categories_list . '.</span>';

	}
	if ( $tags_list ) {

	echo '<span class="tags-links">' . __( 'Tag: ', 'corpobox' ), $tags_list . '</span>';

	}
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function corpobox_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so corpobox_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so corpobox_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in corpobox_categorized_blog
 */
function corpobox_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'corpobox_category_transient_flusher' );
add_action( 'save_post',     'corpobox_category_transient_flusher' );

/**
 * The page submenu into sidebar
 * @author Oleg Murashov
 */
if ( ! function_exists( 'corpobox_get_submenu' ) ) {
  function corpobox_get_submenu($args) {
    $defaults = array(
    	'container_id' => '',
    	'container' => 'div',
    	'container_class' => 'submenu',
    	'submenu_id' => 'sidemenu',
    	'submenu_class' => '',
    	'theme_location' => 'primary',
    	'xpath' => "./li[contains(@class,'current-menu-item') or contains(@class,'current-menu-ancestor')]/ul",
    	'echo' => true
    );

    $args = wp_parse_args( $args, $defaults );
    $args = (object) $args;
 
    $menu = wp_nav_menu(
        array(
            'theme_location' => $args->theme_location,
            'container' => '',
            'echo' => false
        )
    );

    $menu = simplexml_load_string($menu);
    $submenu = $menu->xpath($args->xpath);

    if (empty($submenu)) {
        return;
    }

    // Set value of class attribute
    $submenu[0]['class'] = $args->submenu_class;

    // Add "id" attribute
    if ($args->submenu_id) {
        $submenu[0]->addAttribute('id', $args->submenu_id);
    }

    if ($args->container) {
        $submenu_sxe = simplexml_load_string($submenu[0]->saveXML());
        $sdm = dom_import_simplexml($submenu_sxe);

        if ($sdm) {
            $xmlDoc = new DOMDocument('1.0', 'utf-8');
            $container = $xmlDoc->createElement($args->container);

            // Add "class" attribute for container
            if ($args->container_class) {
                $container->setAttribute('class', $args->container_class);
            }

            // Add "id" attribute for container
            if ($args->container_id) {
                $container->setAttribute('id', $args->container_id);
            }
    
            $smsx = $xmlDoc->importNode($sdm, true);
            $container->appendChild($smsx);
            $xmlDoc->appendChild($container);
        }
    }

    if (isset($xmlDoc)) {
        $output = $xmlDoc->saveXML();
    } else {
        $output = $submenu[0]->saveXML();
    }

    if (!$args->echo) {
        return $output;
    }

    echo $output;
  }
}

/**
 * Footer credits.
 */
function corpobox_txt_credits() {
	$text = sprintf( __( 'Powered by %s', 'corpobox' ), '<a href="http://wordpress.org/">WordPress</a>' );
	$text .= '<span class="sep"> &middot; </span>';
	$text .= sprintf( __( 'Theme by %s', 'corpobox' ), '<a href="http://www.dinevthemes.com/">DinevThemes</a>' );
	echo apply_filters( 'corpobox_txt_credits', $text );
}

/**
 * Background some Post Formats
 */
if ( ! function_exists( 'background_post_formats' ) ) {
	function background_post_formats() {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'corpobox-medium' );
		echo 'style="background:' . esc_attr( get_theme_mod( 'corpobox_link_color', '#00a5e7' ) );
			if  ( $thumbnail ) {
		echo ' url(' . $thumbnail[0] . ') no-repeat; background-position: 50%; background-size: cover';
			}
		echo ';"';
	}
}

/**
 * Theme Hooks
 */
if ( ! function_exists( 'corpobox_before_content' ) ) {
	function corpobox_before_content() {
		if ( has_post_thumbnail() || has_excerpt() ) {
?>
<header class="entry-header">

	<?php if ( has_post_thumbnail() && !has_post_format() ) : ?>
		<?php the_post_thumbnail( 'corpobox-medium' ); ?>
	<?php endif; //has_post_thumbnail ?>

	<?php if ( has_excerpt() ) : ?>
		<?php the_excerpt(); ?>
	<?php endif; //has_excerpt() ?>	

</header>
<!-- .entry-header -->
<?php
		}
	}
}

if ( ! function_exists( 'corpobox_before_loop_posts' ) ) {
	function corpobox_before_loop_posts() {

if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	<div class="grid2 clearfix">
<?php
}
if ( ! is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div id="primary" class="content-area" style="float: none; width: 100%;">
		<main id="main" class="site-main" role="main">
	<div class="grid3 clearfix">
<?php
}

	}
}

if ( ! function_exists( 'corpobox_after_main_posts' ) ) {
	function corpobox_after_main_posts() {

		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			// silence is gold
		} else {
			corpobox_paging_nav();
		}

	}
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * WooCommerce Cart Link
 */
if ( ! function_exists( 'corpobox_cart_link' ) ) {
	function corpobox_cart_link() {
		if ( is_cart() ) {
			$class = 'menu-item';
		} else {
			$class = '';
		}
		?>
		<li class="<?php echo esc_attr( $class ); ?>">
			<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View Cart', 'corpobox' ); ?>">
				<?php echo wp_kses_data( WC()->cart->get_cart_total() ); ?>
			</a>
		</li>
		<?php
	}
}

/**
 * WooCommerce Layout hooks
 */
if ( is_woocommerce_activated() ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

	add_action( 'woocommerce_after_shop_loop', 'corpobox_paging_nav', 10 );
}

/**
 * WooCommerce Page Title
 */
if ( ! function_exists( 'corpobox_remove_wc_page_title' ) ) {
function corpobox_remove_wc_page_title() {
	remove_filter( 'woocommerce_page_title', 19 );
}
add_action( 'woocommerce_show_page_title', 'corpobox_remove_wc_page_title');
}

/**
 * WooProject Page Title
 */
if ( ! function_exists( 'corpobox_project_remove_page_title' ) ) {
function corpobox_project_remove_page_title() {
	remove_filter( 'projects_page_title', 19 );
}
add_action( 'projects_show_page_title', 'corpobox_project_remove_page_title');
}
