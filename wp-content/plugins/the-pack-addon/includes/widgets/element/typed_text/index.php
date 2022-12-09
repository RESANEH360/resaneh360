<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_tb_typing1 extends Widget_Base
{
    public function get_name()
    {
        return 'tp-typing1';
    }

    public function get_title()
    {
        return esc_html__('Typing letter', 'thepack');
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
            'pre',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Prefix Text', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'typing',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Typing Text', 'thepack'),
                'description' => esc_html__('Type text with ; separator', 'thepack'),
                'label_block' => true,
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
            'cursor',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Cursor', 'thepack'),
                'label_block' => true,
                'default' => '▋'
            ]
        );

        $this->add_control(
            'c_color',
            [
                'label' => esc_html__('Cursor color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .teletype-cursor' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'c_typo',
                'label' => esc_html__('Cursor Typo', 'thepack'),
                'selector' => '{{WRAPPER}} .teletype-cursor',
            ]
        );

        $this->add_responsive_control(
            'g-align',
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
                    'justify' => [
                        'title' => esc_html__('Justified', 'thepack'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .type-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pre',
            [
                'label' => esc_html__('Pre Title', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pre_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .teletype-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pre_pad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .teletype-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pre_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .teletype-prefix',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_typer',
            [
                'label' => esc_html__('Typer', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'typr_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .teletype-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'typr_pad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .teletype-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typr_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .teletype-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/list.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_tb_typing1());
