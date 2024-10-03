<?php
/**
 * Default values for options.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Helpers;

class Defaults {

  // General
  public static $sample;

  public function __construct() {

    // General
    self::$sample = 'Sample Text';

  }

}
new Defaults();
