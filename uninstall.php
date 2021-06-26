<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

$option_name = 'custom_option';
 
delete_option($option_name);
delete_site_option($option_name); // for site options in Multisite

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}custom_table");
