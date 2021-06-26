<?php 
/**
 * Class for adding custom taxonomies.
 *
 * @package Xe Plugin
 */

if (!class_exists('Xe_Plugin_CustomTaxonomies')) :

class Xe_Plugin_CustomTaxonomies {

  function __construct() {

  	add_action( 'init', array($this, 'register_taxonomies'), 0 );

  }

  protected function portfolio_categories() {
	
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
      'rewrite'           => array( 'slug' => 'xe-portfolio-categories' ),
    );

    return $args;

	}

	public function register_taxonomies() {
 
		register_taxonomy( 'xe-portfolio-categories', array('xe-portfolio'), $this->portfolio_categories() );

	}

}
new Xe_Plugin_CustomTaxonomies();

endif;