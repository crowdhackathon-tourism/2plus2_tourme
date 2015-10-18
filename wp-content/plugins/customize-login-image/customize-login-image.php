<?php
/*
 Plugin Name: Customize Login Image
 Plugin URI: http://apasionados.es/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=wpcustomizeloginimageplugin 
 Description: This plugin allows you to customize the image and the appearance of the WordPress Login Screen.
 Version: 2.0
 Author: Apasionados, Apasionados del Marketing, Nunsys
 Author URI: http://apasionados.es

 Release notes: 2.0 release.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function cli_logo_title() {
	if ( get_option( 'cli_logo_url' ) != '' ) {
		return sprintf ( __( 'Go to %1$s' ), get_option ( 'cli_logo_url' ) );
	}
}
function cli_logo_url($url) {
	if ( get_option( 'cli_logo_url' ) != '' ) {
		return get_option( 'cli_logo_url' );
	} else {
		return get_bloginfo( 'url' );
	}
}
function cli_logo_file() {
	$bgimage= get_option( 'cli_logo_file' );
	if (! $bgimage ) {
		$upload_dir = wp_upload_dir();
		$customize_login_image = $upload_dir['basedir'] . '/customize-login-image.png';
		if (@file_exists($customize_login_image) && is_readable($customize_login_image)) {
			$bgimage= $upload_dir['baseurl'] . '/customize-login-image.png';
		}
	}
	if ( $bgimage ) {
		echo '<style>#login h1 a { background-image: url("' . $bgimage . '"); background-size: auto; width: auto; margin: 0; }</style>' . "\n";
	}
}
function cli_login_background_color() {
	if ( get_option( 'cli_login_background_color' ) != '' ) {
		echo '<style>body { background-color: ' . get_option( 'cli_login_background_color' ) . '!important; } </style>';
	}
}
function cli_custom_css() {
	if ( get_option( 'cli_custom_css' ) != '' ) {
		echo '<style>'. get_option( 'cli_custom_css' ) . '</style>';
	}
}

function cli_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/customize-login-image.php' ) ) {
		$links[] = '<a href="' . admin_url( 'options-general.php?page=customize-login-image/customize-login-image-options.php' ) . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

add_filter( 'login_headertitle', 'cli_logo_title' );
add_filter( 'login_headerurl', 'cli_logo_url' );
add_action( 'login_head', 'cli_logo_file' );
add_action( 'login_head', 'cli_login_background_color' );
add_action( 'login_head', 'cli_custom_css' );
add_filter( 'plugin_action_links', 'cli_plugin_action_links', 10, 2);

require_once( 'customize-login-image-options.php' );
?>