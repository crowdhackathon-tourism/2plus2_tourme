<?php
/**
 * Customizer
 * @package Corpobox
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Corpobox_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
		public function render_content() {
		?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" class="custom-textarea" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
		}
	}
}

function corpobox_register_theme_customizer( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $wp_customize->add_setting(
        'corpobox_headerbg_color',
        array(
            'default'     => '#f16272',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_link_color',
        array(
            'default'     => '#00a5e7',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_hover_color',
        array(
            'default'     => '#f16272',
	'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_setting(
        'corpobox_menu_color',
        array(
            'default'     => '#2c2c2c',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_menu_current',
        array(
            'default'     => '#e8e8e8',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_addit_color',
        array(
            'default'     => '#333333',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_footer_color',
        array(
            'default'     => '#cccccc',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'corpobox_footerbg_color',
        array(
            'default'     => '#2c2c2c',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );

 //CONTROL

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'headerbg_color',
            array(
                'label'      => __( 'Header BG Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 10,
                'settings'   => 'corpobox_headerbg_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color',
            array(
                'label'      => __( 'Link Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 11,
                'settings'   => 'corpobox_link_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'hover_color',
            array(
                'label'      => __( 'Hover Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 20,
                'settings'   => 'corpobox_hover_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_color',
            array(
                'label'      => __( 'Menu Bar Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 30,
                'settings'   => 'corpobox_menu_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_current',
            array(
                'label'      => __( 'Menu Bar Current', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 40,
                'settings'   => 'corpobox_menu_current'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'addit_color',
            array(
                'label'      => __( 'Additional Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 50,
                'settings'   => 'corpobox_addit_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            array(
                'label'      => __( 'Footer TXT Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 200,
                'settings'   => 'corpobox_footer_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footerbg_color',
            array(
                'label'      => __( 'Footer BG Color', 'corpobox' ),
                'section'    => 'colors',
	'priority'  => 201,
                'settings'   => 'corpobox_footerbg_color'
            )
        )
    );

	/*-----------------------------------------------------------
	 * Logo section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'corpobox_logo_options',
		array(
			'title'     => __( 'Logo Options', 'corpobox' ),
			'priority'  => 20
		)
	);
	$wp_customize->add_setting( 
		'corpobox_frame_logo',
		array(
			'sanitize_callback' => 'corpobox_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'corpobox_frame_logo',
		array(
			'section'   => 'corpobox_logo_options',
			'label'     => __( 'No Frame logo', 'corpobox' ),
			'type'      => 'checkbox'
		)
	);
	/* Logo Image Upload */
	$wp_customize->add_setting(
		'logo_upload',
		array(
		'sanitize_callback' => 'esc_url_raw'
		)
	);
	/* Logo Control */
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
		'label' => __( 'Logo Image', 'corpobox' ),
		'section' =>  'corpobox_logo_options',
		'settings' => 'logo_upload'
	) ) );

	/*-----------------------------------------------------------
	 * Home Tagline section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'corpobox_home_tagline',
		array(
			'title'     => __( 'Home Tagline', 'corpobox' ),
			'priority'  => 70
		)
	);
		$wp_customize->add_setting(
			'home_tagline',
			array(
			'default' => '<h1>corpobox</h1>',
			'sanitize_callback' => 'corpobox_sanitize_textarea',
			'transport'   => 'postMessage'
			)
		);
    $wp_customize->add_setting(
        'home_tagline_bgcolor',
        array(
            'default'     => '#f16272',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
	$wp_customize->add_setting(
		'home_tagline_bgimg',
		array(
		'default'     => get_template_directory_uri().'/img/tagline.jpg',
		'sanitize_callback' => 'esc_url_raw'
		)
	);

//Home TagLine CONTROL
		$wp_customize->add_control( new corpobox_Textarea_Control( $wp_customize, 'home_tagline', array(
			'label' => __( 'Tagline Text', 'corpobox' ),
			'section' => 'corpobox_home_tagline',
			'settings' => 'home_tagline',
			//'priority' => 27,
			'type' => 'text',
		) ) );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'home_tagline_bgcolor',
            array(
                'label'      => __( 'Background Color', 'corpobox' ),
                'section'    => 'corpobox_home_tagline',
                'settings'   => 'home_tagline_bgcolor'
            )
        )
    );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'home_tagline_bgimg', array(
		'label' => __( 'Background Image', 'corpobox' ),
		'section' =>  'corpobox_home_tagline',
		'settings' => 'home_tagline_bgimg'
	) ) );

	/*-----------------------------------------------------------
	 * Call to Action section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'corpobox_call_action',
		array(
			'title'     => __( 'Call to Action', 'corpobox' ),
			'priority'  => 400
		)
	);
	$wp_customize->add_setting(
		'callaction_txt',
		array(
			'default'            => 'Here the call to action!',
			'sanitize_callback'  => 'corpobox_sanitize_txt',
			'transport'          => 'postMessage'
		)
	);
	$wp_customize->add_setting(
		'callaction_but_txt',
		array(
			'default'            => 'Button Text',
			'sanitize_callback'  => 'corpobox_sanitize_txt',
			'transport'          => 'postMessage'
		)
	);
	$wp_customize->add_setting(
		'callaction_url',
		array(
		'default'            => '#',
		'sanitize_callback' => 'esc_url_raw'
		)
	);
//Call to Action CONTROL
	$wp_customize->add_control(
		'callaction_txt',
		array(
			'section'  => 'corpobox_call_action',
			'label'    => __( 'Call Action Text', 'corpobox' ),
			'type'     => 'text'
		)
	);
	$wp_customize->add_control(
		'callaction_but_txt',
		array(
			'section'  => 'corpobox_call_action',
			'label'    => __( 'Button Text', 'corpobox' ),
			'type'     => 'text'
		)
	);
	$wp_customize->add_control(
		'callaction_url',
		array(
			'section'  => 'corpobox_call_action',
			'label'    => __( 'URL Button', 'corpobox' ),
			'type'     => 'text'
		)
	);
	/*-----------------------------------------------------------
	 * Copyright section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'corpobox_custom_copyright',
		array(
			'title'     => __( 'Footer Copyright', 'corpobox' ),
			'priority'  => 600
		)
	);
	$wp_customize->add_setting(
		'copyright_txt',
		array(
			'default'            => 'All rights reserved',
			'sanitize_callback'  => 'corpobox_sanitize_txt',
			'transport'          => 'postMessage'
		)
	);
//Copyright CONTROL
	$wp_customize->add_control(
		'copyright_txt',
		array(
			'section'  => 'corpobox_custom_copyright',
			'label'    => __( 'Copyright', 'corpobox' ),
			'type'     => 'text'
		)
	);
	/*-----------------------------------------------------------*
	 * Display Options section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'corpobox_display_options',
		array(
			'title'     => __( 'Display Options', 'corpobox' ),
			'priority'  => 700
		)
	);
	$wp_customize->add_setting( 
		'corpobox_submenu_pages',
		array(
			'sanitize_callback' => 'corpobox_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'corpobox_submenu_pages',
		array(
			'section'   => 'corpobox_display_options',
			'label'     => __( 'Hide Submenu pages', 'corpobox' ),
			'type'      => 'checkbox'
		)
	);
	$wp_customize->add_setting( 
		'corpobox_lightbox_img',
		array(
			'sanitize_callback' => 'corpobox_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'corpobox_lightbox_img',
		array(
			'section'   => 'corpobox_display_options',
			'label'     => __( 'Disable lightbox image', 'corpobox' ),
			'type'      => 'checkbox'
		)
	);

}
add_action( 'customize_register', 'corpobox_register_theme_customizer' );

	/*-----------------------------------------------------------*
	 * Sanitize
	 *-----------------------------------------------------------*/
function corpobox_sanitize_textarea( $input ) {
	return wp_kses_post(force_balance_tags($input));
}
function corpobox_sanitize_txt( $input ) {
	return strip_tags( stripslashes( $input ) );
}
function corpobox_sanitize_checkbox( $value ) {
        if ( 'on' != $value )
            $value = false;

        return $value;
}

	/*-----------------------------------------------------------*
	 * Styles print
	 *-----------------------------------------------------------*/
function corpobox_customizer_css() {
    ?>
    <style type="text/css">
button,
html input[type="button"],
input[type="reset"],
input[type="submit"] { background: <?php echo esc_attr( get_theme_mod( 'corpobox_link_color', '#00a5e7' ) ); ?>; }
button:hover,
html input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover { background: <?php echo esc_attr( get_theme_mod( 'corpobox_hover_color', '#f16272' ) ); ?>; }
        .site-content a, #home-tagline h1, cite { color: <?php echo esc_attr( get_theme_mod( 'corpobox_link_color', '#00a5e7' ) ); ?>; }
        #content a:hover, .site-content a:hover, .site-footer a:hover { color: <?php echo esc_attr( get_theme_mod( 'corpobox_hover_color', '#f16272' ) ); ?>; }
        .main-navigation { background: <?php echo esc_attr( get_theme_mod( 'corpobox_menu_color', '#2c2c2c' ) ); ?>; }
h1.page-title, .call-action-txt span { color: <?php echo esc_attr( get_theme_mod( 'corpobox_menu_color', '#2c2c2c' ) ); ?>; }
cite { border-top-color: <?php echo esc_attr( get_theme_mod( 'corpobox_addit_color', '#333333' ) ); ?>; }
#home-widget .widget-title, h3.widget-title, h3#reply-title{ color: <?php echo esc_attr( get_theme_mod( 'corpobox_addit_color', '#333333' ) ); ?>; }
#home-txt, .entry-header p { color: <?php echo esc_attr( get_theme_mod( 'corpobox_addit_color', '#333333' ) ); ?>; }
.site-footer, .site-footer a { color: <?php echo esc_attr( get_theme_mod( 'corpobox_footer_color', '#cccccc' ) ); ?>; }
.site-footer { background: <?php echo esc_attr( get_theme_mod( 'corpobox_footerbg_color', '#2c2c2c' ) ); ?>; }
	.nav-menu li:hover,
	.nav-menu li.sfHover,
	.nav-menuu a:focus,
	.nav-menu a:hover, 
	.nav-menu a:active,
.main-navigation li ul li a:hover  { background: <?php echo esc_attr( get_theme_mod( 'corpobox_hover_color', '#f16272' ) ); ?>; }
	.nav-menu .current_page_item a,
	.nav-menu .current-post-ancestor a,
	.nav-menu .current-menu-item a { background: <?php echo esc_attr( get_theme_mod( 'corpobox_menu_current', '#e8e8e8' ) ); ?>; }
		<?php if( true === get_theme_mod( 'corpobox_frame_logo' ) ) { ?>
		<?php } // end if ?>
		<?php if( true === get_theme_mod( 'corpobox_submenu_pages' ) ) { ?>
		<?php } // end if ?>
    </style>
    <?php
}
add_action( 'wp_head', 'corpobox_customizer_css' );

	/*-----------------------------------------------------------*
	 * Live Preview Script
	 *-----------------------------------------------------------*/
function corpobox_customizer_live_preview() {
    wp_enqueue_script(
        'corpobox-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array( 'jquery', 'customize-preview' ),
        '22062015',
        true
    );
}
add_action( 'customize_preview_init', 'corpobox_customizer_live_preview' );