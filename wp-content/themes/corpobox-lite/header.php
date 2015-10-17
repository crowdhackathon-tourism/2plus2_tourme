<?php
/**
 * The Header Theme
 * @package Corpobox
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
<?php wp_head(); ?>
</head>

<?php
	$home_image = get_header_image();
	$header_text_color = esc_attr( get_header_textcolor() );
	$logo = get_theme_mod( 'logo_upload' );
?>

<body <?php body_class(); ?>>

<div class="out-wrap" style="background: <?php echo esc_attr( get_theme_mod( 'corpobox_headerbg_color', '#f16272' ) ); ?><?php if( !empty($home_image) ) { ?> url(<?php echo esc_url( $home_image );?>) no-repeat 50%;background-size: cover<?php } ?>;">

<?php if ( has_nav_menu( 'top' ) ) { ?>
	<div class="top-menu">
<?php
wp_nav_menu(
	array(
	'theme_location'  => 'top',
	'menu_id'         => 'menu-top',
	'depth'           => 1,
	'link_before'     => '<span>',
	'link_after'      => '</span>',
	'fallback_cb'     => '',
	)
);
?>
	</div>
<?php } ?>

	<div id="wrap-header" class="wrap hfeed site">
	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header" role="banner">
<div class="site-branding clearfix">

	<div id="logo">
<?php if ( !is_front_page() ) : ?>
<?php if ( !empty($logo) ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="color:<?php echo '#'.$header_text_color; ?>">
		<img src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" <?php if( false === get_theme_mod( 'corpobox_frame_logo' ) ) { ?>class="roundframe"<?php } ?> />
		</a>
<?php endif; //!empty ?>
	<div class="title-group">
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="color:<?php echo '#'.$header_text_color; ?>">
		<?php bloginfo( 'name' ); ?>
		</a></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php else : ?>
<?php if ( !empty($logo) ) : ?>
	<img src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" <?php if( false === get_theme_mod( 'corpobox_frame_logo' ) ) { ?>class="roundframe"<?php } ?> />
<?php endif; //!empty ?>
	<div class="title-group">
		<h1 class="site-title" style="color:<?php echo '#'.$header_text_color; ?>"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php endif; //!is_front_page() ?>
	</div><!--#logo-->

</div><!--site-branding-->

<nav id="site-navigation" class="main-navigation" role="navigation">
	<h1 class="menu-toggle"><?php _e( 'Menu', 'corpobox' ); ?></h1>
<?php 
	if ( has_nav_menu('primary') ) {
		wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class' => 'nav-menu', 
				'container'       => 'div',
				'container_class' => 'menu-main'
				) );
	}
?>
</nav><!-- #site-navigation -->

	</header><!-- #masthead -->
	</div><!-- #wrap-header -->
</div><!-- .out-wrap -->

<?php
if ( !is_front_page() ) {
	get_template_part( 'template-parts/header' );
} ?>

<div id="wrap-content" class="wrap">
	<div id="content" class="site-content">