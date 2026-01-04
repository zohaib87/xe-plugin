<?php
/**
 * Central translation strings.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

final class Strings {

  /**
   * Get all strings.
   *
   * @return array<string, string> Associative array of translation strings.
   */
  public static function all(): array {

    return [
      'pleaseWait'      => esc_html__( 'Please wait...', 'xe-plugin' ),
      // Add more strings here...
    ];

  }

}
