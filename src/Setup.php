<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

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

    add_action( 'template_redirect', [ $this, 'require_authentication' ] );
    add_action( 'template_redirect', [ $this, 'redirect_authenticated' ] );
    add_action( 'admin_init', [ $this, 'flush_rewrite_rules_on_update' ] );

    register_activation_hook( _xe_plugin()->file(), [ $this, 'activation' ] );
    register_deactivation_hook( _xe_plugin()->file(), [ $this, 'deactivation' ] );
    register_uninstall_hook( _xe_plugin()->file(), [ self::class, 'uninstall' ] );
    add_action( 'init', [ $this, 'load_textdomain' ] );

    // Replace the 'register_uninstall_hook' with following if Freemius SDK is used.
    // _xe_plugin_fs()->add_action( 'after_uninstall', [ $this, 'uninstall' ] );

  }

  /**
   * Enforce authentication for protected page templates.
   *
   * Redirects unauthenticated users to the login page
   * when accessing templates that require authentication.
   *
   * @return void
   */
  public function require_authentication(): void {

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which needs authentication/login
    $filtered_templates = array_filter( _xe_plugin()->templates()->all(), function ( $template ) {

      return $template['auth'] === true;

    } );

    // Get only keys of page templates
    $template_keys = array_keys( $filtered_templates );

    if ( in_array( $current_template, $template_keys ) && ! is_user_logged_in() ) {

      wp_redirect( get_permalink( _xe_plugin()->templates()->get_page_id( 'xep-login' ) ) );
      exit;

    }

  }

  /**
   * Redirect authenticated users away from guest-only templates.
   *
   * Prevents logged-in users from accessing pages such as
   * login, signup, or password reset templates.
   *
   * @return void
   */
  public function redirect_authenticated(): void {

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

    // Get templates which does not need authentication/login
    $filtered_templates = array_filter( _xe_plugin()->templates()->all(), function ( $template ) {

      return $template['auth'] === false;

    } );

    // Get only keys of page templates
    $template_keys = array_keys( $filtered_templates );

    if ( in_array( $current_template, $template_keys ) && is_user_logged_in() ) {

      wp_redirect( get_permalink( _xe_plugin()->templates()->get_page_id( 'xep-dashboard' ) ) );
      exit;

    }

  }

  /**
   * Enforce authentication for protected endpoint templates.
   *
   * Redirects unauthenticated users to the login page
   * when accessing templates that require authentication.
   *
   * @return void
   */
  // public function require_authentication(): void {

  //   // Get endpoints which needs authentication/login
  //   $filtered_endpoints = array_filter( _xe_plugin()->endpoints()->all(), function ( $endpoint ) {

  //     return $endpoint['auth'] === true;

  //   } );

  //   // Get only keys of page endpoints
  //   $endpoints = array_keys( $filtered_endpoints );

  //   if ( in_array( _xe_plugin()->endpoints()->get_key(), $endpoints ) && ! is_user_logged_in() ) {

  //     $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

  //     wp_redirect( _xe_plugin()->endpoints()->get_url_by_key( 'mpos-login', '?redirect_to=' . urlencode( $current_url ) ) );

  //     exit;

  //   }

  // }

  /**
   * Redirect authenticated users away from guest-only endpoint templates.
   *
   * Prevents logged-in users from accessing pages such as
   * login, signup, or password reset templates.
   *
   * @return void
   */
  // public function redirect_authenticated(): void {

  //   $current_endpoint = _xe_plugin()->endpoints()->get_key();

  //   // Get endpoints which does not need authentication/login
  //   $filtered_endpoints = array_filter( _xe_plugin()->endpoints()->all(), function ( $endpoint ) {

  //     return $endpoint['auth'] === false;

  //   } );

  //   // Get only keys of page endpoints
  //   $endpoints = array_keys( $filtered_endpoints );

  //   if ( in_array( $current_endpoint, $endpoints ) && is_user_logged_in() ) {

  //     wp_redirect( _xe_plugin()->endpoints()->get_url_by_key( 'mpos-dashboard' ) );
  //     exit;

  //   }

  // }

  /**
   * Flush rewrite rules on update
   *
   * @return void
   */
  public function flush_rewrite_rules_on_update(): void {

    $current_version = _xe_plugin()->data()->Version;
    $saved_version = get_option( '_xe_plugin_plugin_version' );

    if ( $saved_version !== $current_version ) {

      flush_rewrite_rules();

      update_option( '_xe_plugin_plugin_version', $current_version );

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
