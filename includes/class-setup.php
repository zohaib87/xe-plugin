<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

class Setup {

  function __construct() {

    register_activation_hook( _xe_plugin_file(), [ $this, 'activation' ] );
    register_deactivation_hook( _xe_plugin_file(), [ $this, 'deactivation' ] );
    register_uninstall_hook( _xe_plugin_file(), [ self::class, 'uninstall' ] );
    add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );

    // Replace the 'register_uninstall_hook' with following if Freemius SDK is used.
    // _xe_plugin_fs()->add_action( 'after_uninstall', [ self::class, 'uninstall' ] );

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
    load_plugin_textdomain( 'xe-plugin', false, _xe_plugin_directory() . '/languages/' );
  }

}
new Setup();
