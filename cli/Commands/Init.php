<?php
/**
 * Init command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

use XePlugin\CLI\Config;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class Init {

  /**
   * Handle command
   *
   * @param array $argv Arguments.
   *
   * @return void
   */
  public function handle( array $argv ): void {

    $config = new Config();

    $name = $config->get( 'name' );

    $name_lower       = strtolower( $name );
    $name_upper       = strtoupper( $name );
    $name_hyphen      = str_replace( ' ', '-', $name_lower );
    $name_underscores = str_replace( ' ', '_', $name_lower );

    $replacements = [
      "'xe-plugin'"            => "'" . $name_hyphen . "'",
      '_xe_plugin'             => $name_underscores,
      'Text Domain: xe-plugin' => 'Text Domain: ' . $name_hyphen,
      ' Xe Plugin'             => ' ' . $name,
      'xe-plugin-'             => $name_hyphen . '-',
      'Xe_Plugin'              => str_replace( ' ', '', $name ),
      'XE_PLUGIN_'             => str_replace( ' ', '_', $name_upper ) . '_',
      'xePlugin'               => $config->get( 'jsObject' ),
      'xep-'                   => $config->get( 'endpointsKeyPrefix' ) . '-',
    ];

    $current_plugin = dirname( __DIR__, 2 );

    $iterator = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator( $current_plugin )
    );

    foreach ( $iterator as $file ) {

      if ( $file->isDir() ) {
        continue;
      }

      $path = str_replace( '\\', '/', $file->getPathname() );

      // Ignore folders
      if (
        str_contains( $path, '/vendor/' ) ||
        str_contains( $path, '/node_modules/' ) ||
        str_contains( $path, '/node_scripts/' ) ||
        str_contains( $path, '/cli/' )
      ) {
        continue;
      }

      $extension = pathinfo( $path, PATHINFO_EXTENSION );

      $allowed = [
        'php',
        'js',
        'css',
        'txt',
        'json',
        'stub',
      ];

      if ( ! in_array( $extension, $allowed, true ) ) {
        continue;
      }

      $contents = file_get_contents( $path );

      $contents = str_replace(
        array_keys( $replacements ),
        array_values( $replacements ),
        $contents
      );

      file_put_contents( $path, $contents );

      echo "Updated: {$path}\n";

    }

    echo "Plugin identifiers updated.\n";

    // Rename main plugin file
    $old_file = $current_plugin . '/xe-plugin.php';
    $new_file = $current_plugin . '/' . $name_hyphen . '.php';

    if ( file_exists( $old_file ) ) {

      rename( $old_file, $new_file );

      echo "Plugin file renamed.\n";

    }

    passthru( 'composer dump-autoload', $result_code );

    echo "Plugin initialization completed successfully.\n";

  }

}
