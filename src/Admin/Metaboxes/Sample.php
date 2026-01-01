<?php
/**
 * Custom Fields functions for Sample CPT.
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/#adding-meta-boxes
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Admin\MetaBoxes;

use Xe_Plugin\Utils;

class Sample {

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

    add_action( 'add_meta_boxes', [ $this, 'add' ] );
    add_action( 'save_post_'.$this->post_type(), [ $this, 'save'] );

  }

  /**
   * Define post type for current metabox
   */
  protected function post_type(): string {

    return 'xe-plugin-cpt';

  }

  /**
   * Set up and add the metabox.
   */
  public function add(): void {

    add_meta_box( 'sample_meta_box', esc_html__( 'Sample Title', 'xe-plugin' ), [ $this, 'render' ], $this->post_type() );

  }

  /**
   * Render the metabox.
   */
  public function render( $post ): void {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'xep_cpt_meta_box', 'xep_cpt_meta_box_nonce' );

    $sample = get_post_meta( $post->ID, '_sample', true );

    ?>
      <div class="xe-plugin-field">
        <div class="xe-plugin-label">
          <label for="sample"><?php echo esc_html__( 'Serial No:', 'xe-plugin' ); ?></label>
        </div>
        <div class="xe-plugin-input">
          <input type="text" name="sample" id="sample" value="<?php echo esc_attr( $sample ); ?>" required>
        </div>
      </div>
    <?php

  }

  /**
   * Save the meta box selections.
   */
  public function save( int $post_id ) {

    $verify_save = Utils::verify_save(
      'xep_cpt_meta_box',
      'xep_cpt_meta_box_nonce',
      $this->post_type(),
      $post_id
    );

    if ( $verify_save == false ) {
      return $post_id;
    }

    // Saving or Updating the data
    Utils::update_field( $post_id, 'sample', false, 'text', '_sample' ); // $post_id, $name, $is_array, $validation, $meta_key, $delete = false

  }

}
