<?php
/**
 * Action hooks of reusable sections for admin.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Admin;

class Views {

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {}

  /**
   * Register the hooks and filters.
   *
   * @return void
   */
  public function register(): void {

    add_action( '_xe_plugin_options_page_tabs', [ $this, 'options_page_tabs' ], 10, 1 );
    add_action( '_xe_plugin_options_page_tab', [ $this, 'options_page_tab' ], 10, 3 );

  }

  /**
   * Tabs for plugin options page
   *
   * @param array $tabs Array of tabs.
   *
   * @return void
   */
  public function options_page_tabs( $tabs ): void {

    foreach ( $tabs as $tab ) {

      $title = $tab[0];
      $tab_slug = $tab[1];
      $active_tab = $tab[2];

      ?>
        <a href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo esc_attr( $tab_slug ); ?>" class="nav-tab <?php echo ( $active_tab == $tab_slug ) ? 'nav-tab-active' : ''; ?>"><?php echo esc_html( $title ); ?></a>
      <?php

    }

  }

  /**
   * Tab for plugin options page
   *
   * @param string    $tab_slug   Tab slug
   * @param string    $active_tab Active tab slug
   * @param callable  $content    Tab content
   *
   * @return void
   */
  public function options_page_tab( $tab_slug, $active_tab, $content ): void {

    ?>
      <table class="form-table" role="presentation" style="<?php echo ( $active_tab !== $tab_slug ) ? 'display: none;' : ''; ?>">
        <tbody>
          <?php call_user_func( $content ); ?>
        </tbody>
      </table>
    <?php

  }

}
