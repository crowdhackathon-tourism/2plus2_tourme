<?php
/**
 * Admin screen theme Welcome
 * @package Corpobox
 */

class Corpobox_Welcome {

	public $minimum_capability = 'manage_options';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		//add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'load-themes.php', array( $this, 'corpobox_activation_admin_notice' ) );
	}

	/**
	 * Adds admin notice
	 */
	public function corpobox_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'corpobox_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display admin notice
	 */
	public function corpobox_welcome_admin_notice() {
		?>
			<div class="updated notice">
			<p><strong><?php echo esc_html__( 'Thanks for choosing Corpobox!', 'corpobox' ); ?></strong></p>
			<p><?php echo esc_html__( 'This theme has built-in Contextual Help for most admin screens.', 'corpobox' ); ?>&nbsp;<?php echo esc_html__( 'To get Help right now, click on the tab Help on the top admin bar.', 'corpobox' ); ?><br /><?php echo sprintf( esc_html__( 'Get a brief setup instructions on the %swelcome screen%s.', 'corpobox' ), '<a href="' . esc_url( admin_url( 'themes.php?page=corpobox-about' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=corpobox-about' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Welcome!', 'corpobox' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Register the Theme Pages which are later hidden but these pages
	 * are used to render the Welcome and subpages.
	 */
	public function admin_menus() {
		add_theme_page(
			__( 'Corpobox Theme', 'corpobox' ),
			__( 'Corpobox Theme', 'corpobox' ),
			$this->minimum_capability,
			'corpobox-about',
			array( $this, 'about_screen' )

		);
	}

	/**
	 * Render About Screen
	 */
	public function about_screen() {
			// Get theme version
			$theme_data = wp_get_theme();
			$theme_version = $theme_data->get( 'Version' );
			$theme_name = $theme_data->get( 'Name' ); ?>

		<div class="wrap">
			<h2><?php echo $theme_name; ?> <?php _e( 'Theme', 'corpobox' ); ?> v<?php echo $theme_version; ?></h2>
			<p class="about-description"><?php _e( 'Thank you for choosing Corpobox WordPress theme for your website!', 'corpobox' ); ?></p>

		    <div class="welcome-panel">
		        <div class="welcome-panel-content">

			<h3><?php _e( 'Welcome to', 'corpobox' ); ?> <?php echo $theme_name; ?>!</h3>

			<div class="about-description">
				<?php _e( 'Here are some links to get you started and optional theme-setup tasks:', 'corpobox' ); ?>
			</div>

				<div class="welcome-panel-column-container">

					<div class="welcome-panel-column">
						
						<h4><?php _e( 'Get Started', 'corpobox' ); ?></h4>

				<?php if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) : ?>
						<p><?php echo sprintf( esc_html__( 'Corpobox includes a homepage templates. Assign the homepage templates to your %sfront page%s.', 'corpobox' ), '<a href="' . esc_url( get_edit_post_link( get_option( 'page_on_front' ) ) ) . '">', '</a>' ); ?></p>
				<?php endif; ?>

				<?php if ( 'posts' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) : ?>
						<p><?php _e( 'Set your Front page, go to', 'corpobox' ); ?> <a href="<?php echo admin_url( 'options-reading.php' ); ?>"><?php _e( 'Front page displays', 'corpobox' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
						<p><?php _e( 'Set you Posts page, go to', 'corpobox' ); ?> <a href="<?php echo admin_url( 'options-reading.php' ); ?>"><?php _e( 'Front page displays', 'corpobox' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) : ?>
						<p><?php _e( 'Set your Front page, go to', 'corpobox' ); ?> <a href="<?php echo admin_url( 'options-reading.php' ); ?>"><?php _e( 'Front page displays', 'corpobox' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'posts' == get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) : ?>
						<p><?php _e( 'To select page as Front page you will need to create a new page, go to ', 'corpobox' ); ?><a href="<?php echo admin_url( 'post-new.php?post_type=page' ); ?>"><?php _e( 'Add New Page', 'corpobox' ); ?></a></p>
				<?php endif; ?>

				<?php if ( !has_nav_menu('primary') ) : ?>
						<p><?php _e( 'Set you ', 'corpobox' ); ?><a href="<?php echo admin_url( 'nav-menus.php' ); ?>"><?php _e( 'main Menu', 'corpobox' ); ?></a></p>
				<?php endif; ?>

						<h4><?php _e( 'Get Corpobox Premium', 'corpobox' ); ?></h4>

<p><strong><?php _e( 'Get more features and support with Premium Theme!', 'corpobox' ); ?></strong></p>

						<p><?php _e( 'For users premium theme our support is available 24/7.', 'corpobox' ); ?></p>
						<p><a href="<?php echo esc_url( 'http://dinevthemes.com/themes/corpobox/' ); ?>" class="button button-primary"><?php _e( 'Get Corpobox Premium', 'corpobox' ); ?></a></p>

					</div>

					<div class="welcome-panel-column">

						<h4><?php _e( 'Next Steps', 'corpobox' ); ?></h4>
						
						<p><?php _e( 'Corpobox includes a custom widgets, go to ', 'corpobox' ); ?><a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( 'Manage widgets', 'corpobox' ); ?></a></p>


					<?php if ( current_user_can( 'customize' ) ): ?>
						<p><?php _e( 'Using the WordPress Customizer you can tweak appearance.', 'corpobox' ); ?></p>
						<p><a href="<?php echo wp_customize_url(); ?>" class="button"><?php esc_html_e( 'Customize', 'corpobox' ); ?></a></p>
					<?php endif; ?>

					</div>

					<div class="welcome-panel-column welcome-panel-last">

						<h4><?php _e( 'Plugins', 'corpobox' ); ?></h4>

<?php if ( !class_exists( 'Projects' ) || !class_exists( 'Woothemes_Features' ) ) { ?>
						<p><?php _e( 'Extend the functionality of the theme using free plugins, go to ', 'corpobox' ); ?> <a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>"><?php _e( 'Install Plugins', 'corpobox' ); ?></a></p>
<?php } ?>
						<p><?php _e( 'Below you will find links to plugins we recommend. None of these plugins are required for theme to work, they add additional functionality.', 'corpobox' ); ?></p>

						<ul style="list-style: none; margin: 20px 0 20px 0;">
							<li><span style="font-weight:bold">JetPack WordPress:</span> <a href="<?php echo esc_url( 'http://jetpack.me/' ); ?>">JetPack</a></li>
							<li><span style="font-weight:bold">Shortcodes:</span> <a href="<?php echo esc_url( 'http://gndev.info/shortcodes-ultimate/' ); ?>">Shortcodes Ultimate</a></li>
							<li><span style="font-weight:bold">Contact Forms:</span> <a href="<?php echo esc_url( 'http://wordpress.org/plugins/contact-form-7/' ); ?>">Contact Form 7</a></li>
							<li><span style="font-weight:bold">WooCommerce:</span> <a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>">WooCommerce</a></li>

							<li><span style="font-weight:bold">Projects or Portfolio:</span> <a href="<?php echo esc_url( 'https://wordpress.org/plugins/projects-by-woothemes/' ); ?>">Projects by WooThemes</a></li>
						</ul>
					</div>

				</div><!-- .welcome-panel-column-container -->

	                        </div><!-- .welcome-panel-content -->
	                    </div>

		</div><!-- .wrap -->

		<?php
	} // about_screen
	
}
new Corpobox_Welcome();