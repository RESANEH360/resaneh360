<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class jl_text_link extends Widget_Base
{
    public function get_name()
    {
        return 'jltxlnk';
    }

    public function get_title()
    {
        return __('Text link', 'thepack');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('General', 'thepack'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link text', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __('Link', 'thepack'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'https://profiles.wordpress.org/webangon/',
                    'is_external' => true,
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Link icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrlu',
            [
                'label' => __('General', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
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

                ],
                'default' => 'one',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'htyp',
                'selector' => '{{WRAPPER}} .jl-textlink',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_control(
            'gclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'galgn',
            [
                'label' => esc_html__('Alignment', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'thepack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'thepack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Link', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'lspz',
            [
                'label' => esc_html__('Left spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink .link' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'lclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lhclr',
            [
                'label' => esc_html__('Hover color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'uclr',
            [
                'label' => esc_html__('Line color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink .link:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .jl-textlink.two .link' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'lwid',
            [
                'label' => esc_html__('Line height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .jl-textlink.two .link' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jl-textlink.one .link:before' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ltyp',
                'selector' => '{{WRAPPER}} .jl-textlink a',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Icon', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'itso',
            [
                'label' => esc_html__('Top spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .link i' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ilso',
            [
                'label' => esc_html__('Left spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .link i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/one.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\jl_text_link());
