<?php
/**
 * Functions of reusable sections.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Helpers;

class Views {

  /**
   * # Tabs for Plugin Options
   */
  public static function plugin_option_tabs($tabs) {

    foreach ($tabs as $tab) {

      $title = $tab[0];
      $param = $tab[1];
      $active_tab = $tab[2];

      ?>
        <a href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo esc_attr($param); ?>" class="nav-tab <?php echo ($active_tab == $param) ? 'nav-tab-active' : ''; ?>"><?php echo esc_html($title); ?></a>
      <?php

    }

  }

}
