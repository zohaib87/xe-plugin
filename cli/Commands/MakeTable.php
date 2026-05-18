<?php
/**
 * Make table command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

class MakeTable {

  /**
   * Handle command
   *
   * @param array $argv Command arguments.
   *
   * @return void
   */
  public function handle( array $argv ): void {

    $name = $argv[2] ?? null;

    if ( empty( $name ) ) {

      echo "Table name required.\n";

      return;

    }

    $class = str_replace(
      ' ',
      '',
      ucwords(
        str_replace(
          [ '-', '_' ],
          ' ',
          $name
        )
      )
    );

    $table_name = strtolower( $name );

    $label = str_replace(
      '_',
      ' ',
      $table_name
    );

    $stub = file_get_contents(
      dirname( __DIR__, 2 ) . '/stubs/MakeTable.stub'
    );

    $stub = str_replace(
      [
        '{{label}}',
        '{{class}}',
        '{{table_name}}',
      ],
      [
        $label,
        $class,
        $table_name,
      ],
      $stub
    );

    $path = dirname( __DIR__, 2 ) . '/src/Database/Tables/' . $class . '.php';

    if ( file_exists( $path ) ) {

      echo "Table already exists.\n";

      return;

    }

    file_put_contents( $path, $stub );

    exec( 'composer dump-autoload' );

    echo "Table created successfully.\n";

  }

}
