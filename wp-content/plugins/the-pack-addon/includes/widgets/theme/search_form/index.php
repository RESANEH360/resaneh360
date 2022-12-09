<?php
namespace ThePackAddon\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class thepack_search_widget extends Widget_Base
{
    public function get_name()
    {
        return 'th-searchbox';
    }

    public function get_title()
    {
        return esc_html__('Search Form', 'thepackpro');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-dismiss';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout_settings',
            [
                'label' => esc_html__('Search form', 'thepackpro')
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Placeholder', 'thepackpro'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tmpl',
            [
                'label' => esc_html__('Template', 'thepackpro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'no_button' => [
                        'title' => esc_html__('No button', 'thepackpro'),
                        'icon' => 'fa fa-folder',
                    ],
                    'ikn_button' => [
                        'title' => esc_html__('Icon button', 'thepackpro'),
                        'icon' => 'fa fa-folder-o',
                    ],
                    'txt_button' => [
                        'title' => esc_html__('Text button', 'thepackpro'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'no_button',
            ]
        );

        $this->add_control(
            'btn_txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button text', 'thepackpro'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'txt_button',
                ],
            ]
        );

        $this->add_control(
            'btn_ikn',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Button icon', 'thepackpro'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'ikn_button',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section-general-style',
            [
                'label' => esc_html__('General', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .search-field',
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border-width',
            [
                'label' => esc_html__('Border width', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'border-width: {{SIZE}}{{UNIT}};border-style:solid;',
                ],

            ]
        );

        $this->add_responsive_control(
            'border-radius',
            [
                'label' => esc_html__('Border radius', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__('Border color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'txt_color',
            [
                'label' => esc_html__('Input color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field,{{WRAPPER}} .buildersearch-form:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Input background', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-field' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btnikn',
            [
                'label' => esc_html__('Icon Button', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl!' => 'no_button',
                ],
            ]
        );

        $this->add_control(
            'iknwid',
            [
                'label' => esc_html__('Width', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'width: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .search-submit',
            ]
        );

        $this->add_control(
            'btm_color',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btm_bgcolor',
            [
                'label' => esc_html__('Background', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'srhbgclr',
            [
                'label' => esc_html__('Hover background', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sborder_color',
            [
                'label' => esc_html__('Border color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'border-color:{{VALUE}};border-style:solid',
                ],
            ]
        );

        $this->add_control(
            'iknbrwid',
            [
                'label' => esc_html__('Border width', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'border-width: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'iknbdr',
            [
                'label' => esc_html__('Border radius', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_search_widget());
