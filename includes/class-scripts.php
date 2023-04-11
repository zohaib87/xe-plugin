<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

use Xe_Plugin\Helpers\Helpers as Helper;

class Scripts {

  function __construct() {

    add_action( 'wp_enqueue_scripts', [ $this, 'frontend'] );
    add_action( 'admin_enqueue_scripts', [ $this, 'admin' ], 9999 );

  }

  /**
   * # Enqueue scripts and styles for front-end.
   */
  public function frontend() {

    global $xep_opt;

    /**
     * Styles
     */
    Helper::enqueue( 'style', 'xe-plugin-main', '/assets/css/main.css' );

    /**
     * Scripts
     */
    Helper::enqueue( 'script', 'xe-plugin-main', '/assets/js/main.js', ['jquery'] );

    wp_localize_script( 'xe-plugin-main', 'xepObj', [
      'ajaxUrl' => admin_url('admin-ajax.php'),
      'pluginUrl' => _xe_plugin_directory_uri(),
      'nonce' => wp_create_nonce('_xep_ajax_nonce'),
      'localhost' => $xep_opt->localhost
    ] );

  }

  /**
   * # Enqueue scripts and styles for admin panel.
   */
  public function admin() {

    global $current_screen, $xep_opt;

    /**
     * Styles
     */
    Helper::enqueue( 'style', 'xe-plugin-admin', '/assets/css/admin.css' );

    /**
     * Scripts
     */
    Helper::enqueue( 'script', 'xe-plugin-admin', '/assets/js/admin.js', ['jquery'] );

    wp_localize_script( 'xe-plugin-admin', 'xepObj', [
      'pluginUrl' => _xe_plugin_directory_uri(),
      'nonce' => wp_create_nonce('_xep_ajax_nonce'),
      'postType' => $current_screen->post_type,
      'base' => $current_screen->base,
      'localhost' => $xep_opt->localhost
    ] );

  }

}
new Scripts();
