<?php
/**
 * Register custom menu and sub-menu pages.
 *
 * @link https://developer.wordpress.org/reference/functions/add_menu_page/
 * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
 *
 * @package Xe Plugin
 */

function _xe_plugin_add_menu_pages() {

  /* Menu Pages */
	add_menu_page(
    esc_html__('Xe Plugin', 'xe-plugin'),
    esc_html__('Xe Plugin', 'xe-plugin'),
    'manage_options',
    'xe-plugin-options',
    '_xe_plugin_options',
    'dashicons-welcome-widgets-menus'
	);

  /* Submenu Pages */
  add_submenu_page(
    'xe-plugin-options',
    esc_html__('Plugin Options', 'xe-plugin'),
    esc_html__('Plugin Options', 'xe-plugin'),
    'manage_options',
    'xe-plugin-options',
    '_xe_plugin_options',
    1
  );

	add_submenu_page(
		'xe-plugin-options',
		esc_html__('Sample Post Type', 'xe-plugin'),
		esc_html__('Sample Post Type', 'xe-plugin'),
		'manage_options',
		'edit.php?post_type=xe-plugin-cpt'
	);

  add_submenu_page(
		'xe-plugin-options',
		esc_html__('Sample Categories', 'xe-plugin'),
		esc_html__('Sample Categories', 'xe-plugin'),
		'manage_options',
		'edit-tags.php?taxonomy=xe-plugin-cat&post_type=xe-plugin-cpt'
	);

  add_submenu_page(
		'xe-plugin-options',
		esc_html__('Sample Tags', 'xe-plugin'),
		esc_html__('Sample Tags', 'xe-plugin'),
		'manage_options',
		'edit-tags.php?taxonomy=xe-plugin-tag&post_type=xe-plugin-cpt'
	);

}
add_action('admin_menu', '_xe_plugin_add_menu_pages');
