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

    $widgets = [
      \Xe_Plugin\Elementor\Heading::class,
      \Xe_Plugin\Elementor\Button::class,
    ];

    foreach ( $widgets as $widget_class ) {

      if ( class_exists( $widget_class ) ) {

        $widgets_manager->register( new $widget_class() );

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
