<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_scroll_to_section extends Widget_Base
{
    public function get_name()
    {
        return 'tp-scrollto';
    }

    public function get_title()
    {
        return esc_html__('Scroll To', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-universal-access-alt';
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
                        'icon' => 'eicon-tabs',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'thepack'),
                        'icon' => 'eicon-toggle',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'two',
                ],
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

        $this->add_control(
            'algn',
            [
                'label' => esc_html__('Aliognment', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'thepack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'thepack'),
                        'icon' => 'eicon-h-align-stretch',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .scroll-to' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thm',
            [
                'label' => esc_html__('Theme color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mousey' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .scroller,{{WRAPPER}} .two .scroll-downs' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inr_pad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'tmpl' => 'one',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mousey' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-downs' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_responsive_control(
            'wh',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .scroll-downs' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'brd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .scroll-downs' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'fs',
            [
                'label' => esc_html__('Icon size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .scroll-downs i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/' . $settings['tmpl'] . '.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_scroll_to_section());
