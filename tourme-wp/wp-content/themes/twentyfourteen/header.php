<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	
<?php
//I know obviously I am breaking all the rules with this stuff but we need to show a minimal visible product
//Should be reimplemented using php shortcode, and these modifications all as a plugin on top of buddypress
//echo $_SERVER['REQUEST_URI'];
$mainSearch = 'tourme/home_main/';
$add = $_SERVER['REQUEST_URI'];
$onMain = strrpos($add, $mainSearch) || $_SERVER['REQUEST_URI']=="/tourme/";

if($onMain){
	if ( function_exists( 'bp_loggedin_user_id' ) && bp_loggedin_user_id() ){
		$address = bp_loggedin_user_domain() . 'profile/edit/';
		$address = "\"$address\"";
		echo "<script>document.location.href=$address;</script>";		
	}
}
?>
	
	
</head>

<body <?php body_class(); ?>>

<script>
var tme_user_id = <?php echo get_current_user_id() ?>;
</script>

<script src="/tourme/js/tourme.js">
</script>


<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<div id="page" class="hfeed site">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<h1 class="site-title">
			
			<!--<img src="/tourme/logo.jpg" align="left"/><a href="<!--?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><!--?php bloginfo( 'name' ); ?></a>-->
			
			
			</h1>

			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text" aria-expanded="false" aria-controls="search-container"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
			</div>

			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php 
				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); 
				?>						
			</nav>
		</div>

		
		
		
		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	
	
	<?php wp_register(' ' , ' '); ?> | <?php wp_loginout();?> 
	

	<?php if ( !is_user_logged_in() ) {
		echo "<script>if(document.location.href.indexOf('registration')==-1)document.location.href=\"http://tourme.gr/tourme/wp-login.php?redirect_to=http%3A%2F%2Ftourme.gr%2Ftourme\";</script>";	
			//Not Secure Needs to be re-written correctly in plugin
	}
	?>


		
	

	
	
	
	<div id="main" class="site-main">
