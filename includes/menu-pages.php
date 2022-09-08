<?php
/**
 * Register custom menu and sub-menu pages.
 *
 * @package Xe Plugin
 */

function _xe_plugin_add_menu_pages() {

	function _xe_plugin_page() {
		if ( _xe_plugin_finit()->is_paying()	) {
			wp_redirect('edit.php?post_type=opos-sales');
      exit;
		}
	}

	add_menu_page(
    esc_html__('Xe Plugin', 'xe-plugin'),
    esc_html__('Xe Plugin', 'xe-plugin'),
    'manage_options',
    'xe-plugin',
    '_xe_plugin_page',
    'dashicons-schedule',
    3
	);

	add_submenu_page(
		'xe-plugin',
		esc_html__('Test Submenu', 'xe-plugin'),
		esc_html__('Test Submenu', 'xe-plugin'),
		'manage_options',
		'edit-tags.php?taxonomy=test-cat&post_type=test-cpt'
	);

}
add_action('admin_menu', '_xe_plugin_add_menu_pages');