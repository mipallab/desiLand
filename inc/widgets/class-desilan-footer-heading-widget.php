<?php
/**
 * Widget API: DesiLan_Footer_Heading_Widget class
 *
 * @package DesiLan
 */

/**
 * Core class used to implement a DesiLan Footer Heading widget.
 *
 * @see WP_Widget
 */
class DesiLan_Footer_Heading_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'desilan_footer_heading_widget',
			'description' => esc_html__( 'A styled heading for the footer.', 'desilan' ),
		);
		parent::__construct( 'desilan_footer_heading_widget', esc_html__( 'DesiLan Footer Heading', 'desilan' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Output the before widget wrapper if needed, or just raw?
		// Usually widgets output wrapper. But consistent with previous requests, let's keep it clean.
		// However, standard widgets wrap. I'll output the standard before/after.
		// NOTE: The sidebar definition in functions.php also puts a title wrapper. 
		// If the user uses this widget, they should probably leave the "Title" field of the widget area empty 
		// (or we don't use standard title field of WP_Widget) and just output this HTML as the widget content.
		
		echo $args['before_widget'];

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		if ( ! empty( $title ) ) {
			// Matches the requested style + text-sm standardization
			echo '<h4 class="text-white font-medium mb-6 text-sm">' . esc_html( $title ) . '</h4>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Heading Text:', 'desilan' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}
}
