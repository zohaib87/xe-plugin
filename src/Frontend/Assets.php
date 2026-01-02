<?php
/**
 * Enqueue scripts and styles for frontend.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

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

    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );

  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue() {

    /**
     * Styles
     */
    Utils::enqueue( 'style', 'xe-plugin-main', 'assets/css/main.css' );

    /**
     * Scripts
     */
    Utils::enqueue( 'script', 'xe-plugin-main', 'assets/js/main.js', ['jquery'] );

    wp_localize_script( 'xe-plugin-main', 'xePlugin', [
      'ajaxUrl' => admin_url( 'admin-ajax.php' ),
      'pluginUrl' => _xe_plugin()->url(),
      'nonce' => wp_create_nonce( '_xe_plugin_ajax_nonce' ),
      'localhost' => Utils::localhost(),
      'debug' => Utils::debug()
    ] );

  }

}
