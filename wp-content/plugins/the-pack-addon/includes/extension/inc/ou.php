<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Overlay_Underlay
{
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'add_section']);
        add_action('elementor/element/after_add_attributes', [__CLASS__, 'add_attributes']);

        add_action('elementor/element/button/section_style/after_section_end', [
            __CLASS__,
            'ob_butterbutton_panel'
        ], 10, 2);
    }

    public static function ob_butterbutton_panel($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => 'Button extra',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'fgi',
            [
                'label' => esc_html__('Inherit flex grow', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-wrapper .elementor-button-text' => 'flex-grow:inherit;',
                ],
            ]
        );

        $element->add_control(
            'fwbt',
            [
                'label' => esc_html__('Full width', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'width:100%;',
                ],
            ]
        );

        $element->add_responsive_control(
            'btjst',
            [
                'label' => esc_html__('Justify content', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'thepack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'thepack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-start' => [
                        'title' => esc_html__('End', 'thepack'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Space between', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-content-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'bisiz',
            [
                'label' => esc_html__('Icon size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->end_controls_section();
    }

    public static function add_attributes(Element_Base $element)
    {
        if (in_array($element->get_name(), ['section', 'column'])) {
            return;
        }

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            return;
        }

        $settings = $element->get_settings_for_display();

        $overlay_bg = isset($settings['_tp_ele_overlay_background']) ? $settings['_tp_ele_overlay_background'] : '';
        $underlay_bg = isset($settings['_tp_ele_underlay_background']) ? $settings['_tp_ele_underlay_background'] : '';

        $has_background_overlay = (in_array($overlay_bg, [
            'classic',
            'gradient'
        ], true) || in_array($underlay_bg, ['classic', 'gradient'], true));

        if ($has_background_overlay) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-has-beaf');
        }
    }

    public static function add_section(Element_Base $element)
    {
        $element->start_controls_section(
            'tp_sec_title',
            [
                'label' => 'Before after',
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->start_controls_tabs('tp_ou_tabs');

        $element->start_controls_tab(
            'tp_ou_tabs1',
            [
                'label' => __('Overlay', 'thepack'),
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_tp_ele_bf_bdr',
                'selector' => '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before',
            ]
        );

        $element->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => '_tp_ele_css_filter',
                'selector' => '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before',
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_tp_ele_overlay',
                'selector' => '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before',
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_op',
            [
                'label' => __('Opacity', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .05,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    '_tp_ele_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_control(
            'tp_el_ov_p',
            [
                'label' => __('Position and Size', 'thepack'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    '_tp_ele_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'tp_el_ov_w',
            [
                'label' => __('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_h',
            [
                'label' => __('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_y',
            [
                'label' => __('Offset Top', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_x',
            [
                'label' => __('Offset Left', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_ro',
            [
                'label' => __('Rotate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_brad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'tp_el_ovbdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $element->end_popover();

        $element->add_control(
            'tp_el_ov_zx',
            [
                'label' => __('Z-Index', 'thepack'),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'default' => -1,
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'z-index: {{VALUE}};',
                ],
                'label_block' => false,
                'condition' => [
                    '_tp_ele_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_control(
            'tp_el_ov_anim',
            [
                'label' => __('Animation', 'plugin-domain'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => jl_elementor_animation(),
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_ov_anim_dr',
            [
                'label' => esc_html__('Animation duration', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .25,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:before' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;',
                ],

            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab(
            'tp_ou_tabs2',
            [
                'label' => __('Underlay', 'thepack'),
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_tp_ele_fb_bdr',
                'selector' => '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after',
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_tp_ele_underlay',
                'selector' => '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after',
            ]
        );

        $element->add_control(
            'tp_el_un_pop',
            [
                'label' => __('Position and Size', 'thepack'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            'tp_el_un_w',
            [
                'label' => __('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_h',
            [
                'label' => __('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_y',
            [
                'label' => __('Offset Top', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_x',
            [
                'label' => __('Offset Right', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_rot',
            [
                'label' => __('Rotate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_brad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'tp_el_bdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $element->end_popover();

        $element->add_control(
            'tp_el_un_zin',
            [
                'label' => __('Z-Index', 'thepack'),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'default' => -1,
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'z-index: {{VALUE}};',
                ],
                'label_block' => false,
                'condition' => [
                    '_tp_ele_underlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_control(
            'tp_el_un_anim',
            [
                'label' => __('Animation', 'plugin-domain'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => jl_elementor_animation(),
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tp_el_un_anim_dr',
            [
                'label' => esc_html__('Animation duration', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => .25,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-has-beaf > .elementor-widget-container:after' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;',
                ],

            ]
        );

        $element->end_controls_tab();

        $element->end_controls_tabs();

        $element->end_controls_section();
    }
}

The_Pack_Overlay_Underlay::init();
