<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

namespace ITSB\IFDW\Widgets;

use ITSB\IFDW\Backend\BorlabsCookie;
use ITSB\IFDW\Frontend\Fubade;

/**
 * Class FubadeWidget creates a fubade widget.
 *
 * @since 3.0
 */
class FubadeWidget extends \WP_Widget {
	/**
	 * FubadeWidget constructor.
	 * Set up the Widgets name etc.
	 *
	 * @since 3.0
	 */
	public function __construct() {
		parent::__construct(
			'ifdw_fubade_widget',
			__( 'Fussball.de Widget', 'include-fussball-de-widgets' ),
			[ 'description' => __( 'Displays the fussball.de widget.', 'include-fussball-de-widgets' ) ]
		);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @since 3.0
	 * @param array $instance The widget options.
	 * @return void
	 */
	public function form( $instance ): void {
		// Set the Widgets defaults and Parse current settings with defaults.
		$defaults = [
			'api'       => '',
			'classes'   => '',
			'title'     => '',
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
				value="<?php echo esc_attr( $instance['title'] ); ?>"
			/>
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
				value="<?php echo esc_attr( $instance['api'] ); ?>"
			/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
				<?php esc_html_e( 'CSS-Classes: ', 'include-fussball-de-widgets' ); ?>
			</label>

			<input
				type="text"
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
				value="<?php echo esc_attr( $instance['classes'] ); ?>"
			/>
		</p>

		<p>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'fullwidth' ) ); ?>"
				type="checkbox"
				<?php checked( '1', $instance['fullwidth'] ); ?>
				value="1"
			/>

			<label for="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">
				<?php esc_html_e( 'view in full width', 'include-fussball-de-widgets' ); ?>
			</label>
		</p>

		<p>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'devtools' ) ); ?>"
				type="checkbox"
				<?php checked( '1', $instance['devtools'] ); ?>
				value="1"
			/>

			<label for="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>">
				<?php esc_html_e( 'output log data to console', 'include-fussball-de-widgets' ); ?>
			</label>
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @since 3.0
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 * @return array The new options.
	 */
	public function update( $new_instance, $old_instance ): array {
		$instance              = $old_instance;
		$instance['api']       = isset( $new_instance['api'] ) ? wp_strip_all_tags( $new_instance['api'] ) : '';
		$instance['classes']   = isset( $new_instance['classes'] ) ? wp_strip_all_tags( $new_instance['classes'] ) : '';
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['fullwidth'] = isset( $new_instance['fullwidth'] ) ? 1 : false;
		$instance['devtools']  = isset( $new_instance['devtools'] ) ? 1 : false;

		return $instance;
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @since 3.0
	 * @param array $args     The Widget arguments.
	 * @param array $instance The saved values from the database.
	 */
	public function widget( $args, $instance ): void {
		// phpcs:disable
		// Check the widget options.
		$api       = $instance['api'] ?? '';
		$classes   = isset( $instance['classes'] ) ? apply_filters( 'widget_title', $instance['classes'] ) : '';
		$title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$fullwidth = empty( $instance['fullwidth'] ) ? false : true;
		$devtools  = empty( $instance['devtools'] ) ? false : true;


		// WordPress core before_widget hook (always include).
		echo $args['before_widget'] . PHP_EOL;

		echo $args['before_title'] . $title . $args['after_title'] . PHP_EOL;

		$output = ( new Fubade() )->output(
			[
				'api'       => $api,
				'id'        => '',
				'classes'   => $classes,
				'notice'    => $title,
				'fullwidth' => $fullwidth,
				'devtools'  => $devtools,
			]
		);

		if ( ( new BorlabsCookie() )->checkBorlabsCookieIsActivated() ) {
			echo BorlabsCookieHelper()->blockContent( $output, BorlabsCookie::CB_ID );
		} else {
			echo $output;
		}

		// WordPress core after_widget hook (always include).
		echo $args['after_widget'] . PHP_EOL;
		// phpcs:enable
	}
}
