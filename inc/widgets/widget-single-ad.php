<?php
/**
 * Adds ws_single_ad_widget widget.
 */ 
class ws_single_ad_widget extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ws_single_ad_widget', 

			// Widget name will appear in UI
			__('Wordskins Single Ad', 'observo'), 

			// Widget description
			array( 'description' => __( 'Display a single banner ad.', 'observo' ), ) 
		);
	}

	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args     Widget arguments.
	* @param array $instance Saved values from database.
	*/
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$banner_image = ! empty( $instance['banner_image'] ) ? $instance['banner_image'] : '';
		$banner_url = ! empty( $instance['banner_url'] ) ? $instance['banner_url'] : '';
		$banner_alt = ! empty( $instance['banner_alt'] ) ? $instance['banner_alt'] : '';
		$banner_title = ! empty( $instance['banner_title'] ) ? $instance['banner_title'] : '';
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		printf( 
			'<a href="%1$s" target="_blank"><img src="%2$s" alt="%3$s" title="%4$s"></a>', esc_url($banner_url), esc_url($banner_image), sanitize_text_field($banner_alt), sanitize_text_field($banner_title)
		);
		echo $args['after_widget'];
	}
			
	/**
	* Back-end widget form.
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*/
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$banner_image = ! empty( $instance['banner_image'] ) ? $instance['banner_image'] : '';
		$banner_url = ! empty( $instance['banner_url'] ) ? $instance['banner_url'] : '';
		$banner_alt = ! empty( $instance['banner_alt'] ) ? $instance['banner_alt'] : '';
		$banner_title = ! empty( $instance['banner_title'] ) ? $instance['banner_title'] : '';
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'observo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'banner_image' ); ?>"><?php _e( 'Banner Image:', 'observo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'banner_image' ); ?>" name="<?php echo $this->get_field_name( 'banner_image' ); ?>" type="text" value="<?php echo esc_attr( $banner_image ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'banner_url' ); ?>"><?php _e( 'Banner URL:', 'observo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'banner_url' ); ?>" name="<?php echo $this->get_field_name( 'banner_url' ); ?>" type="text" value="<?php echo esc_attr( $banner_url ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'banner_alt' ); ?>"><?php _e( 'Banner Alt:', 'observo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'banner_alt' ); ?>" name="<?php echo $this->get_field_name( 'banner_alt' ); ?>" type="text" value="<?php echo esc_attr( $banner_alt ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'banner_title' ); ?>"><?php _e( 'Banner Title:', 'observo' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'banner_title' ); ?>" name="<?php echo $this->get_field_name( 'banner_title' ); ?>" type="text" value="<?php echo esc_attr( $banner_title ); ?>" />
		</p>
	<?php 
	}
		
	/**
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['banner_image'] = ( ! empty( $new_instance['banner_image'] ) ) ? strip_tags( $new_instance['banner_image'] ) : '';
		$instance['banner_url'] = ( ! empty( $new_instance['banner_url'] ) ) ? esc_url( strip_tags( $new_instance['banner_url'] ) ) : '';
		$instance['banner_alt'] = ( ! empty( $new_instance['banner_alt'] ) ) ? strip_tags( $new_instance['banner_alt'] ) : '';
		$instance['banner_title'] = ( ! empty( $new_instance['banner_title'] ) ) ? strip_tags( $new_instance['banner_title'] ) : '';

		return $instance;
	}
} // Class ws_single_ad_widget ends here

// Register and load the widget
function ws_load_single_ad_widget() {
	register_widget( 'ws_single_ad_widget' );
}
add_action( 'widgets_init', 'ws_load_single_ad_widget' );