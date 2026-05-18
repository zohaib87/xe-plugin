<?php
/**
 * Build command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

use XePlugin\CLI\Config;

class Build {

  /**
   * Handle command
   *
   * @param array $argv Command arguments.
   *
   * @return void
   */
  public function handle( array $argv ): void {

    $config = new Config();

    $name = $config->get( 'name' );

    $name_lower  = strtolower( $name );
    $name_hyphen = str_replace( ' ', '-', $name_lower );

    $target_url = rtrim(
      $config->get( 'build' ),
      '/\\'
    ) . '/' . $name_hyphen;

    $current_plugin = dirname( __DIR__, 2 );

    echo "Preparing build...\n";

    // Remove old build.
    if ( file_exists( $target_url ) ) {

      $this->remove_directory( $target_url );

      echo "Old build removed successfully.\n";

    }

    // Copy plugin.
    $this->copy_directory( $current_plugin, $target_url );

    echo "Plugin copied successfully.\n";

    // Generate POT.
    $this->generate_pot( $target_url, $name_hyphen );

    echo "Build completed successfully.\n";

  }

  /**
   * Copy directory recursively
   *
   * @param string $source Source path.
   * @param string $destination Destination path.
   *
   * @return void
   */
  protected function copy_directory( string $source, string $destination ): void {

    $exclude_extensions = [
      'psd',
      'settings',
    ];

    $exclude_files = [
      '.gitignore',
      'package.json',
      'package-lock.json',
      'composer.json',
      'composer.lock',
      'sftp-config.json',
      'README.md',
      'LICENSE.md',
    ];

    $exclude_directories = [
      '.git',
      '.github',
      '.vscode',
      'node_modules',
      'node_scripts',
      'cli',
      'vendor',
    ];

    if ( ! is_dir( $destination ) ) {

      mkdir( $destination, 0755, true );

    }

    $items = scandir( $source );

    foreach ( $items as $item ) {

      if ( '.' === $item || '..' === $item ) {
        continue;
      }

      $source_path = $source . DIRECTORY_SEPARATOR . $item;
      $destination_path = $destination . DIRECTORY_SEPARATOR . $item;

      // Ignore symlinks.
      if ( is_link( $source_path ) ) {
        continue;
      }

      // Ignore directories.
      if (
        is_dir( $source_path ) &&
        in_array(
          $item,
          $exclude_directories,
          true
        )
      ) {
        continue;
      }

      // Ignore files.
      if (
        is_file( $source_path ) &&
        in_array(
          $item,
          $exclude_files,
          true
        )
      ) {
        continue;
      }

      // Ignore extensions.
      $extension = pathinfo(
        $source_path,
        PATHINFO_EXTENSION
      );

      if (
        is_file( $source_path ) &&
        in_array(
          $extension,
          $exclude_extensions,
          true
        )
      ) {
        continue;
      }

      // Copy directories recursively.
      if ( is_dir( $source_path ) ) {

        $this->copy_directory(
          $source_path,
          $destination_path
        );

      }
      else {

        copy(
          $source_path,
          $destination_path
        );

      }

    }

  }

  /**
   * Remove directory recursively
   *
   * @param string $directory Directory path.
   *
   * @return void
   */
  protected function remove_directory( string $directory ): void {

    $items = scandir( $directory );

    foreach ( $items as $item ) {

      if ( '.' === $item || '..' === $item ) {
        continue;
      }

      $path = $directory . DIRECTORY_SEPARATOR . $item;

      if ( is_dir( $path ) ) {

        $this->remove_directory( $path );

      }
      else {

        unlink( $path );

      }

    }

    rmdir( $directory );

  }

  /**
   * Generate POT file
   *
   * @param string $target_url Target URL.
   * @param string $name_hyphen Plugin slug.
   *
   * @return void
   */
  protected function generate_pot( string $target_url, string $name_hyphen ): void {

    echo "Generating translation file...\n";

    $command = sprintf(
      'wp i18n make-pot "%s" "%s/languages/%s.pot" --exclude=node_modules,vendor,assets,cli,stubs,.github,.git,.vscode',
      $target_url,
      $target_url,
      $name_hyphen
    );

    exec( $command, $output, $result_code );

    if ( 0 === $result_code ) {

      echo "Translation file generated successfully.\n";

    } else {

      echo "Failed to generate translation file.\n";

    }

  }

}
