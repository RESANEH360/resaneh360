<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_before_after extends Widget_Base
{
    public function get_name()
    {
        return 'tp-beforeafter';
    }

    public function get_title()
    {
        return esc_html__('Before after', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-post';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Slides', 'thepack'),
            ]
        );

        $this->add_control(
            'img1',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Before image', 'thepack'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'lbl1',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Before Label', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('After image', 'thepack'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'lbl2',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('After Label', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Image size', 'thepack'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('Label', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'lbpd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'lbbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'lbbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lbclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lbdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lbtyp',
                'selector' => '{{WRAPPER}} .beer-slider[data-beer-label]:after,{{WRAPPER}} .beer-reveal[data-beer-label]:after',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hndl',
            [
                'label' => esc_html__('Handle', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hdclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-handle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hdbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-handle' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hdbgk',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .beer-handle' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hdbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .beer-handle' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hdwh',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .beer-handle' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        include dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_before_after());
