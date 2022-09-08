<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

/*--------------------------------------------------------------
# Plugin Activation
--------------------------------------------------------------*/
function _xe_plugin_activation() {
}
register_activation_hook(_xe_plugin_file(), '_xe_plugin_activation');

/*--------------------------------------------------------------
# Plugin Deactivation
--------------------------------------------------------------*/
function _xe_plugin_deactivation() {
}
register_deactivation_hook(_xe_plugin_file(), '_xe_plugin_deactivation');

/*--------------------------------------------------------------
# Plugin Uninstall
--------------------------------------------------------------*/
function _xe_plugin_uninstall() {

	global $wpdb;

	// $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('opos-sales', 'opos-frames', 'opos-glasses', 'opos-w-customers')");
	// $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM {$wpdb->posts})");

	// $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'opos-glasses-cat'");

 //  $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('opos_company', 'opos_contactno', 'opos_address', 'opos_city', 'opos_postalcode')");

 //  $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'opos_options'");

}
if ( function_exists('_xe_plugin_finit') ) {
	_xe_plugin_finit()->add_action('after_uninstall', '_xe_plugin_uninstall');
} else {
	register_uninstall_hook(_xe_plugin_file(), '_xe_plugin_uninstall');
}

/*--------------------------------------------------------------
# Translate Plugin
--------------------------------------------------------------*/
function _xe_plugin_load_textdomain() {
  load_plugin_textdomain( 'xe-plugin', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', '_xe_plugin_load_textdomain');