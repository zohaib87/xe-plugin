<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

use Xe_Plugin\Helpers\Helpers;

class Templates {

  public function __construct() {

    add_filter( 'theme_page_templates', [ $this, 'page_templates' ] );
    add_filter( 'page_template', [ $this, 'page_template_locations' ] );

  }

  /**
   * # Initialize Templates
   */
  public function templates() {

    $page_templates = _xe_plugin_directory() . '/page-templates';

    return [
      'xep-login' => [
        'title' => esc_html__( 'Login (Xe Plugin)', 'three-q' ),
        'path' => $page_templates . '/login.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-signup' => [
        'title' => esc_html__( 'Signup (Xe Plugin)', 'three-q' ),
        'path' => $page_templates . '/signup.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-forgot-password' => [
        'title' => esc_html__( 'Forgot Password (Xe Plugin)', 'three-q' ),
        'path' => $page_templates . '/forgot-password.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-dashboard' => [
        'title' => esc_html__( 'Dashboard (Xe Plugin)', 'three-q' ),
        'path' => $page_templates . '/dashboard.php',
        'single_use' => true,
        'auth' => true
      ],
    ];

  }

  /**
   * # Add custom page templates
   *
   * @link https://wordpress.stackexchange.com/a/350995/201597
   */
  public function page_templates( $templates ) {

    global $post;

    $current_template = get_post_meta( $post->ID, '_wp_page_template', true );

    foreach ( $this->templates() as $unique_key => $array ) {

      if ( $array['single_use'] === true && ! Helpers::template_used( $unique_key, $post ? $post->ID : null ) || ( $post && $current_template === $unique_key ) ) {

        $templates[ $unique_key ] = $array['title'];

      }

      if ( $array['single_use'] === false ) {

        $templates[ $unique_key ] = $array['title'];

      }

    }

    return $templates;

  }

  /**
   * # Custom page templates locations
   *
   * @link https://wordpress.stackexchange.com/a/350995/201597
   */
  public function page_template_locations( $page_template ) {

    foreach ( $this->templates() as $unique_key => $array ) {

      if ( get_page_template_slug() === $unique_key ) {

        $page_template = $array['path'];

        break;

      }

    }

    return $page_template;

  }

}
new Templates();
