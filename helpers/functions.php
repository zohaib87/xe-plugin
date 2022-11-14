<?php
/**
 * Functions that helps to ease plugin development.
 *
 * @package Xe Plugin
 */

function _xe_plugin_directory() {
	return ABSPATH . 'wp-content/plugins/xe-plugin';
}

function _xe_plugin_directory_uri() {
	return plugins_url() . '/xe-plugin';
}

function _xe_plugin_file() {
	return _xe_plugin_directory() . '/xe-plugin.php';
}

function _xe_plugin_data() {
	return get_plugin_data( _xe_plugin_file() );
}
