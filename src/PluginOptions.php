<?php
/**
 * Get or set plugin options.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\Defaults;

class PluginOptions {

  /**
   * Holds the singleton instance of PluginOptions.
   *
   * @var self|null
   */
  private static ?self $instance = null;

  /**
   * Holds the Defaults instance.
   *
   * @var Defaults
   */
  protected Defaults $defaults;

  /**
   * Option name in database.
   *
   * @var string
   */
  private string $option_name = '_xe_plugin_options';

  /**
   * Cached options.
   *
   * @var array
   */
  private array $options = [];

  /**
   * Private constructor.
   */
  private function __construct() {

    $this->defaults = new Defaults();
    $this->options = get_option( $this->option_name, [] );

  }

  /**
   * Get the singleton instance of PluginOptions.
   *
   * @return self Singleton instance.
   */
  public static function instance(): self {

    return self::$instance ??= new self();

  }

  /**
   * Get a plugin option from the database.
   *
   * @param string $key     Option key (without prefix).
   * @param mixed  $default Optional default value if the option does not exist.
   *
   * @return mixed The value stored in the database, or $default if not set.
   */
  public function get( string $key, $default = null ) {

    $default ??= $this->defaults->get( $key );

    return $this->options[ $key ] ?? $default;

  }

  /**
   * Set a plugin option in the database.
   *
   * @param string $key   Option key (without prefix).
   * @param mixed  $value Value to store.
   *
   * @return bool True if value was updated, false on failure.
   */
  public function set( string $key, $value ): bool {

    $this->options[ $key ] = $value;

    return update_option( $this->option_name, $this->options );

  }

  /**
   * Get all plugin options.
   *
   * @return array<string, mixed>
   */
  public function all(): array {

    return $this->options;

  }

}
