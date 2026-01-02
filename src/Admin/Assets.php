<?php
/**
 * Enqueue scripts and styles for admin.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Admin;

use Xe_Plugin\Utils;

class Assets {

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

    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ], 9999 );

  }

  /**
   * Enqueue styles and scripts.
   */
  public function enqueue() {

    global $current_screen;

    /**
     * Styles
     */
    Utils::enqueue( 'style', 'xe-plugin-admin', 'assets/css/admin.css' );

    /**
     * Scripts
     */
    Utils::enqueue( 'script', 'xe-plugin-admin', 'assets/js/admin.js', ['jquery'] );

    wp_localize_script( 'xe-plugin-admin', 'xePlugin', [
      'pluginUrl' => _xe_plugin()->url(),
      'nonce' => wp_create_nonce( '_xe_plugin_ajax_nonce' ),
      'postType' => $current_screen->post_type,
      'base' => $current_screen->base,
      'localhost' => Utils::localhost(),
      'debug' => Utils::debug()
    ] );

  }

}
