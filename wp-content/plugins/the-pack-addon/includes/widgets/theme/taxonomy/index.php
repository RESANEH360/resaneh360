<?php
namespace ThePackAddon\Widgets;

use Elementor;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use WP_Query;

class thepack_post_taxolist extends Widget_Base
{
    public function get_name()
    {
        return 'tp-taxonomy';
    }

    public function get_title()
    {
        return esc_html__('Taxonomy', 'thepackpro');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-sos';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_info',
            [
                'label' => esc_html__('Taxonomy', 'thepackpro'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Show as', 'thepackpro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'list' => [
                        'title' => esc_html__('List', 'thepackpro'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'full' => [
                        'title' => esc_html__('Full width', 'thepackpro'),
                        'icon' => 'eicon-slider-push',
                    ],
                ],
                'default' => 'list',
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label' => esc_html__('Taxonomy', 'thepackpro'),
                'type' => Controls_Manager::SELECT,
                'options' => thepaack_drop_taxolist(),
                'multiple' => false,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label' => esc_html__('Hide count', 'thepackpro'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony span.count' => 'display: none;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__('General', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ftsp',
            [
                'label' => esc_html__('Spacing', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony.full li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-taxomony.list li' => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-taxomony.list' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'gpad',
            [
                'label' => esc_html__('Padding', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony.list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'list',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbrad',
            [
                'label' => esc_html__('Border radius', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony.list li a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'list',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Label', 'thepackpro'),
            ]
        );

        $this->add_control(
            'tcol',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tcolh',
            [
                'label' => esc_html__('Hover color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony li a:hover .label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbg',
            [
                'label' => esc_html__('Background', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony.list li a' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'list',
                ],
            ]
        );

        $this->add_control(
            'tbgh',
            [
                'label' => esc_html__('Hover background', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-taxomony.list li a:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'list',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typot',
                'selector' => '{{WRAPPER}} .label',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Count', 'thepackpro'),
            ]
        );

        $this->add_control(
            'ccol',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cypot',
                'selector' => '{{WRAPPER}} .count',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_post_taxolist());
