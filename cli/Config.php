<?php
/**
 * Config
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI;

class Config {

  /**
   * Config data
   *
   * @var array
   */
  protected array $config = [];

  /**
   * Constructor
   */
  public function __construct() {

    $path = dirname( __DIR__ ) . '/config.json';

    if ( file_exists( $path ) ) {

      $this->config = json_decode(
        file_get_contents( $path ),
        true
      );

    }

  }

  /**
   * Get config value
   *
   * @param string $key Key.
   * @param mixed  $default Default value.
   *
   * @return mixed
   */
  public function get( string $key, mixed $default = null ): mixed {

    return $this->config[ $key ] ?? $default;

  }

}
