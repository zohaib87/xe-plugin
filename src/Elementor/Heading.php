<?php
/**
 * Heading elementor widget.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin\Elementor;

class Heading extends \Elementor\Widget_Base {

  /**
   * Get widget name.
   */
  public function get_name() {

    return 'heading';

  }

  /**
   * Get widget title.
   */
  public function get_title() {

    return esc_html__( 'Heading', 'xe-plugin' );

  }

  /**
   * Get widget icon.
   */
  public function get_icon() {

    return 'fas fa-heading';

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
      'heading', [
        'label' => esc_html__('Heading', 'xe-plugin'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'text',
        'default' => esc_html__('Our Services', 'xe-plugin'),
      ]
    );
    $this->add_control(
      'sub_heading', [
        'label' => esc_html__('Sub Heading', 'xe-plugin'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'text',
        'default' => esc_html__('Providing our clients with high-quality website hosting for the lowest price is our top priority.', 'xe-plugin'),
      ]
    );

    $this->end_controls_section();

    /**
     * Style Section
     */
    $this->start_controls_section(
      'style_section', [
        'label' => esc_html__( 'Style', 'xe-plugin' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // Controls
    $this->add_control(
      'heading_color', [
        'label' => esc_html__( 'Heading Color', 'xe-plugin' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Core\Schemes\Color::get_type(),
          'value' => \Elementor\Core\Schemes\Color::COLOR_1,
        ],
        'default' => '#000',
      ]
    );
    $this->add_control(
      'sub_heading_color', [
        'label' => esc_html__( 'Sub Heading Color', 'xe-plugin' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'scheme' => [
          'type' => \Elementor\Core\Schemes\Color::get_type(),
          'value' => \Elementor\Core\Schemes\Color::COLOR_1,
        ],
        'default' => '#000',
      ]
    );

    $this->end_controls_section();

  }

  /**
   * Render widget output on the frontend.
   */
  protected function render() {

    $settings = $this->get_settings_for_display();

    $heading = $settings['heading'];
    $sub_heading = $settings['sub_heading'];
    $heading_color = $settings['heading_color'];
    $sub_heading_color = $settings['sub_heading_color'];

    $args = [
      'br' => array()
    ];

    ?>
      <div class="sec-title centered">
        <h2 style="color: <?php echo esc_attr( $heading_color ); ?>;">
          <?php echo wp_kses( $heading, $args ); ?>
        </h2>
        <div class="text" style="color: <?php echo esc_attr( $sub_heading_color ); ?>;"><?php echo esc_html( $sub_heading ); ?></div>
      </div>
    <?php

  }

  /**
   * Render widget output in the editor.
   */
  protected function _content_template() {}

}
