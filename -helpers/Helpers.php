<?php
/**
 * Functions that helps to ease plugin development.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Helpers;

class Helpers {

  /**
   * # Enqueue style or script with auto version control
   *
   * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
   * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
   *
   * @param string    $script     Accepts 'style' or 'script'
   * @param string    $handle     Name of the script. Should be unique.
   * @param string    $src        Path of the script relative to plugins folder.
   * @param array     $deps       An array of registered script handles this script depends on.
   * @param string    $media      The media for which this stylesheet has been defined.
   * @param bool      $in_footer  Whether to enqueue the script before </body> instead of in the <head>.
   * @param string    $ver        Version of the script.
   */
  public static function enqueue($script, $handle, $src = '', $deps = array(), $media = 'all', $in_footer = true, $ver = '') {

    $ver = empty($ver) ? filemtime(xe_billing_directory() . $src) : $ver;

    if ($script == 'style') {
      wp_enqueue_style( esc_attr($handle), xe_billing_directory_uri() . esc_attr($src), $deps, esc_attr($ver), esc_attr($media) );
    } elseif ($script == 'script') {
      wp_enqueue_script( esc_attr($handle), xe_billing_directory_uri() . esc_attr($src), $deps, esc_attr($ver), $in_footer);
    }

  }

  /**
   * # Auto load files from a directory
   *
   * @param string  $path   Path to files (*.php) that needs to be auto loaded.
   */
  public static function auto_load_files($path) {

    $files = glob($path);

    foreach ($files as $file) {
      if (basename($file) == 'index.php') continue;
      require($file);
    }

  }

  /**
   * # Minifying styles
   *
   * @param string  $css   Not compressed css.
   *
   * @return string of minified css.
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
   * # Hex color to rgb conversion
   *
   * @param string  $color   Hex color code.
   *
   * @return string of RGB color.
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
   * # Darken or Lighten Color
   *
   * @param string  $color  Hex color code.
   * @param int     $dif    Number amount of lightning or darkening.
   *
   * @return string of lighter or darker color.
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
   * # Adjusting spacing of classes
   *
   * @param array   $classes   An array of classes
   *
   * @return string of classes with single space in between.
   */
  public static function classes( $classes = array() ) {

    $classes = implode(' ', $classes);
    $classes = trim( preg_replace('/\s+/', ' ', $classes) );

    return $classes;

  }

  /**
   * # Update post meta fields
   *
   * @param int     $post_id      Current post id
   * @param string  $name         Input name attribute
   * @param bool    $is_array     If the input name attribute is array or not
   * @param string  $validation   Sanitization type, accepts: 'text', 'intval', 'floatval', 'textarea', 'email', 'url'
   * @param string  $meta_key     Post meta key
   * @param string  $delete       If true, post meta will be deleted when the specified name attribute is not set.
   */
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

}
