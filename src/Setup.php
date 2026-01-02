<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

use Xe_Plugin\Utils;
use Xe_Plugin\PageTemplates;

class Setup {

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

    add_action( 'template_redirect', [ $this, 'redirect_if_not_logged_in' ] );
    add_action( 'template_redirect', [ $this, 'redirect_if_logged_in' ] );

    register_activation_hook( _xe_plugin()->file(), [ $this, 'activation' ] );
    register_deactivation_hook( _xe_plugin()->file(), [ $this, 'deactivation' ] );
    register_uninstall_hook( _xe_plugin()->file(), [ self::class, 'uninstall' ] );
    add_action( 'init', [ $this, 'load_textdomain' ] );

    // Replace the 'register_uninstall_hook' with following if Freemius SDK is used.
    // _xe_plugin_fs()->add_action( 'after_uninstall', [ $this, 'uninstall' ] );

  }

  /**
   * Redirect if not logged in
   */
  public function redirect_if_not_logged_in() {

    $page_templates = new PageTemplates();

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which needs authentication/login
    $filtered_templates = array_filter( $page_templates->templates(), function ( $template ) {

      return $template['auth'] === true;

    } );

    // Get only keys of page templates
    $template_keys = array_keys( $filtered_templates );

    if ( in_array( $current_template, $template_keys ) && ! is_user_logged_in() ) {

      wp_redirect( get_permalink( Utils::get_template_id( 'xep-login' ) ) );
      exit;

    }

  }

  /**
   * Redirect if logged in
   */
  public function redirect_if_logged_in() {

    $page_templates = new PageTemplates();

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which does not need authentication/login
    $filtered_templates = array_filter( $page_templates->templates(), function ( $template ) {

      return $template['auth'] === false;

    } );

    // Get only keys of page templates
    $template_keys = array_keys( $filtered_templates );

    if ( in_array( $current_template, $template_keys ) && is_user_logged_in() ) {

      wp_redirect( get_permalink( Utils::get_template_id( 'xep-dashboard' ) ) );
      exit;

    }

  }

  /**
   * Plugin Activation
   */
  public function activation() {
  }

  /**
   * Plugin Deactivation
   */
  public function deactivation() {
  }

  /**
   * Plugin Uninstall
   */
  public static function uninstall() {

    global $wpdb;

    // $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('xep-sales', 'xep-frames', 'xep-glasses', 'xep-w-customers')");
    // $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM {$wpdb->posts})");

    // $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'xep-glasses-cat'");

    // $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('xep_company', 'xep_contactno', 'xep_address', 'xep_city', 'xep_postalcode')");

    // $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'xep_options'");

  }

  /**
   * Translate Plugin
   */
  public function load_textdomain() {

    load_plugin_textdomain( 'xe-plugin', false, dirname( XE_PLUGIN_BASENAME ) . '/languages/' );

  }

}
