<?php
/**
 * Class for adding custom post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

class Custom_Post_Types {

  function __construct() {

    add_action( 'init', array($this, 'register') );
    register_activation_hook( __FILE__, array($this, 'rewrite_flush') );

  }

  protected function sample() {

    $labels = array(
      'name'               => esc_html__('Samples', 'xe-plugin'),
      'singular_name'      => esc_html__('Sample', 'xe-plugin'),
      'menu_name'          => esc_html__('Samples', 'xe-plugin'),
      'name_admin_bar'     => esc_html__('Sample', 'xe-plugin'),
      'add_new'            => esc_html__('Add New', 'xe-plugin'),
      'add_new_item'       => esc_html__('Add New Sample', 'xe-plugin'),
      'new_item'           => esc_html__('New Sample', 'xe-plugin'),
      'edit_item'          => esc_html__('Edit Sample', 'xe-plugin'),
      'view_item'          => esc_html__('View Sample', 'xe-plugin'),
      'all_items'          => esc_html__('All Samples', 'xe-plugin'),
      'search_items'       => esc_html__('Search Samples', 'xe-plugin'),
      'parent_item_colon'  => esc_html__('Parent Samples:', 'xe-plugin'),
      'not_found'          => esc_html__('No Samples found.', 'xe-plugin'),
      'not_found_in_trash' => esc_html__('No Samples found in Trash.', 'xe-plugin'),
    );

    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => false,
      'menu_icon'          => 'dashicons-portfolio',
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'xe-plugin-cpt' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
    );
    return register_post_type( 'xe-plugin-cpt', $args );

  }

  public function register() {

    $this->sample();

  }

  public function rewrite_flush() {

    $this->register();
    flush_rewrite_rules();

  }

}
new Custom_Post_Types();
