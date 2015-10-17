<?php
/**
 * Custom Widget Image-Icon
 * @package Corpobox
 * @require awesome-icons.php see functions.php
 */
add_action('widgets_init', create_function('', 'register_widget("Corpobox_Icon_Widget");'));

class Corpobox_Icon_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'corpobox_icon_widget',
			'Corpobox - ' . __( 'Icons', 'corpobox' ),
			array(
				'classname' => 'corpobox_icon_widget', 
				'description' => __( 'Custom Text Widget with Icons', 'corpobox' ),
				'width' => 250,
				'height' => 350
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	function admin_enqueue_scripts( $hook ) {
	    if ( 'widgets.php' == $hook ) {
    		wp_enqueue_media();
    		wp_enqueue_script( 'icon_widget_js', get_template_directory_uri() . '/js/icon-widget.js', array( 'jquery' ), '', true );

    		wp_enqueue_style( 'icon_widget_css', get_template_directory_uri() . '/css/icon-widget.css' );
    		wp_enqueue_style( 'font-awesome_css', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
        }
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$icon =  ( empty( $instance['icon'] ) ) ? '' : '<i class="' . esc_attr( $instance['button_color'] ) . ' fa ' . strip_tags( $instance['icon'] ). '"></i>';
		$url = ( empty( $instance['url'] ) ) ? '' : esc_url( $instance['url'] );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$button_text = ( empty( $instance['button_text'] ) ) ? '' : $instance['button_text'];

		$icon_string = ( $url ) ? '<a href="' . $url . '">'. $icon . '</a>' : $icon;
		$title_string = $title;

		echo $before_widget;
		echo '<div class="icon-widget">';

		if ( $icon )
			echo $icon_string;

		if ( $title )
			echo $before_title . $title_string . $after_title;
		?>
			<?php echo ( ! empty( $instance['filter'] ) ) ? wpautop( $text ) : $text; ?>
		<?php
		if ( $url && $button_text )
			echo '<a href="' . $url . '" class="btn ' . esc_attr( $instance['button_color'] ) . '">' . $button_text . '</a>';

		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['url'] = esc_url( $new_instance['url'] );
		$instance['button_color'] = esc_attr( $new_instance['button_color'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] =  $new_instance['text'];
			$instance['button_text'] =  $new_instance['button_text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) ); // wp_filter_post_kses() expects slashed
			$instance['button_text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['button_text'] ) ) );
		}

		$instance['filter'] = isset( $new_instance['filter'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'icon' => '', 'url' => '', 'button_text' => '', 'button_color' => 'info' ) );
		extract( $instance );
		$icon_tag = ( $icon ) ? '<i class="fa ' . esc_attr( $icon ) . '"></i>' : '';
		?>

		<p>This widget to display icons which will show your service or features.</p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'corpobox' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label><?php _e( 'Icon:', 'corpobox' ); ?></label>
		<span class="custom-icon-container"><?php echo $icon_tag; ?></span>
		<a href="#" class="view-icons"><?php _e( 'View Icons', 'corpobox' ); ?></a> | <a href="#" class="delete-icon"><?php _e( 'Remove', 'corpobox' ); ?></a>
		<?php corpobox_font_awesome_icons(); ?>
		<input class="image-widget-custom-icon" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="hidden" value="<?php echo esc_attr( $icon ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'corpobox' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'corpobox' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'button_color' ); ?>"><?php _e( 'Icon and Button Color:', 'corpobox' ); ?></label>
		<select name="<?php echo $this->get_field_name( 'button_color' ); ?>" id="<?php echo $this->get_field_id( 'button_color' ); ?>" class="widefat">
		<?php
		$options = array(
			'default' => __( 'Default', 'corpobox' ),
			'blue' => __( 'Blue', 'corpobox' ),
			'red' => __( 'Red', 'corpobox' ),
			'green' => __( 'Green', 'corpobox' ),
		);
		foreach ( $options as $value => $key ) {
			echo '<option value="' . $value . '" ' . selected( $button_color, $value, false ) . '>' . $key . '</option>';
		}
		?>
		</select></p>

		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked( isset( $filter ) ? $filter : 0 ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'corpobox' ); ?></label></p>
		<?php
	}
}