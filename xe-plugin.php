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
require _xe_plugin_directory() . '/controllers/setup.php';

/**
 * Class that holds helper methods.
 */
require _xe_plugin_directory() . '/helpers/class-helpers.php';

/**
 * Class to get and use plugin options.
 */
require _xe_plugin_directory() . '/controllers/class-plugin-options.php';

/**
 * Required plugins activation.
 */
require _xe_plugin_directory() . '/helpers/plugins-activator.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require _xe_plugin_directory() . '/controllers/scripts.php';

/**
 * Class for adding custom post types.
 */
require _xe_plugin_directory() . '/models/class-custom-post-types.php';

/**
 * Class for adding custom taxonomies.
 */
require _xe_plugin_directory() . '/models/class-custom-taxonomies.php';
