<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Icon_Extra_Control
{
    public static function init()
    {
        add_action('elementor/element/icon/section_style_icon/after_section_end', [
            __CLASS__,
            'tp_callback_function'
        ], 10, 2);
    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => __('Extra style', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            '_anim',
            [
                'label' => __('Animation', 'plugin-domain'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => jl_elementor_animation(),
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'animation-name: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            '_anim_dr',
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
                    '{{WRAPPER}} .elementor-icon' => 'animation-duration: {{SIZE}}s;animation-iteration-count:infinite;',
                ],

            ]
        );

        $element->add_responsive_control(
            'tp-rotate',
            [
                'label' => esc_html__('Rotate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'transform: rotate({{SIZE}}deg);',
                ],

            ]
        );

        $element->add_control(
            'abspos',
            [
                'label' => esc_html__('Absolute position', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'position: absolute;',
                ],
            ]
        );

        $element->add_responsive_control(
            'ig_lp',
            [
                'label' => esc_html__('Left position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'left: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ig_rp',
            [
                'label' => esc_html__('Right position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'right: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->add_responsive_control(
            'ig_tp',
            [
                'label' => esc_html__('Top position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'top: {{SIZE}}{{UNIT}};',
                ]

            ]
        );

        $element->end_controls_section();
    }
}

The_Pack_Icon_Extra_Control::init();
