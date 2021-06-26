<?php 
/**
 * Custom Fields functions and extensions.
 *
 * @package Xe Plugin
 */

if (!class_exists('Xe_Plugin_CustomFields')) :

class Xe_Plugin_CustomFields {

	function __construct() {

		add_filter('acf/settings/save_json', array($this, 'json_save_point'));
		add_filter('acf/settings/load_json', array($this, 'json_load_point'));
		if (WP_DEBUG == false) add_filter('acf/settings/show_admin', '__return_false');

	}

	/**
	 * Save data in json.
	 */
	public function json_save_point($path) {

		$path = _xe_plugin_directory() . '/models/custom-fields';
		return $path;

	}

	/**
	 * Load data from json
	 */
	public function json_load_point($paths) {

		unset($paths[0]);
		$paths[] = _xe_plugin_directory() . '/custom-fields';

		return $paths;

	}

}
new Xe_Plugin_CustomFields();

endif;