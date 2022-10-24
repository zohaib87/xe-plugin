<?php
/**
 * Sample shortcode
 *
 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @package Xe Plugin
 */

function _xe_plugin_sample() {

  return 'Shortcode must always return the output and should never echo it.';

}
add_shortcode('xe_plugin_sample', '_xe_plugin_sample');
