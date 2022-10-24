<?php
/**
 * Class for adding custom taxonomies.
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @package Xe Plugin
 */

if (!class_exists('Xe_Plugin_CustomTaxonomies')) {

  class Xe_Plugin_CustomTaxonomies {

    function __construct() {

      add_action( 'init', array($this, 'register_taxonomies'), 0 );

    }

    protected function sample_categories() {

      $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
      );

      $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'xe-plugin-cat' ),
      );

      return $args;

    }

    protected function sample_tags() {

      $labels = array(
        'name'              => 'Tags',
        'singular_name'     => 'Tag',
        'search_items'      => 'Search Tags',
        'all_items'         => 'All Tags',
        'parent_item'       => 'Parent Tag',
        'parent_item_colon' => 'Parent Tag:',
        'edit_item'         => 'Edit Tag',
        'update_item'       => 'Update Tag',
        'add_new_item'      => 'Add New Tag',
        'new_item_name'     => 'New Tag Name',
        'menu_name'         => 'Tags',
      );

      $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'xe-plugin-tag' ),
      );

      return $args;

    }

    public function register_taxonomies() {

      register_taxonomy( 'xe-plugin-cat', array('xe-plugin-cpt'), $this->sample_categories() );
      register_taxonomy( 'xe-plugin-tag', array('xe-plugin-cpt'), $this->sample_tags() );

    }

  }
  new Xe_Plugin_CustomTaxonomies();

}
