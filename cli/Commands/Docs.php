<?php
/**
 * Docs command
 *
 * @package Xe Plugin
 */

namespace XePlugin\CLI\Commands;

class Docs {

  /**
   * Handle command
   *
   * @return void
   */
  public function handle(): void {

    echo "Deploying documentation...\n";

    passthru( 'mkdocs gh-deploy --force' );

    echo "Documentation deployed successfully.\n";

  }

}
