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
    add_action( 'init', [ $this, 'load_textdomain' ] );

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
   * Create custom city customers table
   */
  // public function create_city_customers_table() {

  //   global $wpdb;

  //   $table_name = $wpdb->prefix . 'city_customers';
  //   $charset_collate = $wpdb->get_charset_collate();

  //   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  //   $sql = "CREATE TABLE $table_name (
  //     id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  //     name VARCHAR(100) NOT NULL,
  //     phone VARCHAR(20) DEFAULT NULL,
  //     email VARCHAR(100) DEFAULT NULL,
  //     city VARCHAR(100) DEFAULT NULL,
  //     address TEXT DEFAULT NULL,
  //     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  //     PRIMARY KEY (id)
  //   ) $charset_collate;";

  //   dbDelta( $sql );

  //   $wpdb->query( "ALTER TABLE $table_name ADD INDEX phone_index (phone)" );
  //   $wpdb->query( "ALTER TABLE $table_name ADD INDEX email_index (email)" );
  //   $wpdb->query( "ALTER TABLE $table_name ADD INDEX city_index (city)" );

  // }

  /**
   * Plugin Activation
   */
  public static function activation() {

    // $instance = new self();
    // $instance->create_city_customers_table();

  }

  /**
   * Plugin Deactivation
   */
  public static function deactivation() {
  }

  /**
   * Translate Plugin
   */
  public function load_textdomain() {

    load_plugin_textdomain( 'xe-plugin', false, dirname( XE_PLUGIN_BASENAME ) . '/languages/' );

  }

}
