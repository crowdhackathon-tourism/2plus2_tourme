<?php

add_action( 'admin_init', 'cli_load_language' );
function cli_load_language() {
	load_plugin_textdomain( 'customize-login-image', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

add_action( 'admin_menu', 'cli_create_menu' );
function cli_create_menu() {
	add_submenu_page( 'options-general.php', 'Customize Login Image', 'Customize Login Image', 'manage_options', 'customize-login-image/customize-login-image-options.php', 'cli_settings_page' );
	add_action( 'admin_init', 'cli_register_settings' );
}

function cli_register_settings() {
	register_setting( 'customize-login-image-settings-group', 'cli_logo_file' );
	register_setting( 'customize-login-image-settings-group', 'cli_logo_url' );
	register_setting( 'customize-login-image-settings-group', 'cli_login_background_color' );
	register_setting( 'customize-login-image-settings-group', 'cli_custom_css' );
}

function cli_admin_scripts() {
	wp_register_script( 'my-upload', WP_PLUGIN_URL . '/customize-login-image/customize-login-image.js', array( 'jquery', 'media-upload', 'thickbox' ) );
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'wp-color-picker' );
}

function cli_admin_styles() {
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'wp-color-picker' );
}

if ( isset( $_GET['page'] ) && $_GET['page'] == 'customize-login-image/customize-login-image-options.php' ) {
	add_action( 'admin_print_scripts', 'cli_admin_scripts' );
	add_action( 'admin_print_styles', 'cli_admin_styles' );
}

function cli_settings_page() { ?>
	<div class="wrap">
	<h2><?php _e( 'Customize Login Image Options', 'customize-login-image' ); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'customize-login-image-settings-group' ); ?>
        <p><strong><?php _e( 'This plugin allows you to customize the image and the appearance of the WordPress Login Screen.', 'customize-login-image' ); ?></strong></p>
        <table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Logo Link', 'customize-login-image' ); ?></th>
				<td><label for="cli_logo_url">
					<input type="text" id="cli_logo_url" size="36" name="cli_logo_url" value="<?php echo get_option( 'cli_logo_url' ); ?>" />
					<p class="description"><?php _e( 'If not specified, clicking on the logo will return you to the homepage.', 'customize-login-image' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Logo', 'customize-login-image' ) ?></th>
				<td><label for="upload_image">
					<input id="upload_image" type="text" size="36" name="cli_logo_file" value="<?php echo get_option( 'cli_logo_file' ); ?>" />
					<input id="upload_image_button" type="button" value="<?php _e( 'Upload Image', 'customize-login-image' ); ?>" />
					<p class="description"><?php _e( 'Enter a URL or upload logo image. Use an image 320px wide if you want to match the default WordPress login box.', 'customize-login-image' ); ?></p>
                    <p class="description"><?php _e( 'If you do not enter a URL or upload a logo, the default WordPress image will be used.', 'customize-login-image' ); ?></p>
                    <p class="description"><?php _e( 'You can also place a logo in PNG format called <strong>customize-login-image.png</strong> in your <strong>WordPress Uploads folder</strong>, which will be used if no URL or logo has been uploaded and the image could be found.', 'customize-login-image' ); ?><br /><?php _e( 'Your WordPress Upload folder is:', 'customize-login-image' ); $upload_dir = wp_upload_dir(); echo ( ' <strong>' . $upload_dir['baseurl'] . '</strong>.<br />' ); _e( 'Click on the file name to test if file can be found by the plugin: ', 'customize-login-image' ); echo (' <a href="'. $upload_dir['baseurl'] . '/customize-login-image.png" target="_blank" rel="nofollow">customize-login-image.png</a> (<a href="'. $upload_dir['baseurl'] . '/customize-login-image.png" target="_blank" rel="nofollow">' . $upload_dir['baseurl'] . '/customize-login-image.png</a>)'); ?><br /><?php _e( '<strong>Please note</strong> that if you have enabled the MEDIA option: Organize my uploads into month- and year-based folders, you must upload the image to the Base-UPLOADS-folder, without year and month (above you can see the exact location where to UPLOAD.', 'customize-login-image' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Login Background', 'customize-login-image' ); ?></th>
				<td><label for="cli_login_background_color">
					<input type="text" id="cli_login_background_color" class="color-picker" name="cli_login_background_color" value="<?php echo get_option( 'cli_login_background_color' ); ?>" />
					<p class="description"><?php _e( '' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom CSS', 'customize-login-image' ); ?></th>
				<td>
					<textarea id="cli_custom_css" name="cli_custom_css" cols="70" rows="5"><?php echo get_option( 'cli_custom_css' ); ?></textarea>
					<p class="description"><?php _e( 'Add your own css to the WordPress dashboard.', 'customize-login-image' ); ?></p>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'customize-login-image' ); ?>" />
		</p>
	</form>
	</div>
<?php }; ?>