<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Xe Plugin
 */

function _xe_plugin_scripts() {

  // Version Control
  $mainCSS = filemtime(_xe_plugin_directory() . '/assets/css/main.css');
  $mainJS = filemtime(_xe_plugin_directory() . '/assets/js/main.js');

  /**
   * Styles
   */
  wp_enqueue_style( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/css/main.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/js/main.js', array('jquery'), esc_attr($mainJS), true );

  wp_localize_script('xe-plugin-main', 'xePluginObj', [
    'ajaxurl' => admin_url('admin-ajax.php'),
    'pluginUrl' => _xe_plugin_directory_uri(),
    'nonce' => wp_create_nonce('_xe_plugin_ajax_nonce'),
	]);

}
add_action('wp_enqueue_scripts', '_xe_plugin_scripts');

/**
 * Enqueue scripts and styles for admin panel.
 */
function _xe_plugin_admin_scripts() {

  global $current_screen;

  // Version Control
  $mainCSS = filemtime(_xe_plugin_directory() . '/assets/css/admin.css');
  $mainJS = filemtime(_xe_plugin_directory() . '/assets/js/admin.js');

	/**
   * Styles
   */
  wp_enqueue_style( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/css/admin.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/js/admin.js', array('jquery'), esc_attr($mainJS), true );

  wp_localize_script('xe-plugin-admin', 'xePluginObj', [
    'pluginUrl' => _xe_plugin_directory_uri(),
    'nonce' => wp_create_nonce('_xe_plugin_ajax_nonce'),
		'postType' => $current_screen->post_type,
		'base' => $current_screen->base,
	]);

}
add_action( 'admin_enqueue_scripts', '_xe_plugin_admin_scripts', 9999 );
