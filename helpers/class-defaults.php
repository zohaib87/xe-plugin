<?php
/**
 * Default values for options.
 *
 * @package Xe Plugin
 */

namespace Helpers;

class Xe_Plugin_Defaults {

  // General
  public static $default;

  function __construct() {

    // General
    Self::$default = 'default';

  }

}
new Xe_Plugin_Defaults();
