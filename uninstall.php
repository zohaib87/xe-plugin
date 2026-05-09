<?php
/**
 * Xe Plugin Uninstall
 *
 * Uninstalling Xe Plugin deletes user roles, pages, tables, and options.
 *
 * @package Xe Plugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

// global $wpdb;

// $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('xep-sales', 'xep-frames', 'xep-glasses', 'xep-w-customers')");
// $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM {$wpdb->posts})");

// $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'xep-glasses-cat'");

// $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('xep_company', 'xep_contactno', 'xep_address', 'xep_city', 'xep_postalcode')");

// $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'xep_options'");

// if ( is_multisite() ) {

// 	$sites = get_sites();

// 	foreach ( $sites as $site ) {

// 		switch_to_blog( $site->blog_id );

// 		$table_name = $wpdb->prefix . 'city_customers';
// 		$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

// 		restore_current_blog();

// 	}

// } else {

// 	$table_name = $wpdb->prefix . 'city_customers';
// 	$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

// }
