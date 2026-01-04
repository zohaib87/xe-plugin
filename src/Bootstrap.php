<?php
/**
 * Plugin bootstrap class
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\Setup;
use Xe_Plugin\PageTemplates;
use Xe_Plugin\PostTypes;
use Xe_Plugin\Taxonomies;
use Xe_Plugin\Elementor;
use Xe_Plugin\Admin\Assets as AdminAssets;
use Xe_Plugin\Admin\Views as AdminViews;
use Xe_Plugin\Admin\MenuPages;
use Xe_Plugin\Frontend\Views as FrontendViews;
use Xe_Plugin\Frontend\Assets as FrontendAssets;
use Xe_Plugin\Frontend\Endpoints;
use Xe_Plugin\Frontend\Shortcodes;

class Bootstrap {

  /**
   * List of plugin services that should be initialized in the global scope.
   *
   * @var array<class-string>
   */
  protected array $global = [
    Setup::class,
    PageTemplates::class,
    PostTypes::class,
    Taxonomies::class,
    Elementor::class
  ];

  /**
   * List of plugin services that should be initialized in the admin scope.
   *
   * @var array<class-string>
   */
  protected array $admin = [
    AdminAssets::class,
    AdminViews::class,
    MenuPages::class
  ];

  /**
   * List of plugin services that should be initialized in the frontend scope.
   *
   * @var array<class-string>
   */
  protected array $frontend = [
    FrontendAssets::class,
    FrontendViews::class,
    Shortcodes::class,
    Endpoints::class
  ];

  /**
   * Initialize all registered services.
   *
   * Instantiates each service class and calls its `register()` method if available.
   * This ensures all WordPress hooks are properly registered.
   *
   * @return void
   */
  public function register(): void {

    $this->load_services( $this->global );

    if ( is_admin() ) {

      $this->load_services( $this->admin );

    }

    if ( $this->is_render_request() ) {

      $this->load_services( $this->frontend );

    }

  }

  /**
   * Instantiates each service class and calls its `register()` method if available.
   *
   * @param array $services List of service classes to initialize.
   *
   * @return void
   */
  protected function load_services( array $services ): void {

    foreach ( $services as $service ) {

      $instance = new $service();

      if ( method_exists( $instance, 'register' ) ) {

        $instance->register();

      }

    }

  }

  /**
   * Check if the current request is a render request.
   *
   * @return bool
   */
  protected function is_render_request(): bool {

    return ! is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST );

  }

}
