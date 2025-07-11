<?php
/**
 * Register custom menu and sub-menu pages.
 *
 * @link https://developer.wordpress.org/reference/functions/add_menu_page/
 * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

use Xe_Plugin\Includes\Callbacks\Plugin_Options;

class Menu_Pages {

  public function __construct() {

    add_action( 'admin_menu', [ $this, 'add_menu_pages' ] );

  }

  /**
   * # Add menu and sub-menu pages
   */
  public function add_menu_pages() {

    $plugin_options = new Plugin_Options();

    /* Menu Pages */
    add_menu_page(
      esc_html__('Xe Plugin', 'xe-plugin'),
      esc_html__('Xe Plugin', 'xe-plugin'),
      'manage_options',
      'xe-plugin-options',
      [$plugin_options, 'html'],
      'dashicons-welcome-widgets-menus'
    );

    /* Submenu Pages */
    add_submenu_page(
      'xe-plugin-options',
      esc_html__('Plugin Options', 'xe-plugin'),
      esc_html__('Plugin Options', 'xe-plugin'),
      'manage_options',
      'xe-plugin-options',
      [$plugin_options, 'html'],
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

}
new Menu_Pages();
