<?php
/**
 * Class for ajax requests.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

class Ajax {

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

    add_action( 'wp_ajax__xe_plugin_sample', [ $this, 'sample' ] );
    add_action( 'wp_ajax_nopriv__xe_plugin_sample', [ $this, 'sample' ] );

  }

  /**
   * Sample ajax request.
   */
  public function sample() {

    check_ajax_referer( '_xe_plugin_ajax_nonce', 'nonce' );

    wp_send_json_error( [
      'message' => 'Ajax request failed.'
    ] );

    wp_send_json_success( [
      'message' => 'Ajax request successful.'
    ] );

  }

}
