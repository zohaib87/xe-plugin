<?php
/**
 * Callback function for Options menu page.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Admin;

class OptionsPage {

  /**
   * Property to hold the plugin options
   */
  private $options;

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {

    $this->options = _xe_plugin()->options();

  }

  /**
   * Register the hooks and filters.
   *
   * @return void
   */
  public function register(): void {

    add_action( 'admin_init', [ $this, 'register_settings' ] );

  }

  /**
   * Register the plugin settings.
   *
   * @return void
   */
  public function register_settings(): void {

    register_setting(
      '_xe_plugin_options', // Settings group
      '_xe_plugin_options', // Option name in DB
      [
        'sanitize_callback' => [ $this, 'sanitize_options' ],
      ]
    );

  }

  /**
   * Sanitize plugin options before saving to the database.
   *
   * @param array $options Array of options to sanitize.
   *
   * @return array Sanitized array of options.
   */
  public function sanitize_options( array $options ): array {

    foreach ( $options as $key => $value ) {

      $options[ $key ] = sanitize_text_field( $value );

    }

    return $options;

  }

  /**
   * Render the plugin options page.
   *
   * @return void
   */
  public function render(): void {

    ?>
      <div class="wrap">
        <h1><?php echo esc_html__( 'Plugin Options', 'xe-plugin' ); ?></h1>

        <?php
          settings_errors();
          $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
        ?>

        <h2 class="nav-tab-wrapper">
          <?php
            do_action( '_xe_plugin_options_page_tabs', [
              [ esc_html__( 'General Options', 'xe-plugin' ), 'general', $active_tab ]
            ] );
          ?>
        </h2>

        <form method="post" action="options.php" enctype="multipart/form-data">

          <?php
            settings_fields( '_xe_plugin_options' );
            do_settings_sections( '_xe_plugin_options' );

            do_action( '_xe_plugin_options_page_tab', 'general', $active_tab, [ $this, 'general_tab' ] );

            submit_button();
          ?>

        </form>
      </div>
    <?php

  }

  /**
   * Render the General tab.
   *
   * @return void
   */
  public function general_tab() {

    ?>
      <!-- Sample -->
      <tr>
        <th scope="row">
          <label for="sample"><?php echo esc_html__( 'Sample', 'xe-plugin' ); ?></label>
        </th>
        <td>
          <input type="text" name="_xe_plugin_options[sample]" id="sample" value="<?php echo esc_attr( $this->options->get( 'sample' ) ); ?>">
        </td>
      </tr>
    <?php

  }

}
