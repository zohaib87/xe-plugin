<?php
/**
 * Page templates
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

use Xe_Plugin\Utils;

class PageTemplates {

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {}

  /**
   * Register the hooks and filters.
   *
   * @return void
   */
  public function register(): void {

    add_filter( 'theme_page_templates', [ $this, 'page_templates' ] );
    add_filter( 'page_template', [ $this, 'page_template_locations' ] );

  }

  /**
   * Initialize templates
   */
  public function templates() {

    $page_templates = _xe_plugin()->path( 'page-templates' );

    return [
      'xep-login' => [
        'title' => esc_html__( 'Login', 'three-q' ),
        'path' => $page_templates . '/login.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-signup' => [
        'title' => esc_html__( 'Signup', 'three-q' ),
        'path' => $page_templates . '/signup.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-forgot-password' => [
        'title' => esc_html__( 'Forgot Password', 'three-q' ),
        'path' => $page_templates . '/forgot-password.php',
        'single_use' => true,
        'auth' => false
      ],
      'xep-dashboard' => [
        'title' => esc_html__( 'Dashboard', 'three-q' ),
        'path' => $page_templates . '/dashboard.php',
        'single_use' => true,
        'auth' => true
      ],
    ];

  }

  /**
   * Add custom page templates
   *
   * @link https://wordpress.stackexchange.com/a/350995/201597
   */
  public function page_templates( $templates ) {

    global $post;

    $current_template = get_post_meta( $post->ID, '_wp_page_template', true );

    foreach ( $this->templates() as $key => $template ) {

      if ( $template['single_use'] === true && ! Utils::template_used( $key, $post ? $post->ID : null ) || ( $post && $current_template === $key ) ) {

        $templates[ $key ] = $template['title'];

      }

      if ( $template['single_use'] === false ) {

        $templates[ $key ] = $template['title'];

      }

    }

    return $templates;

  }

  /**
   * Custom page templates locations
   *
   * @link https://wordpress.stackexchange.com/a/350995/201597
   */
  public function page_template_locations( $page_template ) {

    foreach ( $this->templates() as $key => $template ) {

      if ( get_page_template_slug() === $key ) {

        $page_template = $template['path'];

        break;

      }

    }

    return $page_template;

  }

}
