<?php
/**
 * Main page for templates
 *
 * @package Xe Plugin
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$filename = _xe_plugin()->endpoints()->get_slug();

/**
 * Report page
 */
if ( strpos( $filename, 'reports/' ) !== false ) {

  load_template( _xe_plugin()->path( 'templates/' . $filename . '.php' ) );

/**
 * Add new or edit page
 */
} elseif ( isset( $_GET['add-new'] ) || isset( $_GET['edit'] ) ) {

  load_template( _xe_plugin()->path( 'templates/single/' . $filename . '.php' ) );

/**
 * List page
 */
} else {

  load_template( _xe_plugin()->path( 'templates/archive/' . $filename . '.php' ) );

}
