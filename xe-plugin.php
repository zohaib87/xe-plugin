<?php
/**
 * Plugin Name: Xe Plugin
 * Description: Just a starter WordPress plugin.
 * Version:     1.0.0
 * Author:      Muhammad Zohaib - XeCreators
 * Author URI:  https://www.xecreators.pk
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: xe-plugin
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require 'functions.php';

/**
 * Plugin setup functions and definitions.
 */
require _xe_plugin_directory() . '/includes/setup.php';

/**
 * Object for containing default values.
 */
require _xe_plugin_directory() . '/Helpers/Defaults.php';

/**
 * Class that holds helper methods.
 */
require _xe_plugin_directory() . '/Helpers/Helpers.php';

/**
 * Class for reusable sections.
 */
require _xe_plugin_directory() . '/Helpers/Views.php';

/**
 * Class to get and use plugin options.
 */
require _xe_plugin_directory() . '/Helpers/PluginOptions.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require _xe_plugin_directory() . '/includes/scripts.php';

/**
 * MetaBoxes
 */
require _xe_plugin_directory() . '/includes/metaboxes/sample.php';

/**
 * Menu or sub-menu Pages
 */
require _xe_plugin_directory() . '/includes/menu-pages.php';
require _xe_plugin_directory() . '/includes/callbacks/options.php';

/**
 * Class for adding custom post types.
 */
require _xe_plugin_directory() . '/includes/class-custom-post-types.php';

/**
 * Class for adding custom taxonomies.
 */
require _xe_plugin_directory() . '/includes/class-custom-taxonomies.php';

/**
 * Class for adding custom WooCommerce fields, Tabs and Product types
 */
// require _xe_plugin_directory() . '/includes/class-product-backend.php';
// require _xe_plugin_directory() . '/includes/class-product-frontend.php';

/**
 * Shortcodes
 */
require _xe_plugin_directory() . '/includes/shortcodes/sample.php';
