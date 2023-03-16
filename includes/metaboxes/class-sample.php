<?php
/**
 * Custom Fields functions for Sample CPT.
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/#adding-meta-boxes
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes\MetaBoxes;

use Xe_Plugin\Helpers\Helpers as Helper;
use Xe_Plugin\Helpers\Views as View;

class Sample {

  function __construct() {

    add_action('add_meta_boxes', [$this, 'add']);
    add_action('save_post_'.$this->post_type(), [$this, 'save']);

  }

  /**
   * # Define post type for current metabox
   */
  protected function post_type() {
    return 'xe-plugin-cpt';
  }

  /**
   * # Set up and add the meta box.
   */
  public function add() {
    add_meta_box('sample_meta_box', esc_html__('Sample Title', 'xem-pos'), [$this, 'html'], $this->post_type());
  }

  /**
   * Display the meta box HTML to the user.
   */
  public function html($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('xe_plugin_cpt_meta_box', 'xe_plugin_cpt_meta_box_nonce');

    $sample = get_post_meta($post->ID, '_sample', true);

    ?>
      <div class="xe-plugin-field">
        <div class="xe-plugin-label">
          <label for="sample">Serial No:</label>
        </div>
        <div class="xe-plugin-input">
          <input type="text" name="sample" id="sample" value="<?php echo esc_attr($sample); ?>" required>
        </div>
      </div>
    <?php

  }

  /**
   * Save the meta box selections.
   */
  public function save(int $post_id) {

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
new Sample();
