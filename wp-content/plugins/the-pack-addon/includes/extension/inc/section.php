<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) {
    exit;
}

class jl_section_overlay
{
    public static function init()
    {
        add_action('elementor/element/section/section_background_overlay/before_section_end', [
            __CLASS__,
            'jl_section_overlay_get_controls'
        ], 10, 2);
        add_action('elementor/element/column/section_background_overlay/before_section_end', [
            __CLASS__,
            'jl_section_overlay_get_controls'
        ], 10, 2);

        add_action('elementor/element/section/section_advanced/after_section_end', [
            __CLASS__,
            'jl_section_parallax'
        ], 10, 2);
        add_action('elementor/frontend/section/before_render', [__CLASS__, 'jl_section_parallax_render'], 10, 2);
    }

    public static function jl_section_parallax($element, $args)
    {
        $element->start_controls_section(
            'jl_sec_prlx',
            [
                'label' => esc_html__('The Pack Advanced', 'thepack'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
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

        $element->add_responsive_control(
            'vpose',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
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
                    '{{WRAPPER}}' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ]

            ]
        );

        $element->add_responsive_control(
            'swid',
            [
                'label' => esc_html__('Extra width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}>.elementor-container' => 'width:calc(100% + {{SIZE}}{{UNIT}});',
                ]

            ]
        );

        $element->add_control(
            'jl_sec_paralx_on',
            [
                'label' => esc_html__('Parallax', 'thepack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepack'),
                'label_off' => esc_html__('No', 'thepack'),
            ]
        );

        $element->add_control(
            'f_footer',
            [
                'label' => esc_html__('Fixed footer', 'thepack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
            ]
        );

        $element->add_control(
            'jl_ov_hdn',
            [
                'label' => __('Overflow hidden', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'prefix_class' => 'tp-section-hidden-',
            ]
        );

        $element->add_control(
            'xld-speed',
            [
                'label' => esc_html__('Speed', 'thepack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .1,
                ],
                'condition' => [
                    'jl_sec_paralx_on' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2,
                        'step' => .1,
                    ],

                ],
            ]
        );

        $element->add_control(
            'moving_bg',
            [
                'label' => esc_html__('Moving background', 'thepack'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'tp-section-moving-',
            ]
        );

        $element->add_control(
            'moving-speed',
            [
                'label' => esc_html__('Moving duration', 'thepack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'moving_bg' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'animation-duration: {{SIZE}}s;',
                ],
            ]
        );

        $element->add_control(
            'full_pad',
            [
                'label' => esc_html__('Full padding', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => [
                    'layout' => 'full_width',
                ],
                'options' => [
                    'padding-left' => [
                        'title' => esc_html__('Left', 'thepack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'padding-right' => [
                        'title' => esc_html__('Right', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'prefix_class' => 'tp-full-',
            ]
        );

        $element->add_responsive_control(
            'pad_max_width',
            [
                'label' => esc_html__('Max width', 'thepack'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'full_pad!' => '',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.tp-full-padding-left >.elementor-container' => 'padding-left: calc((100% - {{SIZE}}{{UNIT}}) / 2)',
                    '{{WRAPPER}}.tp-full-padding-right >.elementor-container' => 'padding-right: calc((100% - {{SIZE}}{{UNIT}}) / 2)',
                ],
            ]
        );

        $element->end_controls_section();
    }

    public static function jl_section_parallax_render($element)
    {
        $data = $element->get_data();
        $type = isset($data['elType']) ? $data['elType'] : 'section';
        $settings = $data['settings'];

        if ('section' !== $type) {
            return;
        }

        if (isset($settings['f_footer'])) {
            if (filter_var($settings['f_footer'], FILTER_VALIDATE_BOOLEAN)) {
                $element->add_render_attribute('_wrapper', [
                    'class' => 'tb-fixedfooter',
                ]);
            }
        }

        if (isset($settings['jl_sec_paralx_on'])) {
            $speed = isset($settings['xld-speed']['size']) ? $settings['xld-speed']['size'] : '';
            $column_settings = [
                'id' => $data['id'],
                'speed' => $speed,
            ];
            if (filter_var($settings['jl_sec_paralx_on'], FILTER_VALIDATE_BOOLEAN)) {
                $element->add_render_attribute('_wrapper', [
                    'class' => 'tb-parallaxbg',
                    'data-jlparallax' => json_encode($column_settings),
                ]);
            }

            $element->columns_data[$data['id']] = $column_settings;
        }
    }

    public static function jl_section_overlay_get_controls($element, $args)
    {
        // selector based on the current element
        $selector = '{{WRAPPER}} > .elementor-column-wrap > .elementor-background-overlay, {{WRAPPER}} > .elementor-widget-wrap > .elementor-background-overlay';
        if ('section' == $element->get_name()) {
            $selector = '{{WRAPPER}} > .elementor-background-overlay';
        }

        $element->add_control(
            'jl_ovl_hdr',
            [
                'label' => 'Overlay',
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_control(
            'jl_ov_enable',
            [
                'label' => __('Enable Overlaiz?', 'thepack'),
                'separator' => 'after',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'thepack'),
                'label_off' => __('No', 'thepack'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'jl_ov_width',
            [
                'label' => __('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'default_tablet' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'default_mobile' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    $selector => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'jl_ov_height',
            [
                'label' => __('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'default_tablet' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'default_mobile' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    $selector => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
                'device_args' => [
                    Controls_Stack::RESPONSIVE_TABLET => [
                        'selectors' => [
                            $selector => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    Controls_Stack::RESPONSIVE_MOBILE => [
                        'selectors' => [
                            $selector => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                ],
            ]
        );

        $element->add_responsive_control(
            'jl_ov_x_pos',
            [
                'label' => __('Position - X', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'default_tablet' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'default_mobile' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $selector => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        // ------------------------------------------------------------------------- CONTROL: Magic Overlays - move background overlay - Y
        $element->add_responsive_control(
            'jl_ov_y_pos',
            [
                'label' => __('Position - Y', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'default_tablet' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'default_mobile' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $selector => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_control(
            'jl_ov_z',
            [
                'label' => __('Z-Index', 'thepack'),
                'type' => Controls_Manager::NUMBER,
                'separator' => 'before',
                'min' => -9999,
                'selectors' => [
                    $selector => 'z-index: {{VALUE}};',
                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'jl_ov_skew',
            [
                'label' => __('Skew X', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    $selector => 'transform: skewX({{SIZE}}deg);-webkit-transform:: skewX({{SIZE}}deg);',
                ],
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],

                ],
                'condition' => [
                    'jl_ov_enable' => 'yes',
                    'background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $element->add_responsive_control(
            'jlbdr',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'jlclipath',
            [
                'label' => esc_html__('Clipping path', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'selectors' => [
                    $selector => 'clip-path: {{VALUE}};',
                ],
            ]
        );

    }
}

jl_section_overlay::init();
