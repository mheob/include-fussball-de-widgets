<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

/**
 * FUBADE Widget.
 *
 * Creates a fubade widget.
 *
 * @since   3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IFDW_Fubade_Widget
 *
 * @since 3.0.0
 */
class IFDW_Fubade_Widget extends WP_Widget {
	/**
	 * The constructor.
	 *
	 * Set up the widgets name etc.
	 */
	public function __construct() {
		$widget_options = [ 'description' => __( 'Displays the fussball.de widget.', 'include-fussball-de-widgets' ) ];

		parent::__construct( 'IFDW_Fubade_Widget', __( 'Fussball.de Widget', 'include-fussball-de-widgets' ), $widget_options );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		// Set the widgets defaults and Parse current settings with defaults.
		$defaults = [
			'title'     => '',
			'api'       => '',
			'fullwidth' => '',
			'devtools'  => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title: ', 'include-fussball-de-widgets' ); ?>
			</label>
			<input 
				type="text"
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>">
				<?php esc_html_e( 'API: ', 'include-fussball-de-widgets' ); ?>
			</label>
			<input 
				type="text"
				class="widefat"
				pattern="[A-Za-z0-9]{32}"
				id="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'api' ) ); ?>"
				value="<?php echo esc_attr( $instance['api'] ); ?>">
		</p>
		<p>
			<input 
				id="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'fullwidth' ) ); ?>"
				type="checkbox"
				value="1"
				<?php checked( '1', $instance['fullwidth'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">
				<?php esc_html_e( 'view in full width', 'include-fussball-de-widgets' ); ?>
			</label>
		</p>
		<p>
			<input 
				id="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'devtools' ) ); ?>"
				type="checkbox"
				value="1"
				<?php checked( '1', $instance['devtools'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>">
				<?php esc_html_e( 'output log data to console', 'include-fussball-de-widgets' ); ?>
			</label>
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['api']       = isset( $new_instance['api'] ) ? wp_strip_all_tags( $new_instance['api'] ) : '';
		$instance['fullwidth'] = isset( $new_instance['textarea'] ) ? 1 : false;
		$instance['devtools']  = isset( $new_instance['checkbox'] ) ? 1 : false;

		return $instance;
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args     The Widget arguments.
	 * @param array $instance The saved values from the database.
	 */
	public function widget( $args, $instance ) {
		// TODO: Generate the correct fussball.de widget.

		// Check the widget options.
		$title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$api       = isset( $instance['api'] ) ? $instance['api'] : '';
		$fullwidth = ! empty( $instance['fullwidth'] ) ? $instance['fullwidth'] : false;
		$devtools  = ! empty( $instance['devtools'] ) ? $instance['devtools'] : false;

		// WordPress core before_widget hook (always include).
		echo esc_html( $args['before_widget'] );

		// Display the widget.
		echo '<div class="widget-text wp_widget_plugin_box">';

		if ( $title ) {
			echo esc_html( $args['before_title'] . $title . $args['after_title'] );
		}

		if ( $api ) {
			echo esc_html( '<p>API: ' . $api . '</p>' );
		}

		if ( $fullwidth ) {
			echo esc_html( '<p>FULLWIDTH: ' . $fullwidth . '</p>' );
		}

		if ( $devtools ) {
			echo esc_html( '<p>DEVTOOLS: ' . $devtools . '</p>' );
		}

		echo '</div>';

		// WordPress core after_widget hook (always include).
		echo esc_html( $args['after_widget'] );
	}
}
