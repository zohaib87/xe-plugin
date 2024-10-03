<?php
/**
 * Plugin functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Helpers;

use Xe_Plugin\Helpers\Helpers;
use Xe_Plugin\Helpers\Defaults;
use Xe_Plugin\Includes\Templates;

class Plugin_Options {

  // General
  public $sample,

  // Others
  $templates, $debug, $localhost;

  public function __construct() {

    // Assign Option values to variables
    add_action( 'init', [ $this, 'init_vars' ] );

  }

  /**
   * # Initialize variables for use.
   */
	public function init_vars() {

    $templates = new Templates();

    // General
    $this->sample = get_option( '_xep_sample', Defaults::$sample );

    // Others
    $this->templates = $templates->templates();
    $this->debug = $this->debug();
    $this->localhost = $this->localhost();

  }

  /**
   * # Check if debug mode and log is enabled
   */
  protected function debug() {

    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {

      if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {

        return true;

      }

    }

    return false;

  }

  /**
   * # Check if its localhost
   */
  protected function localhost() {

    $localhost = array(
      '127.0.0.1',
      '::1'
    );

    if ( in_array( $_SERVER['REMOTE_ADDR'], $localhost ) ) {

      return true;

    } else {

      return false;

    }

  }

}
global $xep_opt;
$xep_opt = new Plugin_Options();
