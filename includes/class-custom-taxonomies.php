<?php
/**
 * Class for adding custom taxonomies.
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Includes;

class Custom_Taxonomies {

  function __construct() {

    add_action( 'init', array($this, 'register'), 0 );

  }

  protected function sample_categories() {

    $labels = array(
      'name'              => esc_html__('Categories', 'xe-plugin'),
      'singular_name'     => esc_html__('Category', 'xe-plugin'),
      'search_items'      => esc_html__('Search Categories', 'xe-plugin'),
      'all_items'         => esc_html__('All Categories', 'xe-plugin'),
      'parent_item'       => esc_html__('Parent Category', 'xe-plugin'),
      'parent_item_colon' => esc_html__('Parent Category:', 'xe-plugin'),
      'edit_item'         => esc_html__('Edit Category', 'xe-plugin'),
      'update_item'       => esc_html__('Update Category', 'xe-plugin'),
      'add_new_item'      => esc_html__('Add New Category', 'xe-plugin'),
      'new_item_name'     => esc_html__('New Category Name', 'xe-plugin'),
      'menu_name'         => esc_html__('Categories', 'xe-plugin'),
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
      'name'              => esc_html__('Tags', 'xe-plugin'),
      'singular_name'     => esc_html__('Tag', 'xe-plugin'),
      'search_items'      => esc_html__('Search Tags', 'xe-plugin'),
      'all_items'         => esc_html__('All Tags', 'xe-plugin'),
      'parent_item'       => esc_html__('Parent Tag', 'xe-plugin'),
      'parent_item_colon' => esc_html__('Parent Tag:', 'xe-plugin'),
      'edit_item'         => esc_html__('Edit Tag', 'xe-plugin'),
      'update_item'       => esc_html__('Update Tag', 'xe-plugin'),
      'add_new_item'      => esc_html__('Add New Tag', 'xe-plugin'),
      'new_item_name'     => esc_html__('New Tag Name', 'xe-plugin'),
      'menu_name'         => esc_html__('Tags', 'xe-plugin'),
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

  public function register() {

    register_taxonomy( 'xe-plugin-cat', array('xe-plugin-cpt'), $this->sample_categories() );
    register_taxonomy( 'xe-plugin-tag', array('xe-plugin-cpt'), $this->sample_tags() );

  }

}
new Custom_Taxonomies();
