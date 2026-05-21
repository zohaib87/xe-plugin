<?php
/**
 * Custom elementor widgets.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

class Elementor {

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {}

  /**
   * Register the hooks and filters.
   *
   * @return void
   */
  public function register(): void {

    add_action( 'elementor/elements/categories_registered', [ $this, 'categories' ] );
    add_action( 'elementor/widgets/register', [ $this, 'widgets' ] );

  }

  /**
   * Register custom widgets.
   */
  public function widgets( $widgets_manager ) {

    $widget_files = glob( _xe_plugin()->path() . 'Elementor/*.php' );

    if ( empty( $widget_files ) ) {
      return;
    }

    foreach ( $widget_files as $file ) {

      require_once $file;

      $class_name = '\\Xe_Plugin\\Elementor\\' . basename( $file, '.php' );

      if ( class_exists( $class_name ) ) {

        $widgets_manager->register( new $class_name() );

      }

    }

  }

  /**
   * Add custom categories.
   */
  public function categories( $elements_manager ) {

    $elements_manager->add_category(
      '_xe_plugin', [
        'title' => esc_html__( 'Xe Plugin', 'xe-plugin' ),
        'icon' => 'fa fa-car',
      ]
    );

    return $elements_manager;

  }

}
