<?php
/**
 * Make elementor widget command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

class MakeElementor {

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

      echo "Widget name required.\n";

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

    $widget_name = strtolower( $name );

    $label = str_replace(
      '_',
      ' ',
      ucfirst( $widget_name )
    );

    $stub = file_get_contents(
      dirname( __DIR__, 2 ) . '/stubs/MakeElementor.stub'
    );

    $stub = str_replace(
      [
        '{{label}}',
        '{{class}}',
        '{{widget_name}}',
      ],
      [
        $label,
        $class,
        $widget_name,
      ],
      $stub
    );

    $path = dirname( __DIR__, 2 ) . '/src/Elementor/' . $class . '.php';

    if ( file_exists( $path ) ) {

      echo "Widget already exists.\n";

      return;

    }

    file_put_contents( $path, $stub );

    exec( 'composer dump-autoload' );

    echo "Widget created successfully.\n";

  }

}
