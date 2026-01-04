<?php
/**
 * Page templates
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

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

    add_filter( 'theme_page_templates', [ $this, 'add' ] );
    add_filter( 'page_template', [ $this, 'locations' ] );

  }

  /**
   * Return all page templates registered by the plugin.
   *
   * @var array<string, mixed>
   */
  public function all(): array {

    $page_templates = XE_PLUGIN_PATH . 'page-templates';

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
  public function add( $templates ): array {

    global $post;

    $current_template = get_post_meta( $post->ID, '_wp_page_template', true );

    foreach ( $this->all() as $key => $template ) {

      if ( $template['single_use'] === true && ! $this->in_use( $key, $post ? $post->ID : null ) || ( $post && $current_template === $key ) ) {

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
  public function locations( $page_template ): string {

    foreach ( $this->all() as $key => $template ) {

      if ( get_page_template_slug() === $key ) {

        $page_template = $template['path'];

        break;

      }

    }

    return $page_template;

  }

  /**
   * Check if a page template is in use.
   *
   * @param string  $template_key    meta_key of the template
   * @param string  $page_id         ID of the current page
   *
   * @return bool
   */
  public function in_use( $template_key, $page_id = null ): bool {

    $pages = get_posts( [
      'post_type'   => 'page',
      'meta_key'    => '_wp_page_template',
      'meta_value'  => $template_key,
      'post_status' => 'publish',
      'numberposts' => -1,
      'exclude'     => array( $page_id )
    ] );

    return ! empty( $pages );

  }

  /**
   * Check whether the current template has a specific key or its prefix.
   *
   * @param string  $key   Page template key or prefix e.g: 'xep-'
   *
   * @return bool
   */
  public function is_current( $key ): bool {

    $current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
    $is_template = ( strpos( $current_template, $key ) !== false ) ? true : false;

    return $is_template;

  }

  /**
   * Get page template key
   *
   * @param string  $template_key  Key of the template that's store in database.
   *
   * @return string
   */
  public function get_page_id( $template_key = '' ): string {

    $template = get_pages( [
      'meta_key' => '_wp_page_template',
      'meta_value' => $template_key
    ] );

    return ( $template ) ? $template[0]->ID : '';

  }

}
