<?php
/**
 * Central plugin application class.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\PluginOptions;
use Xe_Plugin\Defaults;

final class Plugin {

  /**
   * Singleton instance of the App class.
   *
   * @var self|null
   */
  private static ?self $instance = null;

  /**
   * Array of instantiated services
   *
   * @var array<string, object>
   */
  private array $services = [];

  /**
   * Private constructor to prevent direct instantiation.
   */
  private function __construct() {}

  /**
   * Get the singleton instance of the App.
   *
   * Ensures only one instance exists across the plugin.
   *
   * @return self Singleton instance of App.
   */
  public static function instance(): self {

    return self::$instance ??= new self();

  }

  /**
   * Initialize core plugin services.
   *
   * Instantiates PluginOptions and Defaults services.
   * Call this method before accessing them to ensure they exist.
   *
   * @return void
   */
  public function register(): void {

    $this->services['options'] = PluginOptions::instance();
    $this->services['defaults'] = new Defaults();

  }

  /**
   * Access the PluginOptions service.
   *
   * Provides methods to get or set persistent plugin options.
   *
   * @return PluginOptions PluginOptions singleton.
   */
  public function options(): PluginOptions {

    return $this->services['options'];

  }

  /**
   * Access the Defaults service.
   *
   * Provides access to plugin default values.
   *
   * @return Defaults Defaults instance.
   */
  public function defaults(): Defaults {

    return $this->services['defaults'];

  }

  /**
   * Get the full path to a file or folder within the plugin directory.
   *
   * @param string $path Optional relative path.
   * @return string Full file path.
   */
  public function path( string $path = '' ): string {

    return XE_PLUGIN_PATH . ltrim( $path, '/' );

  }

  /**
   * Get the full URL to a file or folder within the plugin directory.
   *
   * @param string $path Optional relative path.
   * @return string Full URL.
   */
  public function url( string $path = '' ): string {

    return XE_PLUGIN_URL . ltrim( $path, '/' );

  }

  /**
   * Get the main plugin file path.
   *
   * @return string Full path to the main plugin file.
   */
  public function file(): string {

    return XE_PLUGIN_FILE;

  }

}
