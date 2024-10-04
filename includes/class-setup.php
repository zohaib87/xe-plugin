<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

use Xe_Plugin\Helpers\Helpers;

class Setup {

  public function __construct() {

    add_action( 'template_redirect', [ $this, 'redirect_if_not_logged_in' ] );
    add_action( 'template_redirect', [ $this, 'redirect_if_logged_in' ] );

    register_activation_hook( _xe_plugin_file(), [ $this, 'activation' ] );
    register_deactivation_hook( _xe_plugin_file(), [ $this, 'deactivation' ] );
    register_uninstall_hook( _xe_plugin_file(), [ self::class, 'uninstall' ] );
    add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );

    // Replace the 'register_uninstall_hook' with following if Freemius SDK is used.
    // _xe_plugin_fs()->add_action('after_uninstall', [$this, 'uninstall']);

  }

  /**
   * # Redirect if not logged in
   */
  public function redirect_if_not_logged_in() {

    global $xep_opt;

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which needs authentication/login
    $filtered_templates = array_filter( $xep_opt->templates, function ( $template ) {

      return $template['auth'] === true;

    } );

    // Get only keys of page templates
    $templates = array_keys( $filtered_templates );

    if ( in_array( $current_template, $templates ) && ! is_user_logged_in() ) {

      wp_redirect( get_permalink( Helpers::get_template_id( 'xep-login' ) ) );
      exit;

    }

  }

  /**
   * # Redirect if logged in
   */
  public function redirect_if_logged_in() {

    global $xep_opt;

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which does not need authentication/login
    $filtered_templates = array_filter( $xep_opt->templates, function ( $template ) {

      return $template['auth'] === false;

    } );

    // Get only keys of page templates
    $templates = array_keys( $filtered_templates );

    if ( in_array( $current_template, $templates ) && is_user_logged_in() ) {

      wp_redirect( get_permalink( Helpers::get_template_id( 'xep-dashboard' ) ) );
      exit;

    }

  }

  /**
   * # Plugin Activation
   */
  public function activation() {
  }

  /**
   * # Plugin Deactivation
   */
  public function deactivation() {
  }

  /**
   * # Plugin Uninstall
   */
  public static function uninstall() {

    global $wpdb;

    // $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('opos-sales', 'opos-frames', 'opos-glasses', 'opos-w-customers')");
    // $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM {$wpdb->posts})");

    // $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'opos-glasses-cat'");

    // $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('opos_company', 'opos_contactno', 'opos_address', 'opos_city', 'opos_postalcode')");

    // $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'opos_options'");

  }

  /**
   * # Translate Plugin
   */
  public function load_textdomain() {
    load_plugin_textdomain( 'xe-plugin', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
  }

}
new Setup();
