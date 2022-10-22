<?php
/**
 * Callback function for Options menu page.
 *
 * @package Xe Plugin
 */

function _xe_plugin_options() {

  global $xep_opt;

  ?>
    <div class="wrap">
      <h1><?php echo esc_html('Plugin Options', 'xe-plugin'); ?></h1>

      <?php
        settings_errors();
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
      ?>

      <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo $_GET['page']; ?>&tab=general" class="nav-tab <?php echo ($active_tab == 'general') ? 'nav-tab-active' : ''; ?>">General Options</a>
      </h2>

      <form method="post" action="options.php" enctype="multipart/form-data">

        <?php
          /*--------------------------------------------------------------
          # General Tab
          --------------------------------------------------------------*/
          if ($active_tab === 'general') {

            // settings_fields('xep-general');
            // do_settings_sections('xep-general');

            ?>
              <table class="form-table" role="presentation">
                <tbody>
                  <!-- Sample -->
                  <tr>
                    <th scope="row">
                      <label for="xep_sample"><?php echo esc_html__('Sample', 'xe-plugin'); ?></label>
                    </th>
                    <td>
                      <input type="text" name="xep_sample" id="xep_sample" value="<?php //echo esc_attr($xep_opt->sample); ?>">
                    </td>
                  </tr>
                </tbody>
              </table>
            <?php
          }
        ?>
      </form>
    </div>
  <?php

}

/**
 * Register settings
 */
function _xe_plugin_register_options() {

  // $general_options = [
  //   'xep_sample',
  // ];
  // foreach ($general_options as $option) {
  //   register_setting('xep-general', $option);
  // }

}
add_action('admin_init', '_xe_plugin_register_options');
