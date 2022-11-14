<?php
/**
 * Functions that helps to ease plugin development.
 *
 * @package Xe Plugin
 */

namespace Helpers;

if (!class_exists('Xe_Plugin_Helpers')) {

  class Xe_Plugin_Helpers {

    /*--------------------------------------------------------------
    # Auto load files from a directory
    --------------------------------------------------------------*/
    public static function auto_load_files($path) {

      $files = glob($path);

      foreach ($files as $file) {
        if (basename($file) == 'index.php') continue;
        require($file);
      }

    }

    /*--------------------------------------------------------------
    # Minifying styles
    --------------------------------------------------------------*/
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

    /*--------------------------------------------------------------
    # Hex color to rgb conversion
    --------------------------------------------------------------*/
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

    /*--------------------------------------------------------------
    # Darken or Lighten Color
    --------------------------------------------------------------*/
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

    /*--------------------------------------------------------------
    # Adjusting spacing of classes
    --------------------------------------------------------------*/
    public static function classes( $classes = array() ) {

      $classes = implode(' ', $classes);
      $classes = trim( preg_replace('/\s+/', ' ', $classes) );

      return $classes;

    }

    /*--------------------------------------------------------------
    # Update post meta fields
    --------------------------------------------------------------*/
    public static function update_field($post_id, $name, $is_array, $validation, $meta_key, $delete = false) {

      if (!array_key_exists($name, $_POST) && $delete == false) {
        return;
      } elseif (!array_key_exists($name, $_POST) && $delete == true) {
        delete_post_meta($post_id, $meta_key);
        return;
      }

      if ($is_array == true) {

        switch ($validation) {

          case 'text' :
            $updated_val = array_map('sanitize_text_field', $_POST[$name]);
            break;

          case 'intval' :
            $updated_val = array_map('intval', $_POST[$name]);
            break;

          case 'floatval' :
            $updated_val = array_map('floatval', $_POST[$name]);
            break;

          case 'textarea' :
            $updated_val = array_map('sanitize_textarea_field', $_POST[$name]);
            break;

          case 'email' :
            $updated_val = array_map('sanitize_email', $_POST[$name]);
            break;

          case 'url' :
            $updated_val = array_map('sanitize_url', $_POST[$name]);
            break;

        }

      } else {

        switch ($validation) {

          case 'text' :
            $updated_val = sanitize_text_field($_POST[$name]);
            break;

          case 'intval' :
            $updated_val = intval($_POST[$name]);
            break;

          case 'floatval' :
            $updated_val = floatval($_POST[$name]);
            break;

          case 'textarea' :
            $updated_val = sanitize_textarea_field($_POST[$name]);
            break;

          case 'email' :
            $updated_val = sanitize_email($_POST[$name]);
            break;

          case 'url' :
            $updated_val = sanitize_url($_POST[$name]);
            break;

        }

      }
      update_post_meta($post_id, $meta_key, $updated_val);

      return $updated_val;

    }

    /*--------------------------------------------------------------
    # Check if its localhost
    --------------------------------------------------------------*/
    public static function localhost() {

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

}
