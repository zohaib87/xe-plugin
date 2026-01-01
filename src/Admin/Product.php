<?php
/**
 * Custom fields, Tabs and Product types for WooCommerce products on backend
 *
 * ? Add Custom Product Type in:
 * @link https://www.tychesoftwares.com/how-to-add-a-new-custom-product-type-in-woocommerce/
 *
 * ? Add checkbox to Product Type Option e.g: Virtual etc.
 * @link https://stackoverflow.com/questions/50043644/add-checkbox-to-product-type-option-in-woocommerce-backend-product-edit-pages
 *
 * ? Add custom fields and Tabs:
 * @link https://awhitepixel.com/blog/woocommerce-product-data-custom-fields-tabs/
 *
 * ? Meta Box functions:
 * @link https://woocommerce.github.io/code-reference/files/woocommerce-includes-admin-wc-meta-box-functions.html
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Frontend;

class Product {

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

    add_action( 'woocommerce_product_options_general_product_data', [ $this, 'add_general_fields' ] );
    add_action( 'woocommerce_process_product_meta', [ $this, 'save_general_fields' ] );

  }

  /**
   * Add custom fields to general tab.
   */
  public function add_general_fields() {

    woocommerce_wp_text_input( [
      'id' => '_sample_metabox',
      'label' => esc_html__( 'Sample', 'xe-plugin' ),
      'wrapper_class' => 'show_if_virtual',
    ] );

  }

  /**
   * Saving custom fields
   */
  public function save_general_fields( $post_id ) {

    $product = wc_get_product( $post_id );
    $num_package = isset( $_POST['_sample_metabox'] ) ? $_POST['_sample_metabox'] : '';
    $product->update_meta_data( '_sample_metabox', sanitize_text_field( $num_package ) );
    $product->save();

  }

}
