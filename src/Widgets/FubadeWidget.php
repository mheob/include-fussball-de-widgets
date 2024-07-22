<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW\Widgets;

use ITSB\IFDW\Frontend\Fubade;

/**
 * Class FubadeWidget creates a fubade widget.
 *
 * @since 3.0
 */
class FubadeWidget extends \WP_Widget {
	/**
	 * Constructs a new instance of the FubadeWidget class.
	 *
	 * This constructor initializes the widget with the appropriate ID, title, and description.
	 *
	 * @since 3.0
	 */
	public function __construct() {
		parent::__construct(
			'ifdw_fubade_widget',
			__( 'Fussball.de Widget', 'include-fussball-de-widgets' ),
		// phpcs:ignore Generic.Files.LineLength
			[ 'description' => __( 'Displays the fussball.de widget.', 'include-fussball-de-widgets' ) ]
		);
	}

	/**
	 * Renders the widget form in the WordPress admin area.
	 *
	 * This method is called when the widget is displayed in the admin area, allowing the user
	 * to configure the widget's settings.
	 *
	 * @since 4.0
	 * @param array $instance The current settings for this widget instance.
	 */
	public function form( $instance ): void {
		// Set the Widgets defaults and Parse current settings with defaults.
		$defaults = [
			'api'       => '',
			'type'      => '',
			'title'     => '',
			'fullWidth' => '',
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
				id="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'api' ) ); ?>"
				value="<?php echo esc_attr( $instance['api'] ); ?>"
			/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">
				<?php esc_html_e( 'Type: ', 'include-fussball-de-widgets' ); ?>
			</label>

			<input
				type="text"
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>"
				value="<?php echo esc_attr( $instance['type'] ); ?>"
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
				id="<?php echo esc_attr( $this->get_field_id( 'fullWidth' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'fullWidth' ) ); ?>"
				type="checkbox"
				<?php checked( '1', $instance['fullWidth'] ); ?>
				value="1"
			/>

			<label for="<?php echo esc_attr( $this->get_field_id( 'fullWidth' ) ); ?>">
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
	 * Updates the widget instance with the new values provided.
	 *
	 * @since 4.0
	 * @param array $new_instance The new instance values.
	 * @param array $old_instance The old instance values.
	 * @return array The updated instance values.
	 */
	public function update( $new_instance, $old_instance ): array {
		/* phpcs:disable Generic.Files.LineLength */
		$instance              = $old_instance;
		$instance['api']       = isset( $new_instance['api'] ) ? wp_strip_all_tags( $new_instance['api'] ) : '';
		$instance['type']      = isset( $new_instance['type'] ) ? wp_strip_all_tags( $new_instance['type'] ) : '';
		$instance['classes']   = isset( $new_instance['classes'] ) ? wp_strip_all_tags( $new_instance['classes'] ) : '';
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['fullWidth'] = isset( $new_instance['fullWidth'] ) ? 1 : false;
		$instance['devtools']  = isset( $new_instance['devtools'] ) ? 1 : false;
		/* phpcs:disable */

		return $instance;
	}

	/**
  * Renders the widget output.
  *
	* @since 3.0
  * @param array $args     Widget arguments.
  * @param array $instance Widget settings.
  */
  public function widget( $args, $instance ): void {
		// phpcs:disable
		// Check the widget options.
		$api       = $instance['api'] ?? '';
		$type      = isset( $instance['type'] ) ? apply_filters( 'widget_title', $instance['type'] ) : '';
		$classes   = isset( $instance['classes'] ) ? apply_filters( 'widget_title', $instance['classes'] ) : '';
		$title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$fullWidth = empty( $instance['fullWidth'] ) ? false : true;
		$devtools  = empty( $instance['devtools'] ) ? false : true;


		// WordPress core before_widget hook (always include).
		echo $args['before_widget'] . PHP_EOL;

		echo $args['before_title'] . $title . $args['after_title'] . PHP_EOL;

		$output = ( new Fubade() )->output(
			[
				'api'       => $api,
				'id'        => '',
				'type'      => $type,
				'classes'   => $classes,
				'notice'    => $title,
				'fullWidth' => $fullWidth,
				'devtools'  => $devtools,
				]
			);

		echo $output;

		// WordPress core after_widget hook (always include).
		echo $args['after_widget'] . PHP_EOL;
		// phpcs:enable
	}
}
