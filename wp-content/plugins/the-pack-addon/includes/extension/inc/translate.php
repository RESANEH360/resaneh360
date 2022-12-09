<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Tp_Translate_Element
{
    /**
     * Initialize
     *
     * @since 1.0.0
     *
     * @access public
     */
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 10, 2);
    }

    public static function tp_element_translate($element, $args)
    {  
        $element->start_controls_section(
            'section_tsc',
            [
                'label' => __('The Pack Widget Extra', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'anim',
            [
                'label' => esc_html__('Animation', 'thepack'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'prefix_class' => '',
                'label_block' => true
            ]
        );

        $element->add_control(
            'abs_pos',
            [
                'label' => esc_html__('Absolute position', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'position:absolute;',
                ],
            ]
        );

        $element->add_control(
            'auto-wid',
            [
                'label' => esc_html__('Auto width', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}' => 'width:auto;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpvtras',
            [
                'label' => esc_html__('Vertical translate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tphtras',
            [
                'label' => esc_html__('Horizontal translate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tprps',
            [
                'label' => esc_html__('Right spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpls',
            [
                'label' => esc_html__('Left spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

Tp_Translate_Element::init();
