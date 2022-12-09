<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_sprtr extends Widget_Base
{
    public function get_name()
    {
        return 'tb_sprtr';
    }

    public function get_title()
    {
        return esc_html__('Separator', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-drumstick';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_process_1',
            [
                'label' => esc_html__('Content', 'thepack'),
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Template', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'thepack'),
                        'icon' => 'fa fa-folder',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'thepack'),
                        'icon' => 'fa fa-folder-o',
                    ],
                    'three' => [
                        'title' => esc_html__('Three', 'thepack'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'txt',
            [
                'label' => esc_html__('Text', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Heading',
            ]
        );

        $this->add_control(
            'icn',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img',
            [
                'label' => esc_html__('Image', 'thepack'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'i_pad',
            [
                'label' => esc_html__('Inner padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bdr_wid',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xld-sep-lne' => 'border-top-width: {{SIZE}}{{UNIT}};border-style:sloid;',
                ],
            ]
        );

        $this->add_responsive_control(
            'i_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xld-sep-lne' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('Text', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'q_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .heading',
            ]
        );

        $this->add_responsive_control(
            'h_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Image', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'imwid',
            [
                'label' => esc_html__('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .heading img' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'brad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .heading img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_sprtr());
