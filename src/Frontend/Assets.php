<?php
/**
 * Enqueue scripts and styles for frontend.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

use Xe_Plugin\Utils;
use Xe_Plugin\Strings;

class Assets {

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

    add_action( '_xe_plugin_head', [ $this, 'head' ] );
    add_action( '_xe_plugin_foot', [ $this, 'foot' ] );
    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue_scripts() {

    /**
     * Styles
     */
    Utils::enqueue( 'style', 'xe-plugin-main', 'assets/css/main.css' );

    /**
     * Scripts
     */
    Utils::enqueue( 'script', 'xe-plugin-main', 'assets/js/main.js', ['jquery'] );

    wp_localize_script( 'xe-plugin-main', 'xePlugin', [
      'ajaxUrl' => admin_url( 'admin-ajax.php' ),
      'pluginUrl' => _xe_plugin()->url(),
      'nonce' => wp_create_nonce( '_xe_plugin_ajax_nonce' ),
      'localhost' => Utils::localhost(),
      'debug' => Utils::debug(),
      'strings' => Strings::all()
    ] );

  }

  /**
   * Enqueue styles
   */
  public function head() {

    /**
     * Favicon
     */
    Utils::render_asset( 'icon', '', get_site_icon_url() );

    /**
     * Inline styles
     */
    $this->add_inline_styles();

  }

  /**
   * Enqueue scripts
   */
  public function foot() {

  $endpoints = _xe_plugin()->endpoints();

    /**
     * Localize Script
     */
    Utils::localize_script( 'xePlugin', [
      'ajaxUrl' => admin_url( 'admin-ajax.php' ),
      'pluginUrl' => _xe_plugin()->url(),
      'nonce' => wp_create_nonce( '_xe_plugin_ajax_nonce' ),
      'localhost' => Utils::localhost(),
      'debug' => Utils::debug(),
      'strings' => Strings::all()
    ] );

    /**
     * Authentication JS
     */
    if ( $endpoints->is_current( 'xep-login' ) || $endpoints->is_current( 'xep-forgot-password' ) ) {

      Utils::render_asset( 'script', 'authentication', '/assets/js/authentication.js' );

    }

  }

  /**
	 * Dynamic CSS
	 */
	protected function dynamic_css() {

		$logo_height = '100px';

		$css = "
      .invoice .invoice-title img {
        max-height: ".esc_attr( $logo_height )."px;
      }
		";

		return $css;

	}

  /**
   * Add inline styles
   */
	public function add_inline_styles() {

    $main_css = $this->dynamic_css();

    if ( ! empty( $main_css ) ) {

      echo "<style type='text/css'>" . Utils::minify_css( $main_css ) . "</style>";

    }

	}

}
