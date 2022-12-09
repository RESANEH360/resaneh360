<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class ae_counter extends Widget_Base
{
    public function get_name()
    {
        return 'tp-circounter';
    }

    public function get_title()
    {
        return __('Circle counter', 'webangon');
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
                'label' => __('General', 'webangon'),
            ]
        );

        $this->add_control(
            'pre',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Prefix', 'thepack'),
            ]
        );

        $this->add_control(
            'num',
            [
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'label' => esc_html__('Number', 'thepack'),
            ]
        );

        $this->add_control(
            'thk',
            [
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'label' => esc_html__('Thickness', 'thepack'),
            ]
        );

        $this->add_control(
            'ethk',
            [
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'label' => esc_html__('Empty thickness', 'thepack'),
            ]
        );

        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Title', 'thepack'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => esc_html__('Description', 'thepack'),
            ]
        );

        $this->add_control(
            'mclr',
            [
                'label' => esc_html__('Main color', 'thepack'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'sclr',
            [
                'label' => esc_html__('Secondary color', 'thepack'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => __('Styling', 'webangon'),
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
                        'icon' => 'eicon-h-align-left',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'thepack'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_responsive_control(
            'gag',
            [
                'label' => esc_html__('Alignment', 'thepack'),
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
                    ],
                ],
                'condition' => [
                    'tmpl' => 'one',
                ],
                'selectors' => [
                    '{{WRAPPER}} .one' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('gt');

        $this->start_controls_tab(
            'gt1',
            [
                'label' => esc_html__('Title', 'thepack'),
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tmrg',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'gt2',
            [
                'label' => esc_html__('Desc', 'thepack'),
            ]
        );

        $this->add_control(
            'dclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dtyp',
                'selector' => '{{WRAPPER}} .desc',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cnt',
            [
                'label' => __('Circle', 'webangon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'cwh',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .client_counterup .circle' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'crrsp',
            [
                'label' => esc_html__('Right spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .circle' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('cir');

        $this->start_controls_tab(
            'cir1',
            [
                'label' => esc_html__('Number', 'thepack'),
            ]
        );

        $this->add_control(
            'nmclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .num' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nmtyp',
                'selector' => '{{WRAPPER}} .num',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cir2',
            [
                'label' => esc_html__('Suffix', 'thepack'),
            ]
        );

        $this->add_control(
            'pcclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pctyp',
                'selector' => '{{WRAPPER}} .prefix',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'pcls',
            [
                'label' => esc_html__('Left spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .prefix' => 'left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'tpcls',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -60,
                        'max' => 60,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .prefix' => 'top: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\ae_counter());
