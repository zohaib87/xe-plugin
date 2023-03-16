<?php
/**
 * Sample shortcode
 *
 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes\Shortcodes;

class Sample {

  function __construct() {
    add_shortcode('xe_plugin_sample', [$this, 'sample']);
  }

  public function sample() {

    return 'Shortcode must always return the output and should never echo it.';

  }

}
new Sample();
