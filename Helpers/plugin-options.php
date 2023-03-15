<?php
/**
 * Plugin functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Helpers;

use Xe_Plugin\Helpers\Helpers as Helper;
use Xe_Plugin\Helpers\Defaults as De;

class Plugin_Options {

  // Others
  public $localhost;

  function __construct() {

    // Assign Option values to variables
    add_action('init', array($this, 'init_vars'));

  }

  /**
   * # Initialize variables for use.
   */
	public function init_vars() {

    // Others
    $this->localhost = $this->localhost();

  }

  /**
   * # Check if its localhost
   */
  protected function localhost() {

    $localhost = array(
      '127.0.0.1',
      '::1'
    );

    if (in_array($_SERVER['REMOTE_ADDR'], $localhost)){
      return true;
    } else {
      return false;
    }

  }

}
global $xep_opt;
$xep_opt = new Plugin_Options();
