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

require 'helpers/functions.php';

/**
 * Plugin setup functions and definitions.
 */
require _xe_plugin_directory() . '/includes/class-setup.php';

/**
 * Object for containing default values.
 */
require _xe_plugin_directory() . '/helpers/class-defaults.php';

/**
 * Class that holds helper methods.
 */
require _xe_plugin_directory() . '/helpers/class-helpers.php';

/**
 * Class for reusable sections.
 */
require _xe_plugin_directory() . '/helpers/class-views.php';

/**
 * Class to get and use plugin options.
 */
require _xe_plugin_directory() . '/helpers/class-plugin-options.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require _xe_plugin_directory() . '/includes/class-scripts.php';

/**
 * MetaBoxes
 */
require _xe_plugin_directory() . '/includes/metaboxes/class-sample.php';

/**
 * Menu or sub-menu Pages
 */
require _xe_plugin_directory() . '/includes/class-menu-pages.php';
require _xe_plugin_directory() . '/includes/callbacks/class-plugin-options.php';

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
require _xe_plugin_directory() . '/includes/shortcodes/class-sample.php';
