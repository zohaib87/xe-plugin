<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Xe Plugin
 */

function _xe_plugin_scripts() {

  /**
   * Styles
   */
  Helper::enqueue('style', 'xe-plugin-main', '/assets/css/main.css');

  /**
   * Scripts
   */
  Helper::enqueue('script', 'xe-plugin-main', '/assets/js/main.js', ['jquery']);

  wp_localize_script('xe-plugin-main', 'xepObj', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'pluginUrl' => _xe_plugin_directory_uri(),
    'nonce' => wp_create_nonce('_xe_plugin_ajax_nonce'),
    'localhost' => $xep_opt->localhost
	]);

}
add_action('wp_enqueue_scripts', '_xe_plugin_scripts');

/**
 * Enqueue scripts and styles for admin panel.
 */
function _xe_plugin_admin_scripts() {

  global $current_screen, $xep_opt;

	/**
   * Styles
   */
  Helper::enqueue('style', 'xe-plugin-admin', '/assets/css/admin.css');

  /**
   * Scripts
   */
  Helper::enqueue('script', 'xe-plugin-admin', '/assets/js/admin.js', ['jquery']);

  wp_localize_script('xe-plugin-admin', 'xepObj', [
    'pluginUrl' => _xe_plugin_directory_uri(),
    'nonce' => wp_create_nonce('_xe_plugin_ajax_nonce'),
		'postType' => $current_screen->post_type,
		'base' => $current_screen->base,
    'localhost' => $xep_opt->localhost
	]);

}
add_action( 'admin_enqueue_scripts', '_xe_plugin_admin_scripts', 9999 );
