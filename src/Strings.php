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
      'dashboardUrl' => _xe_plugin()->endpoints()->get_url_by_key( 'xep-dashboard' ),
      'errorOccurred' => esc_html__( 'An error occurred: ', 'xe-plugin' ),
      // Add more strings here...
    ];

  }

}
