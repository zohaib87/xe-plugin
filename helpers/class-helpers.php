<?php 
/**
 * Functions that helps to ease plugin development.
 *
 * @package Xe Plugin
 */

namespace Helpers;

if (!class_exists('Xe_Plugin_Helpers')) :

class Xe_Plugin_Helpers {

  /**
   * Auto load files from a directory.
   */
  public static function auto_load_files($path) {

    $files = glob($path);

    foreach ($files as $file) {
      if (basename($file) == 'index.php') continue;
      require($file); 
    }

  }

  /**
   * Minifying styles 
   */
  public static function minify_css($css) {

    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
    $css = str_replace(array('{ ', ' {'), '{', $css);
    $css = str_replace(array('} ', ' }'), '}', $css);
    $css = str_replace('; ', ';', $css);
    $css = str_replace(': ', ':', $css);
    $css = str_replace(', ', ',', $css);
    $css = str_replace(array('> ', ' >'), '>', $css);
    $css = str_replace(array('+ ', ' +'), '+', $css);
    $css = str_replace(array('~ ', ' ~'), '~', $css);
    $css = str_replace(';}', '}', $css);

    return $css;

  }

  /**
   * Hex color to rgb conversion
   */
  public static function hex2rgb($color) {

    if ( $color[0] == '#' ) {
      $color = substr( $color, 1 );
    }
    if ( strlen( $color ) == 6 ) {
      list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
      list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
      return false;
    }

    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    
    return $r.', '.$g.', '.$b;

  }

  /**
   * Darken or Lighten Color
   */
  public static function darken($color, $dif=20) {

    $color = str_replace('#','', $color);
    $rgb = '';

    if (strlen($color) != 6) {

      // reduce the default amount a little
      $dif = ($dif==20)?$dif/10:$dif;

      for ($x = 0; $x < 3; $x++) {

        $c = hexdec(substr($color,(1*$x),1)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= $c;

      }

    } else {

      for ($x = 0; $x < 3; $x++) {

        $c = hexdec(substr($color, (2*$x),2)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;

      }

    }

    return '#'.$rgb;

  }

  /**
   * Adjusting spacing of classes
   */
  public static function classes( $classes = array() ) {

    $classes = implode(' ', $classes);
    $classes = trim( preg_replace('/\s+/', ' ', $classes) );

    return $classes;

  }

}

endif;
