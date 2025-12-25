<?php
/**
 * Widget API: DesiLan_Icon_Link_Widget class
 *
 * @package DesiLan
 */

/**
 * Core class used to implement a DesiLan Icon Link widget.
 *
 * @see WP_Widget
 */
class DesiLan_Icon_Link_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'desilan_icon_link_widget',
			'description' => esc_html__( 'Add an icon or image with a link and text.', 'desilan' ),
		);
		parent::__construct( 'desilan_icon_link_widget', esc_html__( 'DesiLan Icon Link', 'desilan' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Reduce bottom spacing for this widget specifically as requested.
		// Replaces the theme's default 'mb-6' with 'mb-2' for tighter lists.
		$args['before_widget'] = str_replace( 'mb-6', 'mb-2', $args['before_widget'] );

		echo $args['before_widget'];

		$text       = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$link       = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		$icon_type  = ! empty( $instance['icon_type'] ) ? $instance['icon_type'] : 'fontawesome';
		$icon_class = ! empty( $instance['icon_class'] ) ? $instance['icon_class'] : '';
		$image_url  = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';

		// Styles
		$text_color       = ! empty( $instance['text_color'] ) ? $instance['text_color'] : '#9CA3AF';
		$icon_color       = ! empty( $instance['icon_color'] ) ? $instance['icon_color'] : '#9CA3AF';
		$text_hover_color = ! empty( $instance['text_hover_color'] ) ? $instance['text_hover_color'] : '#b45f36';
		$icon_hover_color = ! empty( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '#b45f36';
		$font_size        = ! empty( $instance['font_size'] ) ? $instance['font_size'] : '';
		$font_family      = ! empty( $instance['font_family'] ) ? $instance['font_family'] : '';

		$wrapper_style = '';
		$text_style    = '';
		$icon_style    = '';
		$unique_id     = 'desilan-icon-' . $args['widget_id']; // Unique ID for scoped styles

		if ( ! empty( $font_size ) ) {
			$wrapper_style .= 'font-size:' . esc_attr( $font_size ) . ';';
		}
		if ( ! empty( $font_family ) ) {
			$wrapper_style .= 'font-family:' . esc_attr( $font_family ) . ';';
		}
		if ( ! empty( $text_color ) ) {
			$text_style .= 'color:' . esc_attr( $text_color ) . ';';
		}
		if ( ! empty( $icon_color ) ) {
			$icon_style .= 'color:' . esc_attr( $icon_color ) . ';';
		}
		// Enforce 17px icon size as requested
		$icon_style .= 'font-size: 17px;';

		// Generate Hover Styles if set
		if ( ! empty( $text_hover_color ) || ! empty( $icon_hover_color ) ) {
			echo '<style>';
			if ( ! empty( $text_hover_color ) ) {
				echo '#' . esc_attr( $unique_id ) . ':hover span { color: ' . esc_attr( $text_hover_color ) . ' !important; }';
			}
			if ( ! empty( $icon_hover_color ) ) {
				echo '#' . esc_attr( $unique_id ) . ':hover i, #' . esc_attr( $unique_id ) . ':hover .dashicons { color: ' . esc_attr( $icon_hover_color ) . ' !important; }';
			}
			echo '</style>';
		}

		// Frontend HTML structure matching the user's design (e.g., flex layout)
		?>
		<a id="<?php echo esc_attr( $unique_id ); ?>" href="<?php echo esc_url( $link ); ?>" class="flex items-center hover:text-primary transition-colors group" style="<?php echo esc_attr( $wrapper_style ); ?>">
			<?php if ( 'image' === $icon_type && ! empty( $image_url ) ) : ?>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="" class="w-5 h-5 mr-3 object-contain">
			<?php elseif ( 'fontawesome' === $icon_type && ! empty( $icon_class ) ) : ?>
				<i class="<?php echo esc_attr( $icon_class ); ?> mr-2 group-hover:text-primary transition-colors" style="<?php echo esc_attr( $icon_style ); ?>"></i>
			<?php elseif ( 'dashicon' === $icon_type && ! empty( $icon_class ) ) : ?>
				<span class="dashicons <?php echo esc_attr( $icon_class ); ?> mr-2 group-hover:text-primary transition-colors" style="<?php echo esc_attr( $icon_style ); ?>"></span>
			<?php endif; ?>

			<?php if ( ! empty( $text ) ) : ?>
				<span style="<?php echo esc_attr( $text_style ); ?>"><?php echo esc_html( $text ); ?></span>
			<?php endif; ?>
		</a>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$text       = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$link       = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		$icon_type  = ! empty( $instance['icon_type'] ) ? $instance['icon_type'] : 'fontawesome';
		$icon_class = ! empty( $instance['icon_class'] ) ? $instance['icon_class'] : '';
		$image_url  = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
		
		$text_color       = ! empty( $instance['text_color'] ) ? $instance['text_color'] : '';
		$icon_color       = ! empty( $instance['icon_color'] ) ? $instance['icon_color'] : '';
		$text_hover_color = ! empty( $instance['text_hover_color'] ) ? $instance['text_hover_color'] : '';
		$icon_hover_color = ! empty( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';
		$font_size        = ! empty( $instance['font_size'] ) ? $instance['font_size'] : '';
		$font_family      = ! empty( $instance['font_family'] ) ? $instance['font_family'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_attr_e( 'Text:', 'desilan' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_attr_e( 'Link:', 'desilan' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<hr>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_type' ) ); ?>"><?php esc_attr_e( 'Icon Type:', 'desilan' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_type' ) ); ?>">
				<option value="fontawesome" <?php selected( $icon_type, 'fontawesome' ); ?>><?php esc_html_e( 'FontAwesome Class', 'desilan' ); ?></option>
				<option value="dashicon" <?php selected( $icon_type, 'dashicon' ); ?>><?php esc_html_e( 'WordPress Dashicon', 'desilan' ); ?></option>
				<option value="image" <?php selected( $icon_type, 'image' ); ?>><?php esc_html_e( 'Upload Image', 'desilan' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>"><?php esc_attr_e( 'Icon Class (e.g. "fa-solid fa-home"):', 'desilan' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_class' ) ); ?>" type="text" value="<?php echo esc_attr( $icon_class ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php esc_attr_e( 'Image URL:', 'desilan' ); ?></label>
			<input class="widefat desilan-image-upload-url" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="text" value="<?php echo esc_attr( $image_url ); ?>">
			<button type="button" class="button desilan-image-upload-btn" style="margin-top: 5px;"><?php esc_html_e( 'Upload Image', 'desilan' ); ?></button>
		</p>
		<hr>
		<h4><?php esc_html_e( 'Style Settings', 'desilan' ); ?></h4>
		<div style="display: flex; gap: 10px;">
			<p style="flex: 1;">
				<label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_attr_e( 'Text Color:', 'desilan' ); ?></label><br>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" placeholder="#000000">
			</p>
			<p style="flex: 1;">
				<label for="<?php echo esc_attr( $this->get_field_id( 'text_hover_color' ) ); ?>"><?php esc_attr_e( 'Text Hover:', 'desilan' ); ?></label><br>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_hover_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_hover_color' ) ); ?>" type="text" value="<?php echo esc_attr( $text_hover_color ); ?>" placeholder="#000000">
			</p>
		</div>
		<div style="display: flex; gap: 10px;">
			<p style="flex: 1;">
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_attr_e( 'Icon Color:', 'desilan' ); ?></label><br>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" value="<?php echo esc_attr( $icon_color ); ?>" placeholder="#000000">
			</p>
			<p style="flex: 1;">
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_hover_color' ) ); ?>"><?php esc_attr_e( 'Icon Hover:', 'desilan' ); ?></label><br>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_hover_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_hover_color' ) ); ?>" type="text" value="<?php echo esc_attr( $icon_hover_color ); ?>" placeholder="#000000">
			</p>
		</div>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>"><?php esc_attr_e( 'Font Size (e.g. 16px):', 'desilan' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'font_size' ) ); ?>" type="text" value="<?php echo esc_attr( $font_size ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'font_family' ) ); ?>"><?php esc_attr_e( 'Font Family:', 'desilan' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'font_family' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'font_family' ) ); ?>">
				<option value="" <?php selected( $font_family, '' ); ?>><?php esc_html_e( 'Default', 'desilan' ); ?></option>
				<option value="'Inter', sans-serif" <?php selected( $font_family, "'Inter', sans-serif" ); ?>>Inter</option>
				<option value="'Playfair Display', serif" <?php selected( $font_family, "'Playfair Display', serif" ); ?>>Playfair Display</option>
			</select>
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['text']       = ( ! empty( $new_instance['text'] ) ) ? sanitize_text_field( $new_instance['text'] ) : '';
		$instance['link']       = ( ! empty( $new_instance['link'] ) ) ? sanitize_text_field( $new_instance['link'] ) : '#';
		$instance['icon_type']  = ( ! empty( $new_instance['icon_type'] ) ) ? sanitize_text_field( $new_instance['icon_type'] ) : 'fontawesome';
		$instance['icon_class'] = ( ! empty( $new_instance['icon_class'] ) ) ? sanitize_text_field( $new_instance['icon_class'] ) : '';
		$instance['image_url']  = ( ! empty( $new_instance['image_url'] ) ) ? esc_url_raw( $new_instance['image_url'] ) : '';

		$instance['text_color']       = ( ! empty( $new_instance['text_color'] ) ) ? sanitize_hex_color( $new_instance['text_color'] ) : '';
		$instance['icon_color']       = ( ! empty( $new_instance['icon_color'] ) ) ? sanitize_hex_color( $new_instance['icon_color'] ) : '';
		$instance['text_hover_color'] = ( ! empty( $new_instance['text_hover_color'] ) ) ? sanitize_hex_color( $new_instance['text_hover_color'] ) : '';
		$instance['icon_hover_color'] = ( ! empty( $new_instance['icon_hover_color'] ) ) ? sanitize_hex_color( $new_instance['icon_hover_color'] ) : '';
		$instance['font_size']        = ( ! empty( $new_instance['font_size'] ) ) ? sanitize_text_field( $new_instance['font_size'] ) : '';
		$instance['font_family']      = ( ! empty( $new_instance['font_family'] ) ) ? sanitize_text_field( $new_instance['font_family'] ) : '';

		return $instance;
	}
}
