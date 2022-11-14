<?php
/**
 * Functions of reusable sections.
 *
 * @package Xe Plugin
 */

namespace Helpers;

if (!class_exists('Xe_Plugin_Views')) {

  class Xe_Plugin_Views {

    /*--------------------------------------------------------------
    # Sample
    --------------------------------------------------------------*/
    public static function sample() {

      return array(
        'This is a sample array'
      );

    }

  }

}