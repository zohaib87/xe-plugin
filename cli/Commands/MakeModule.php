<?php
/**
 * Make module command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

class MakeModule {

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

      echo "Module name required.\n";

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

    $module_name = strtolower( $name );

    $label = str_replace(
      '_',
      ' ',
      $module_name
    );

    $stub = file_get_contents(
      dirname( __DIR__, 2 ) . '/stubs/MakeModule.stub'
    );

    $stub = str_replace(
      [
        '{{label}}',
        '{{class}}',
        '{{module_name}}',
      ],
      [
        $label,
        $class,
        $module_name,
      ],
      $stub
    );

    $path = dirname( __DIR__, 2 ) . '/src/Modules/' . $class . '.php';

    if ( file_exists( $path ) ) {

      echo "Module already exists.\n";

      return;

    }

    file_put_contents( $path, $stub );

    exec( 'composer dump-autoload' );

    echo "Module created successfully.\n";

  }

}
