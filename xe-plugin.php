<?php
/**
 * Plugin Name: Xe Plugin
 * Description: Just a blank WordPress plugin.
 * Version:     1.0.0
 * Author:      Muhammad Zohaib - XeCreators
 * Author URI:  http://www.xecreators.pk
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: xe-plugin
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// check if class already exists
if (!class_exists('Xe_Plugin_Manager')) :

/**
 * Theme's core plugin starts here. This class sets mode, adds required wp hooks and loads required object of structure.
 *
 * This class controls and access to all modules and classes.
 */
class Xe_Plugin_Manager {
    
    function __construct() {

        register_activation_hook(__FILE__, array($this, 'plugin_activation'));
        register_deactivation_hook(__FILE__, array($this, 'plugin_deactivation'));
        add_action('plugins_loaded', array($this, 'load_textdomain'));

        $this->initialize();
        
    }

    public function initialize() {

        require 'includes/class-plugin-options.php';

        // Start your Plugin functionality from here

    }

    /**
     * Plugin Activation 
     */
    public function plugin_activation() {
    }

    /**
     * Plugin Deactivation 
     */
    public function plugin_deactivation() {
    }

    /**
     * Translate plugin
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'xe-plugin', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
    }

}
new Xe_Plugin_Manager();

endif;
