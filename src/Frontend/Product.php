<?php
/**
 * Custom fields for WooCommerce products
 *
 * ? Product add-ons:
 * @link https://www.businessbloomer.com/woocommerce-product-add-ons-without-plugin/
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

    add_action( 'woocommerce_init', [ $this, 'remove_woocommerce_hooks' ], 10 );

    add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'product_addon' ], 9 );
    add_filter( 'woocommerce_add_to_cart_validation', [ $this, 'product_addon_validation' ], 10, 3 );
    add_filter( 'woocommerce_add_cart_item_data', [ $this, 'product_addon_cart_item_data' ], 10, 2 );
    add_filter( 'woocommerce_get_item_data', [ $this, 'product_addon_display_cart' ], 10, 2 );
    add_action( 'woocommerce_add_order_item_meta', [ $this, 'product_addon_order_item_meta' ], 10, 2 );
    add_filter( 'woocommerce_order_item_product', [ $this, 'product_addon_display_order' ], 10, 2 );
    add_filter( 'woocommerce_email_order_meta_fields', [ $this, 'product_addon_display_emails'] );
    add_action( 'woocommerce_before_calculate_totals', [ $this, 'before_calculate_totals' ], 10, 1 );

  }

  /**
   * 1. Show custom input field above Add to Cart
   */
  public function product_addon() {

    $value = isset( $_POST['sample_add_on'] ) ? sanitize_text_field($_POST['sample_add_on']) : '';

    ?>
      <div>
        <label>Sample Field <abbr class="required" title="This field is required">*</abbr></label>
        <p><input name="sample_add_on" class="xeb-form-control" value="<?php echo esc_attr($value); ?>"></p>
      </div>
    <?php

  }

  /**
   * 2. Throw error if custom input field empty
   */
  public function product_addon_validation( $passed, $product_id, $qty ) {

    if ( isset( $_POST['sample_add_on'] ) && sanitize_text_field( $_POST['sample_add_on']) == '' ) {

      wc_add_notice( 'Sample field is required', 'error' );
      $passed = false;

    }

    return $passed;

  }

  /**
   * 3. Save custom input field value into cart item data
   */
  function product_addon_cart_item_data( $cart_item, $product_id ) {

    $product = wc_get_product( $product_id );
    $price = $product->get_price();

    if ( isset( $_POST['sample_add_on'] ) ) {

      $cart_item['sample_add_on'] = sanitize_text_field( $_POST['sample_add_on'] );
      $cart_item['new_price'] = $price + sanitize_text_field( $_POST['sample_add_on'] ); // Update product total price

    }

    return $cart_item;

  }

  /**
   * 4. Display custom input field value @ Cart
   */
  function product_addon_display_cart( $data, $cart_item ) {

    if ( isset( $cart_item['sample_add_on'] ) ) {

      $data[] = array(
        'name' => esc_html__( 'Custom Text Add-On', 'xe-plugin' ),
        'value' => sanitize_text_field( $cart_item['sample_add_on'] )
      );

    }

    return $data;

  }

  /**
   * 5. Save custom input field value into order item meta
   */
  public function product_addon_order_item_meta( $item_id, $values ) {

    if ( !empty($values['sample_add_on']) ) {

      wc_add_order_item_meta( $item_id, 'Custom Text Add-On', $values['sample_add_on'], true );

    }

  }

  /**
   * 6. Display custom input field value into order table
   */
  public function product_addon_display_order( $cart_item, $order_item ) {

    if ( isset( $order_item['sample_add_on'] ) ) {

      $cart_item['sample_add_on'] = $order_item['sample_add_on'];

    }

    return $cart_item;

  }

  /**
   * 7. Display custom input field value into order emails
   */
  public function product_addon_display_emails($fields) {

    $fields['sample_add_on'] = esc_html__( 'Custom Text Add-On', 'xe-plugin' );

    return $fields;

  }

  /**
   * 8. Update product price when "Update Cart" is clicked
   */
  public function before_calculate_totals($cart_obj) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
      return;
    }

    // Iterate through each cart item
    foreach ( $cart_obj->get_cart() as $key => $value ) {

      if ( isset( $value['new_price'] ) ) {

        $price = $value['new_price'];

        $value['data']->set_price( $price );

      }

    }

  }

  /**
   * 9. Remove hooks that are not needed
   */
  public function remove_woocommerce_hooks() {

    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

  }

}
