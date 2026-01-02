<?php
/**
 * Button elementor widget.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Elementor;

class Button extends \Elementor\Widget_Base {

  /**
   * Get widget name.
   */
  public function get_name() {

    return 'button';

  }

  /**
   * Get widget title.
   */
  public function get_title() {

    return esc_html__( 'Button', 'xe-plugin' );

  }

  /**
   * Get widget icon.
   */
  public function get_icon() {

    return 'fas fa-mouse-pointer';

  }

  /**
   * Get widget categories to put this widget in.
   */
  public function get_categories() {

    return ['_xe_plugin'];

  }

  /**
   * Register widget controls.
   */
  protected function register_controls() {

    $this->start_controls_section(
      'content_section', [
        'label' => esc_html__( 'Content', 'xe-plugin' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    // Controls
    $this->add_control(
      'btn_text', [
        'label' => esc_html__( 'Text', 'xe-plugin' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'text',
        'default' => esc_html__('View Plans', 'xe-plugin'),
      ]
    );
    $this->add_control(
      'btn_link', [
        'label' => esc_html__( 'Link', 'xe-plugin' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'text',
        'default' => '#.',
      ]
    );

    $this->end_controls_section();

  }

  /**
   * Render widget output on the frontend.
   */
  protected function render() {

    $settings = $this->get_settings_for_display();

    $btn_text = $settings['btn_text'];
    $btn_link = $settings['btn_link'];

    ?>
      <a href="<?php echo esc_url( $btn_link ); ?>" class="theme-btn btn-style-three"><?php echo esc_html( $btn_text ); ?> <i class="fas fa-chevrson-right"></i></a>
    <?php

  }

  /**
   * Render widget output in the editor.
   */
  protected function _content_template() {}

}
