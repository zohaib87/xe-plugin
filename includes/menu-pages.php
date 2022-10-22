<?php
/**
 * Register custom menu and sub-menu pages.
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
		'edit-tags.php?post_type=sample-cpt'
	);

  add_submenu_page(
		'xe-plugin-options',
		esc_html__('Sample Taxonomy', 'xe-plugin'),
		esc_html__('Sample Taxonomy', 'xe-plugin'),
		'manage_options',
		'edit-tags.php?taxonomy=sample-cat&post_type=sample-cpt'
	);

}
add_action('admin_menu', '_xe_plugin_add_menu_pages');
