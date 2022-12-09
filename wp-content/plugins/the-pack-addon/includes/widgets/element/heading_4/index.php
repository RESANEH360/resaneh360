<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly  

class thepack_heading_4 extends Widget_Base
{
    public function get_name()
    {
        return 'heading4';
    }

    public function get_title()
    {
        return esc_html__('Heading 4', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-format-status';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_heading',
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
                        'title' => esc_html__('Normal', 'thepack'),
                        'icon' => 'eicon-text-area',
                    ],
                    'two' => [
                        'title' => esc_html__('Text clip', 'thepack'),
                        'icon' => 'eicon-image',
                    ],
                    'three' => [
                        'title' => esc_html__('Three', 'thepack'),
                        'icon' => 'eicon-social-icons',
                    ],
                    'four' => [
                        'title' => esc_html__('Four', 'thepack'),
                        'icon' => 'eicon-testimonial',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => esc_html__('Text align', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'thepack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'thepack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .headwrp' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Title', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Sub title', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => ['one', 'three'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'titclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'titbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'background: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'titbdr',
            [
                'label' => esc_html__('Border', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'border:1px solid {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'titmr',
            [
                'label' => esc_html__('Margin', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'titpad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'titbrad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .main-head' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tityp',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .main-head',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_stitle',
            [
                'label' => esc_html__('Sub title', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['one', 'three'],
                ],
            ]
        );

        $this->add_control(
            'stitclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-head' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stityp',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .sub-head',
            ]
        );

        $this->add_responsive_control(
            'svps',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tmpl' => ['one'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sub-head' => 'top: {{SIZE}}%;',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dot',
            [
                'label' => esc_html__('Dot', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['four'],
                ],
            ]
        );

        $this->add_control(
            'dtbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-four .main-head:before' => 'background: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dtwh',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .style-four .main-head:before' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dttp',
            [
                'label' => esc_html__('Top position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-four .main-head:before' => 'top:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dtlp',
            [
                'label' => esc_html__('Left position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-four .main-head:before' => 'left:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bar',
            [
                'label' => esc_html__('Bar', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tityp',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .main-head:before',
            ]
        );

        $this->add_responsive_control(
            'bwid',
            [
                'label' => esc_html__('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head:before' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'bbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head:before' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'bht',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head:before' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btsp',
            [
                'label' => esc_html__('Top spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head:before' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btzidx',
            [
                'label' => esc_html__('Z index', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head:before' => 'z-index: {{SIZE}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_speci',
            [
                'label' => esc_html__('Special text', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => 'three',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'strok',
				'selector' => '{{WRAPPER}} .main-head i',
			]
		);

        $this->add_control(
            'speclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-head i' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'spetyp',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .main-head i',
            ]
        );

        $this->add_control(
            'numtbr',
            [
                'label' => __('Top bar', 'thepack'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'num_tbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-head i::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbht',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .main-head i::after' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbvp',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head i::after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'numtbhp',
            [
                'label' => esc_html__('Horizontal position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .main-head i::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        include dirname(__FILE__) . '/' . $settings['tmpl'] . '.php';
    }

    protected function content_template()
    {
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_heading_4());
