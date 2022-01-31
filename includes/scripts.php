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
  wp_enqueue_style( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/css/main.css' );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-main', _xe_plugin_directory_uri() . '/assets/js/main.js', array('jquery'), '20212306', true );

}
add_action('wp_enqueue_scripts', '_xe_plugin_scripts');

/**
 * Enqueue scripts and styles for admin panel.
 */
function _xe_plugin_admin_scripts() {

	/**
   * Styles
   */
  wp_enqueue_style( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/css/admin.css' );

  /**
   * Scripts
   */
  wp_enqueue_script( 'xe-plugin-admin', _xe_plugin_directory_uri() . '/assets/js/admin.js', array(), '20151215', true );

}
add_action( 'admin_enqueue_scripts', '_xe_plugin_admin_scripts', 9999 );
