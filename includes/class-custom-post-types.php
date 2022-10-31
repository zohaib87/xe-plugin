<?php
/**
 * Class for adding custom post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @package Xe Plugin
 */

if (!class_exists('Xe_Plugin_CustomPostTypes')) {

  class Xe_Plugin_CustomPostTypes {

    function __construct() {

      add_action( 'init', array($this, 'custom_post_types') );
      register_activation_hook( __FILE__, array($this, 'rewrite_flush') );

    }

    protected function sample() {

      $labels = array(
        'name'               => 'Samples',
        'singular_name'      => 'Sample',
        'menu_name'          => 'Samples',
        'name_admin_bar'     => 'Sample',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Sample',
        'new_item'           => 'New Sample',
        'edit_item'          => 'Edit Sample',
        'view_item'          => 'View Sample',
        'all_items'          => 'All Samples',
        'search_items'       => 'Search Samples',
        'parent_item_colon'  => 'Parent Samples:',
        'not_found'          => 'No Samples found.',
        'not_found_in_trash' => 'No Samples found in Trash.',
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

    public function custom_post_types() {

      $this->sample();

    }

    public function rewrite_flush() {

      $this->custom_post_types();
      flush_rewrite_rules();

    }

  }
  new Xe_Plugin_CustomPostTypes();

}
