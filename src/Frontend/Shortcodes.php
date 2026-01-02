<?php
/**
 * Shortcodes class
 *
 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

class Shortcodes {

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {}

  /**
   * Register the shortcodes.
   *
   * @return void
   */
  public function register(): void {

    add_shortcode( '_xe_plugin_sample', [ $this, 'sample' ] );

  }

  /**
   * Sample shortcode
   *
   * @return string
   */
  public function sample(): string {

    return 'Shortcode must always return the output and should never echo it.';

  }

}
