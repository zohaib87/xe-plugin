<?php
/**
 * Custom Fields functions for Sample CPT.
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/#adding-meta-boxes
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 *
 * @package Xe Plugin
 */

use Helpers\Xe_Plugin_Helpers as Helper;

abstract class Xe_Plugin_SampleMetaBox {

  /**
   * Set up and add the meta box.
   */
  public static function add() {

    $screens = [
      'xe-plugin-cpt'
    ];

    foreach ($screens as $screen) {
      add_meta_box(
        'sample_meta_box', // Unique ID
        'Sample Title', // Box title
        [ self::class, 'html' ], // Content callback, must be of type callable
        $screen, // Post type
        'normal', // The context within the screen where the box should display
        'default' // Priority
      );
    }

  }

  /**
   * Display the meta box HTML to the user.
   */
  public static function html( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('xe_plugin_cpt_meta_box', 'xe_plugin_cpt_meta_box_nonce');

    $sample = get_post_meta($post->ID, '_sample', true);

    ?>
      <div class="bmpos-field">
        <div class="bmpos-label">
          <label for="sample">Serial No:</label>
        </div>
        <div class="bmpos-input">
          <input type="text" name="sample" id="sample" value="<?php echo esc_attr($sample); ?>" required>
        </div>
      </div>
    <?php

  }

  /**
   * Save the meta box selections.
   */
  public static function save( int $post_id ) {

    // Check if our nonce is set.
    if ( !isset($_POST['xe_plugin_cpt_meta_box_nonce']) ) {
      return $post_id;
    }

    $nonce = $_POST['xe_plugin_cpt_meta_box_nonce'];

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce($nonce, 'xe_plugin_cpt_meta_box') ) {
      return $post_id;
    }

    // If this is an autosave, our form has not been submitted,
    // so we don't want to do anything.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
      return $post_id;
    }

    // Check the user's permissions.
    if ( 'xe-plugin-cpt' == $_POST['post_type'] ) {
      if ( !current_user_can('edit_page', $post_id) ) {
        return $post_id;
      }
    } else {
      if ( !current_user_can('edit_post', $post_id) ) {
        return $post_id;
      }
    }

    // Saving or Updating the data
    Helper::update_field($post_id, 'sample', false, 'text', '_sample'); // $post_id, $name, $is_array, $validation, $meta_key, $delete = false

  }

}
add_action( 'add_meta_boxes', ['Xe_Plugin_SampleMetaBox', 'add'] );
add_action( 'save_post_xe-plugin-cpt', ['Xe_Plugin_SampleMetaBox', 'save'] );
