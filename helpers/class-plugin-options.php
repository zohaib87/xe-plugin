<?php 
/**
 * Plugin functions and definitions.
 *
 * @package Xe Plugin
 */

class Xe_Plugin_Options {

  public $plugin;

  function __construct() {

    // Assign Option values to variables
    add_action('wp', array($this, 'init_vars'));

  }

  /**
   * Initialize variables for use.
   */
	public function init_vars() {}

}
global $xe_plugin_opt;
$xe_plugin_opt = new Xe_Plugin_Options();
