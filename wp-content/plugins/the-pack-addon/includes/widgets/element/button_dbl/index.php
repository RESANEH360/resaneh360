<?php
namespace ThePackAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_dualbtn extends Widget_Base
{
    public function get_name()
    {
        return 'tbdlbtn';
    }

    public function get_title()
    {
        return esc_html__('Dual Button', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-appearance';
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
                        'title' => esc_html__('Dual button', 'thepack'),
                        'icon' => 'fa fa-folder',
                    ],
                    'two' => [
                        'title' => esc_html__('Video Icon', 'thepack'),
                        'icon' => 'fa fa-folder-o',
                    ],

                    'three' => [
                        'title' => esc_html__('Text', 'thepack'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'btn1',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('First button label', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ficon',
            [
                'label' => esc_html__('First icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'url1',
            [
                'label' => esc_html__('First button link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
            ]
        );

        $this->add_control(
            'btn2',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Second button label', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'one',
                ],
            ]
        );

        $this->add_control(
            'sicon',
            [
                'label' => esc_html__('Second icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'one',
                ],
            ]
        );

        $this->add_control(
            'url2',
            [
                'label' => esc_html__('Second button link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
                'condition' => [
                    'tmpl' => 'one',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Play Icon', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'vidurl',
            [
                'label' => esc_html__('Video url', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Text', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'three',
                ],
            ]
        );

        $this->add_control(
            'septxt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Separator text', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'tmpl' => 'three',
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

        $this->add_responsive_control(
            'align',
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
                    '{{WRAPPER}} .dualbtninr' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'oupd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dualbtnwrp>div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dualbtnwrp' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right: -{{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bticon',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'isp',
            [
                'label' => esc_html__('Spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dual2wrp a,{{WRAPPER}} .dual1wrp a' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_fbtn',
            [
                'label' => esc_html__('First button', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'fbw',
            [
                'label' => esc_html__('Button width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fbpd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fbbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fbbw',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fbtyp',
                'selector' => '{{WRAPPER}} .dual1',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->start_controls_tabs('bt1');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            'fbclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fbbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fbbclr',
            [
                'label' => esc_html__('Border  color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1' => 'border-color: {{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fbbxp',
                'selector' => '{{WRAPPER}} .dual1',
                'label' => esc_html__('Box shadow', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Hover', 'thepack'),
            ]
        );
        $this->add_responsive_control(
            'fbhsd',
            [
                'label' => esc_html__('Raised', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .dual2wrp:hover' => 'transform: translateY(-5px);',
                ],
            ]
        );
        $this->add_control(
            'fbhclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fbhbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fbhbclr',
            [
                'label' => esc_html__('Border  color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual1:hover' => 'border-color: {{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fbhbxp',
                'selector' => '{{WRAPPER}} .dual1:hover',
                'label' => esc_html__('Box-shadow', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sep',
            [
                'label' => esc_html__('Separator', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => 'three',
                ],
            ]
        );

        $this->add_control(
            'sep_c',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dualsep' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sep_width',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .dualsep' => 'line-height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'septyp',
                'selector' => '{{WRAPPER}} .dualsep',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sbtn',
            [
                'label' => esc_html__('Second button', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => ['one', 'three'],
                ],
            ]
        );

        $this->add_responsive_control(
            'sbw',
            [
                'label' => esc_html__('Button width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbpd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sbbw',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sbtyp',
                'selector' => '{{WRAPPER}} .dual2',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->start_controls_tabs('stb');

        $this->start_controls_tab(
            'st1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            'sbclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sbbclr',
            [
                'label' => esc_html__('Border  color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dual2' => 'border-color: {{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'st2',
            [
                'label' => esc_html__('Hover', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Video button', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'icon_width',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'icon_lheight',
            [
                'label' => esc_html__('Line-height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'line-height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'btn_size',
            [
                'label' => esc_html__('Font size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'btn_rad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'btn_brads',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'border-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->start_controls_tabs('vdtb');

        $this->start_controls_tab(
            'vd1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_c',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bdrcl',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn' => 'border-color: {{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fvbbxd',
                'selector' => '{{WRAPPER}} .vidbtn',
                'label' => esc_html__('Box-shadow', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'vd2',
            [
                'label' => esc_html__('Hover', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'vbhsd',
            [
                'label' => esc_html__('Raised', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn:hover' => 'transform: translateY(-5px);',
                ],
            ]
        );
        $this->add_control(
            'vbhclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'vbhbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fvbbclr',
            [
                'label' => esc_html__('Border  color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vidbtn:hover' => 'border-color: {{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fvbhbxd',
                'selector' => '{{WRAPPER}} .vidbtn:hover',
                'label' => esc_html__('Box-shadow', 'thepack'),
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_dualbtn());
