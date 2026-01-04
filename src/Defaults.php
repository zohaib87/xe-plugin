<?php
/**
 * Default values for options.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

final class Defaults {

  /**
   * Array of all default option values.
   *
   * @return array<string, mixed> Array of all default option values.
   */
  public function all(): array {

    return [
      'currency'    => 'PKR',
      'sample'      => esc_html__( 'Sample Text', 'xe-plugin' ),
    ];

  }

  /**
   * Get a single default value by key.
   *
   * If the key does not exist, returns the provided fallback value.
   *
   * @param string $key     The option key to retrieve.
   * @param mixed  $default Optional fallback value if key does not exist.
   *
   * @return mixed          The default value or fallback.
   */
  public function get( string $key, $default = null ) {

    $all = $this->all();

    return $all[ $key ] ?? $default;

  }

}
