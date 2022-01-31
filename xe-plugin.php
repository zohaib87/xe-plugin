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
 * Enqueue scripts and styles for admin and front end.
 */
require _xe_plugin_directory() . '/includes/setup.php';

/**
 * Class that holds helper methods.
 */
require _xe_plugin_directory() . '/helpers/class-helpers.php';

/**
 * Class to get and use plugin options.
 */
require _xe_plugin_directory() . '/helpers/class-plugin-options.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require _xe_plugin_directory() . '/includes/scripts.php';

/**
 * Class for adding custom post types.
 */
require _xe_plugin_directory() . '/includes/class-custom-post-types.php';

/**
 * Class for adding custom taxonomies.
 */
require _xe_plugin_directory() . '/includes/class-custom-taxonomies.php';
