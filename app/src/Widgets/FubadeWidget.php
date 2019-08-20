<?php
/** @noinspection PhpUnused, PhpMissingParentCallCommonInspection */

/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

namespace IFDW\Widgets;

use WP_Widget;
use IFDW\Frontend\Fubade;

defined( 'ABSPATH' ) || exit;

/**
 * Class FubadeWidget
 * Creates a fubade widget.
 *
 * @since 3.0
 */
class FubadeWidget extends WP_Widget {
  /**
   * The constructor.
   * Set up the Widgets name etc.
   *
   * @since 3.0
   */
  public function __construct() {
    parent::__construct( 'ifdw_fubade_widget',
                         __( 'Fussball.de Widget', 'include-fussball-de-Widgets' ),
                         [ 'description' => __( 'Displays the fussball.de widget.', 'include-fussball-de-Widgets' ) ] );
  }

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options.
   *
   * @since 3.0
   */
  public function form( $instance ): void {
    // Set the Widgets defaults and Parse current settings with defaults.
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
        <?php esc_html_e( 'Title: ', 'include-fussball-de-Widgets' ); ?>
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
        <?php esc_html_e( 'API: ', 'include-fussball-de-Widgets' ); ?>
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
        <?php checked( '1', $instance['fullwidth'] ); ?>
          value="1">
      <label for="<?php echo esc_attr( $this->get_field_id( 'fullwidth' ) ); ?>">
        <?php esc_html_e( 'view in full width', 'include-fussball-de-Widgets' ); ?>
      </label>
    </p>
    <p>
      <input
          id="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'devtools' ) ); ?>"
          type="checkbox"
        <?php checked( '1', $instance['devtools'] ); ?>
          value="1">
      <label for="<?php echo esc_attr( $this->get_field_id( 'devtools' ) ); ?>">
        <?php esc_html_e( 'output log data to console', 'include-fussball-de-Widgets' ); ?>
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
   * @return array The new options.
   * @since 3.0
   */
  public function update( $new_instance, $old_instance ): array {
    $instance              = $old_instance;
    $instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
    $instance['api']       = isset( $new_instance['api'] ) ? wp_strip_all_tags( $new_instance['api'] ) : '';
    $instance['fullwidth'] = isset( $new_instance['fullwidth'] ) ? 1 : false;
    $instance['devtools']  = isset( $new_instance['devtools'] ) ? 1 : false;

    return $instance;
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args     The Widget arguments.
   * @param array $instance The saved values from the database.
   *
   * @since 3.0
   */
  public function widget( $args, $instance ): void {
    // Check the widget options.
    $title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
    $api       = isset( $instance['api'] ) ? $instance['api'] : '';
    $fullwidth = ! empty( $instance['fullwidth'] ) ? true : false;
    $devtools  = ! empty( $instance['devtools'] ) ? true : false;

    // WordPress core before_widget hook (always include).
    echo $args['before_widget'] . PHP_EOL;

    echo '<div class="widget-text wp_widget_plugin_box">' . PHP_EOL;

    echo $args['before_title'] . $title . $args['after_title'] . PHP_EOL;

    echo ( new Fubade() )->output( [
                                     'id'        => '',
                                     'api'       => $api,
                                     'notice'    => $title,
                                     'fullwidth' => $fullwidth,
                                     'devtools'  => $devtools,
                                   ] );

    echo '</div>' . PHP_EOL;

    // WordPress core after_widget hook (always include).
    echo $args['after_widget'] . PHP_EOL;
  }
}
