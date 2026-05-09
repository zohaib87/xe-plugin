<?php
/**
 * Plugin Name: Xe Plugin
 * Description: A modern, boilerplate WordPress plugin structure with a streamlined build process — perfect for developers building custom or commercial plugins.
 * Version:     1.0.0
 * Author:      Muhammad Zohaib
 * Author URI:  https://wpguru.pk
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: xe-plugin
 *
 * This plugin is based on: https://github.com/zohaib87/xe-plugin
 * Copyright (c) 2019 Muhammad Zohaib. Licensed under the GNU GPL v2 or later.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin constants: paths, URLs, and main file references
 */
define( 'XE_PLUGIN_FILE', __FILE__ );
define( 'XE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'XE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'XE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Composer autoload
 */
require XE_PLUGIN_PATH . 'vendor/autoload.php';

/**
 * Runs on plugin activation.
 *
 * This function is triggered when the plugin is activated from the WordPress admin.
 * It is responsible for setting up initial requirements such as:
 * - Creating custom database tables
 * - Setting default options
 * - Running any one-time setup logic
 *
 * @return void
 */
function _xe_plugin_activation(): void {

  \Xe_Plugin\Setup::activation();

}
register_activation_hook( XE_PLUGIN_FILE, '_xe_plugin_activation' );

/**
 * Runs on plugin deactivation.
 *
 * This function is triggered when the plugin is deactivated.
 * It is typically used for cleanup tasks such as:
 * - Flushing rewrite rules
 * - Clearing scheduled events
 *
 * Note: This does NOT remove plugin data from the database.
 *
 * @return void
 */
function _xe_plugin_deactivation(): void {

  \Xe_Plugin\Setup::deactivation();

}
register_deactivation_hook( XE_PLUGIN_FILE, '_xe_plugin_deactivation' );

/**
 * Returns the main plugin instance.
 *
 * Acts as a global access point for plugin services like options, paths, and URLs.
 *
 * @return \Xe_Plugin\Plugin Singleton instance of the Plugin class.
 */
function _xe_plugin(): \Xe_Plugin\Plugin {

  return \Xe_Plugin\Plugin::instance();

}

/**
 * Bootstrap the plugin.
 *
 * Registers all services and hooks via the Bootstrap class.
 *
 * @return void
 */
function _xe_plugin_bootstrap(): void {

  // Initialize Plugin services
  \Xe_Plugin\Plugin::instance()->register();

  // Initialize Bootstrap services
  $bootstrap = new \Xe_Plugin\Bootstrap();
  $bootstrap->register();

}
add_action( 'plugins_loaded', '_xe_plugin_bootstrap' );
