<?php
/**
 * Default values for options.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

final class Defaults {

  /**
   * The array of default option values.
   *
   * @var array<string, mixed>
   */
  private array $data = [
    'currency'    => 'PKR',
    'sample'      => 'Sample Text',
  ];

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

    return $this->data[ $key ] ?? $default;

  }

  /**
   * Get all default values as an associative array.
   *
   * @return array<string, mixed> Array of all default option values.
   */
  public function all(): array {

    return $this->data;

  }

}
