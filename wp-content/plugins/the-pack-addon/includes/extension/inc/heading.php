<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Heading_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/heading/section_title_style/after_section_end', [
            __CLASS__,
            'extra_controll'
        ], 10, 2);
    }

    public static function extra_controll($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => __('Extra style', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'dispinly',
            [
                'label' => esc_html__('Display inline', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'display: inline-block;',
                ],
            ]
        );

        $element->add_control(
            'vert',
            [
                'label' => esc_html__('Vertical text', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'writing-mode: vertical-lr;text-orientation: upright;',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tbxdw',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Box shadow', 'thepack'),
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tbdrkl',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Border', 'thepack'),
            ]
        );

        $element->add_responsive_control(
            'tbradr',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'tpagd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'twid',
            [
                'label' => esc_html__('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'thit',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'height: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'clipbg',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
                'label' => esc_html__('Background', 'thepack'),
            ]
        );

        $element->add_control(
            'clips',
            [
                'label' => esc_html__('Background clip', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => '-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Heading_Extra_Control::init();
