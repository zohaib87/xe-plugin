<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package _xe
 */

/**
 * Plugin Activation 
 */
function _xe_plugin_plugin_activation() {
}
register_activation_hook(__FILE__, '_xe_plugin_plugin_activation');

/**
 * Plugin Deactivation 
 */
function _xe_plugin_plugin_deactivation() {
}
register_deactivation_hook(__FILE__, '_xe_plugin_plugin_deactivation');

/**
 * Translate plugin
 */
function _xe_plugin_load_textdomain() {
  load_plugin_textdomain( 'xe-plugin', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', '_xe_plugin_load_textdomain');
