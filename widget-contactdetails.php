<?php
// Creating the widget
class ept_contact extends WP_Widget {

	function __construct() {
		parent::__construct(
// Base ID of your widget
			'ept_contact',

// Widget name will appear in UI
			__('EPT Contact us', 'ept_theme'),

// Widget description
			array( 'description' => __( 'Contact information', 'ept_theme' ), )
		);
	}

// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		echo '<ul class="ept_contact_list">';
        if($instance['contact_address'] != '') {
		    echo '<li class="contact-list_item __address">'.$instance['contact_address'].'</li>';
        }
        if($instance['contact_telephone'] != '') {
            echo '<li class="contact-list_item __telephone">' . $instance['contact_telephone'] . '</li>';
        }
        if($instance['contact_email'] != '') {
            echo '<li class="contact-list_item __email"><a href="mailto:' . $instance['contact_email'] . '">' . $instance['contact_email'] . '</a></li>';
        }
		echo '</ul>';
// This is where you run the code and display the output
		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Contact us', 'ept_theme' );
		}
		if ( isset( $instance[ 'contact_address' ] ) ) {
			$contact_address = $instance[ 'contact_address' ];
		} else {
			$contact_address = __( '1600 Blue Amphitheatre Parkway, Mountain View, CA 94043, USA', 'ept_theme' );
		}
		if ( isset( $instance[ 'contact_telephone' ] ) ) {
			$contact_telephone = $instance[ 'contact_telephone' ];
		} else {
			$contact_telephone = __( '(212) 620 5682;  (375) 620 5682', 'ept_theme' );
		}
		if ( isset( $instance[ 'contact_email' ] ) ) {
			$contact_email = $instance[ 'contact_email' ];
		} else {
			$contact_email = __( 'support@thehtmlcoder.net', 'ept_theme' );
		}


// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ept_theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contact_address' ); ?>"><?php _e( 'Addess', 'ept_theme' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'contact_address' ); ?>" name="<?php echo $this->get_field_name( 'contact_address' ); ?>"><?php esc_html_e( $contact_address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contact_telephone' ); ?>"><?php _e( 'Telephone', 'ept_theme' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'contact_telephone' ); ?>" name="<?php echo $this->get_field_name( 'contact_telephone' ); ?>"><?php esc_html_e( $contact_telephone ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contact_email' ); ?>"><?php _e( 'E-Mail', 'ept_theme' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'contact_email' ); ?>" name="<?php echo $this->get_field_name( 'contact_email' ); ?>"><?php esc_html_e( $contact_email ); ?></textarea>
		</p>

	<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['contact_address'] = ( ! empty( $new_instance['contact_address'] ) ) ? strip_tags( $new_instance['contact_address'] ) : '';
		$instance['contact_telephone'] = ( ! empty( $new_instance['contact_telephone'] ) ) ? strip_tags( $new_instance['contact_telephone'] ) : '';
		$instance['contact_email'] = ( ! empty( $new_instance['contact_email'] ) ) ? strip_tags( $new_instance['contact_email'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here

// Register and load the widget
function contact_load_widget() {
	register_widget( 'ept_contact' );
}
add_action( 'widgets_init', 'contact_load_widget' );
