<?php 
/**
 * Class for adding custom post types.
 *
 * @package Xe Plugin
 */

if (!class_exists('Xe_Plugin_CustomPostTypes')) :

class Xe_Plugin_CustomPostTypes {

  function __construct() {

    add_action( 'init', array($this, 'custom_post_types') );
    register_activation_hook( __FILE__, array($this, 'rewrite_flush') );

  }

  protected function portfolio() {

    $labels = array(
      'name'               => 'Portfolio',
      'singular_name'      => 'Portfolio',
      'menu_name'          => 'Portfolio',
      'name_admin_bar'     => 'Portfolio',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Portfolio',
      'new_item'           => 'New Portfolio',
      'edit_item'          => 'Edit Portfolio',
      'view_item'          => 'View Portfolio',
      'all_items'          => 'All Portfolios',
      'search_items'       => 'Search Portfolios',
      'parent_item_colon'  => 'Parent Portfolios:',
      'not_found'          => 'No Portfolios found.',
      'not_found_in_trash' => 'No Portfolios found in Trash.',
    );
    
    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'menu_icon'          => 'dashicons-portfolio',
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'xe-portfolio' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
    );
    return register_post_type( 'xe-portfolio', $args );

  }

  public function custom_post_types() {

  	$this->portfolio();

  }

  public function rewrite_flush() {

    $this->custom_post_types();
    flush_rewrite_rules();

  }

}
new Xe_Plugin_CustomPostTypes();

endif;