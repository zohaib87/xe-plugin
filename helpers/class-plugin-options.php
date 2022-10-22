<?php
/**
 * Plugin functions and definitions.
 *
 * @package Xe Plugin
 */

use Helpers\Xe_Plugin_Helpers as Helper;
use Helpers\Xe_Plugin_Defaults as De;

class Xe_Plugin_Options {

  // Global
  public $localhost;

  function __construct() {

    // Assign Option values to variables
    add_action('wp', array($this, 'init_vars'));

  }

  /**
   * Initialize variables for use.
   */
	public function init_vars() {

    // Global
    $this->localhost = Helper::localhost();

  }

}
global $xep_opt;
$xep_opt = new Xe_Plugin_Options();
