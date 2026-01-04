<?php
/**
 * Endpoints
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

class Endpoints {

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

    add_action( 'init', [ $this, 'add_endpoints' ] );
    add_filter( 'query_vars', [ $this, 'add_query_vars' ] );
    add_action( 'template_redirect', [ $this, 'add_content' ] );

  }

  /**
   * Return all endpoints registered by the plugin.
   *
   * @var array<string, mixed>
   */
  public function all(): array {

    $templates_dir = XE_PLUGIN_PATH . 'templates';
    $index_file = XE_PLUGIN_PATH . 'templates/index.php';

    return [
      'xep-login' => [
        'path' => $templates_dir . '/login.php',
        'slug' => 'login',
        'auth' => false
      ],
      'xep-forgot-password' => [
        'path' => $templates_dir . '/forgot-password.php',
        'slug' => 'reset-password',
        'auth' => false
      ],
      'xep-dashboard' => [
        'path' => $templates_dir . '/dashboard.php',
        'slug' => 'dashboard',
        'auth' => true
      ],
      'xep-error' => [
        'path' => $templates_dir . '/error.php',
        'slug' => 'error-404',
        'auth' => true
      ],
      'xep-sales' => [
        'path' => $index_file,
        'slug' => 'sales',
        'auth' => true,
        'titles' => [
          'trash' => esc_html__( 'Deleted Sales', 'xem-pos' ),
          'add-new' => esc_html__( 'Add New Sale', 'xem-pos' ),
          'edit' => esc_html__( 'Edit Sale', 'xem-pos' ),
          'all' => esc_html__( 'Sales', 'xem-pos' ),
        ]
      ],
    ];

  }

  /**
   * Register custom endpoints
   */
  public function add_endpoints(): void {

    foreach ( $this->all() as $key => $array ) {

      add_rewrite_endpoint( $array['slug'], EP_ROOT );

    }

  }

  /**
   * Add query var for the custom endpoints
   */
  public function add_query_vars( $vars ): array {

    foreach ( $this->all() as $key => $array ) {

      $vars[] = $array['slug'];

    }

    return $vars;

  }

  /**
   * Handle the custom endpoints content
   */
  public function add_content(): void {

    global $wp_query;

    foreach ( $this->all() as $key => $array ) {

      if ( isset( $wp_query->query_vars[ $array['slug'] ] ) ) {

        load_template( $array['path'] );
        exit;

      }

    }

  }

  /**
   * Get endpoint Url using key.
   *
   * @param string  $key  Endpoint ID/key
   * @param string  $path Optional relative path.
   *
   * @return string url of the endpoint
   */
  public function get_url_by_key( string $key, string $path = '' ): string {

    return esc_url( trailingslashit( home_url( $this->all()[ $key ]['slug'] . ltrim( $path, '/' ) ) ) );

  }

  /**
   * Get the current endpoint's key.
   *
   * The endpoint key if present, otherwise empty.
   *
   * @return string
   */
  public function get_key(): string {

    $endpoint_keys = $endpoint_slugs = [];

    foreach ( $this->all() as $key => $array ) {

      $endpoint_keys[] = $key;
      $endpoint_slugs[] = $array['slug'];

    }

    // Loop through query vars and check if any endpoint is present
    foreach ( $endpoint_slugs as $key => $endpoint ) {

      if ( get_query_var( $endpoint, false ) !== false ) {

        return $endpoint_keys[ $key ];

      }

    }

    return ''; // Return empty if no endpoint is found

  }

  /**
   * Get current endpoint's URL
   *
   * @return string
   */
  public function get_current_url( string $path = '' ): string {

    return $this->get_url_by_key( $this->get_key() ) . ltrim( $path, '/' );

  }

  /**
   * Get current endpoint's slug
   *
   * @return string
   */
  public function get_slug(): string {

    return ! empty( self::get_key() ) ? $this->all()[ self::get_key() ]['slug'] : '';

  }

  /**
   * Get current endpoint's page title
   *
   * @param string  $type    Type of title to get, 'trash', 'add-new', 'edit' or 'all'
   *
   * @return string
   */
  public function get_title( $type ): string {

    $endpoint = self::get_key();
    $endpoints = $this->all();

    if ( ! empty( $endpoint ) && isset( $endpoints[ $endpoint ]['titles'][ $type ] ) ) {

      return $endpoints[ $endpoint ]['titles'][ $type ];

    }

    return '';

  }

  /**
   * Get endpoint's edit Url using key.
   *
   * @param string    $key    Endpoint ID/key
   * @param string    $id     Post ID/key
   *
   * @return string url of the endpoint
   */
  public function get_edit_url( $key, $id ): string {

    return esc_url( home_url( $this->all()[ $key ]['slug'] . '/?edit=' . esc_attr( $id ) ) );

  }

  /**
   * Check whether the current endpoint has a specific key.
   *
   * Determines if the given endpoint key is present in the current query vars.
   *
   * @param string  $key   Endpoint key
   *
   * @return bool
   */
  public function is_current( $key ): bool {

    global $wp_query;

    // Check if the current query has the endpoint.
    if ( isset( $this->all()[ $key ] ) && isset( $wp_query->query_vars[ $this->all()[ $key ]['slug'] ] ) ) {

      return true;

    }

    return false;

  }

}
