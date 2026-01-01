<?php
/**
 * Plugin bootstrap class
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\Admin\Views as AdminViews;
use Xe_Plugin\Frontend\Views as FrontendViews;
use Xe_Plugin\Frontend\PageTemplates;
use Xe_Plugin\Setup;
use Xe_Plugin\Scripts;
use Xe_Plugin\CustomPostTypes;
use Xe_Plugin\CustomTaxonomies;
use Xe_Plugin\Admin\MenuPages;

class Bootstrap {

  /**
   * List of plugin services to initialize.
   * Only classes that register hooks should go here.
   *
   * @var array<class-string>
   */
  protected array $services = [
    AdminViews::class,
    FrontendViews::class,
    PageTemplates::class,
    Setup::class,
    Scripts::class,
    CustomPostTypes::class,
    CustomTaxonomies::class,
    MenuPages::class
  ];

  /**
   * Initialize all registered services.
   *
   * Instantiates each service class and calls its `register()` method if available.
   * This ensures all WordPress hooks are properly registered.
   *
   * @return void
   */
  public function register() {

    foreach ( $this->services as $service ) {

      // Instantiate service
      $instance = new $service();

      // If service has register() method, call it
      if ( method_exists( $instance, 'register' ) ) {

        $instance->register();

      }

    }

  }

}
