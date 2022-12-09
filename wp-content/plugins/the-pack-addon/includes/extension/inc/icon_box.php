<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Iconbox_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/icon-box/section_style_content/after_section_end', [
            __CLASS__,
            'tp_icon_box_extra'
        ], 10, 2);
    }

    public static function tp_icon_box_extra($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => __('Extra style', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .elementor-icon',
                'label' => esc_html__('Box shadow', 'thepack'),
            ]
        );

        $element->add_control(
            'ibdclr',
            [
                'label' => esc_html__('Icon border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            't-mrg',
            [
                'label' => esc_html__('Title margin', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Iconbox_Extra_Control::init();
