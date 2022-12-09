<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TP_Column_Extra
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
        add_action('elementor/element/column/section_style/after_section_end', [
            __CLASS__,
            'tp_element_translate'
        ], 10, 2);
        add_action('elementor/frontend/column/before_render', [
            __CLASS__,
            'before_render_options'
        ], 10, 2);
    }

    public static function before_render_options($element)
    {
        $settings = $element->get_settings_for_display();

        if (isset($settings['url'], $settings['url']['url']) && !empty($settings['url']['url'])) {
            $element->add_render_attribute('_wrapper', 'class', 'tp-clickable-column');
            $element->add_render_attribute('_wrapper', 'style', 'cursor: pointer;');
            $element->add_render_attribute('_wrapper', 'data-column-clickable', $settings['url']['url']);
            $element->add_render_attribute('_wrapper', 'data-column-clickable-blank', $settings['url']['is_external'] ? '_blank' : '_self');
        }
    }

    public static function tp_element_translate($element, $args)
    {
        $element->start_controls_section(
            'section_colextra',
            [
                'label' => __('Column Extra', 'thepack'),
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
            'colexhiv',
            [
                'label' => esc_html__('Overflow hidden', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'overflow: hidden;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpcolmxwid',
            [
                'label' => esc_html__('Max width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'max-width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'collmrg',
            [
                'label' => esc_html__('Left auto margin', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'margin-left: auto;',
                ],
            ]
        );

        $element->add_control(
            'colrmrg',
            [
                'label' => esc_html__('Right auto margin', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-wrap' => 'margin-right: auto;',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpvctras',
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
                    '{{WRAPPER}} >.elementor-element-populated,{{WRAPPER}} .elementor-column' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tphctras',
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
                    '{{WRAPPER}} >.elementor-element-populated,{{WRAPPER}} .elementor-column' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'tpcolheight',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'vh', '%'],
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'url',
            [
                'label' => esc_html__('Wrapper link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'section_coltxtov',
            [
                'label' => __('Text Overlay', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'coltxt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Text', 'thepack'),
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'content:"{{VALUE}}";',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coltxtyp',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} >.elementor-widget-wrap:before',
            ]
        );

        $element->add_control(
            'coltxtklr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'coltxtstk',
            [
                'label' => esc_html__('Text stroke color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => '-webkit-text-stroke:1px {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxtop',
            [
                'label' => esc_html__('Top position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1500,
                        'max' => 1500,
                        'step' => 1,
                    ],

                    '%' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxlps',
            [
                'label' => esc_html__('Left position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1500,
                        'max' => 1500,
                        'step' => 1,
                    ],

                    '%' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_control(
            'coltxabs',
            [
                'label' => esc_html__('Center position', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'transform: translate(-50%, -50%);',
                ],
            ]
        );

        $element->add_responsive_control(
            'coltxrt',
            [
                'label' => esc_html__('Rotate', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            'colexzind',
            [
                'label' => __('Z index', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} >.elementor-widget-wrap:before' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        $element->end_controls_section();
    }
}

TP_Column_Extra::init();
