<?php
/**
 * Console
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI;

class Console {

  /**
   * Registered commands
   *
   * @var array
   */
  protected array $commands = [
    'init'        => Commands\Init::class,
    'build'       => Commands\Build::class,
    'docs'        => Commands\Docs::class,
    'make:table'  => Commands\MakeTable::class,
    'make:module' => Commands\MakeModule::class,
  ];

  /**
   * Run console
   *
   * @param array $argv Command arguments.
   *
   * @return void
   */
  public function run( array $argv ): void {

    $command = $argv[1] ?? null;

    if ( empty( $command ) ) {

      $this->help();

      return;

    }

    if ( ! isset( $this->commands[ $command ] ) ) {

      echo "Command not found.\n";

      return;

    }

    $handler = new $this->commands[ $command ]();

    $handler->handle( $argv );

  }

  /**
   * Display help
   *
   * @return void
   */
  protected function help(): void {

    echo "Xe Plugin CLI\n\n";

    echo "Available commands:\n";

    foreach ( $this->commands as $command => $class ) {

      echo "  {$command}\n";

    }

  }

}
