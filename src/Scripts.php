<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\Utils;

class Scripts {

  public function __construct() {

    add_action( 'wp_enqueue_scripts', [ $this, 'frontend' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'backend' ], 9999 );

  }

  /**
   * Enqueue scripts and styles for front-end.
   */
  public function frontend() {

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

  /**
   * Enqueue scripts and styles for admin panel.
   */
  public function backend() {

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
