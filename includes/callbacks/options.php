<?php
/**
 * Callback function for Options menu page.
 *
 * @package Xe Plugin
 */

use Helpers\Xe_Plugin_Views as View;

function _xe_plugin_options() {

  global $xep_opt;

  ?>
    <div class="wrap">
      <h1><?php echo esc_html__('Plugin Options', 'xe-plugin'); ?></h1>

      <?php
        settings_errors();
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
      ?>

      <h2 class="nav-tab-wrapper">
        <?php
          View::pluginOptionTabs([
            array( esc_html__('General Options', 'xe-plugin'), 'general', $active_tab )
          ]);
        ?>
      </h2>

      <form method="post" action="options.php" enctype="multipart/form-data">

        <?php
          // settings_fields('xep_options');
          // do_settings_sections('xep_options');
        ?>

        <!-- # General Tab -->
        <table class="form-table" role="presentation" style="<?php echo ($active_tab !== 'general') ? 'display: none;' : ''; ?>">
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

        <?php submit_button(); ?>
      </form>
    </div>
  <?php

}

/**
 * Register settings
 */
function _xe_plugin_register_options() {

  // $options = [
  //   'xep_sample',
  // ];
  // foreach ($options as $option) {
  //   register_setting('xep_options', $option);
  // }

}
add_action('admin_init', '_xe_plugin_register_options');
