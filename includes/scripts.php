<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Xe Plugin
 */

function _xe_plugin_scripts() {

  // Version Control
  $mainCSS = '1.0.0';
  $mainJS = '1.0.0';

  /**
   * Styles
   */
  wp_enqueue_style( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/css/main.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/js/main.js', array('jquery'), esc_attr($mainJS), true );

}
add_action('wp_enqueue_scripts', '_xe_plugin_scripts');

/**
 * Enqueue scripts and styles for admin panel.
 */
function _xe_plugin_admin_scripts() {

  // Version Control
  $mainCSS = '1.0.0';
  $mainJS = '1.0.0';

	/**
   * Styles
   */
  wp_enqueue_style( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/css/admin.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/js/admin.js', array(), esc_attr($mainJS), true );

}
add_action( 'admin_enqueue_scripts', '_xe_plugin_admin_scripts', 9999 );
