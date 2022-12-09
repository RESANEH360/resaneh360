<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_img_acrdn extends Widget_Base
{
    public function get_name()
    {
        return 'tp_tab';
    }

    public function get_title()
    {
        return esc_html__('Tab', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-video-alt3';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_process_1',
            [
                'label' => esc_html__('Content', 'thepack'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Population', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text' => [
                        'title' => esc_html__('Content', 'thepack'),
                        'icon' => ' eicon-document-file',
                    ],
                    'template' => [
                        'title' => esc_html__('Template', 'thepack'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Label', 'thepack'),
                'label_block' => true,
                'default' => 'Car Insurance',
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'thepack'),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'condition' => [
                    'type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'template',
            [
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_footer_select(),
                'multiple' => false,
                'label' => esc_html__('Template', 'thepack'),
                'label_block' => true,
                'condition' => [
                    'type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Finance', 'thepack'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
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
            'style',
            [
                'label' => esc_html__('Style', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'one' => [
                        'title' => esc_html__('One', 'thepack'),
                        'icon' => ' eicon-document-file',
                    ],
                    'two' => [
                        'title' => esc_html__('Two', 'thepack'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'one',
            ]
        );

        $this->add_responsive_control(
            'wd',
            [
                'label' => esc_html__('Width', 'thepack'),
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .tp-tab-1 li' => 'width: {{VALUE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'gsp',
            [
                'label' => esc_html__('Spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-tab-1 li' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .two .tab-area:after' => 'left:{{SIZE}}{{UNIT}};width:calc(100% - {{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tp-tab-1 ul' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ]
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

        $this->add_responsive_control(
            't-algn',
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
                'selectors' => [
                    '{{WRAPPER}} .tab-area' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            't_pad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_typ',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} li span',
            ]
        );

        $this->add_responsive_control(
            'tbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} li span' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'tbar',
            [
                'label' => esc_html__('Arrow size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .one li span:before' => 'border-width: {{SIZE}}{{UNIT}};bottom:calc({{SIZE}}{{UNIT}}*-2)',
                ]
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            't_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 't_bclr',
                'label' => esc_html__('Border', 'thepack'),
                'selector' => '{{WRAPPER}} li span',
            ]
        );

        $this->add_control(
            't_bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Active', 'thepack'),
            ]
        );

        $this->add_control(
            't_aclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li.active span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            't_abg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li.active span' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .one li span:before' => 'border-color: {{VALUE}} transparent transparent;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 't_abclr',
                'label' => esc_html__('Border', 'thepack'),
                'selector' => '{{WRAPPER}} li.active span',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Description', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'd-algn',
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
                'selectors' => [
                    '{{WRAPPER}} .tab-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_ty',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .tab-content',
            ]
        );

        $this->add_responsive_control(
            'desc_pd',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dsc_bclr',
                'label' => esc_html__('Border', 'thepack'),
                'selector' => '{{WRAPPER}} .tab-content',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_styl2',
            [
                'label' => esc_html__('Style 2', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['two'],
                ],
            ]
        );

        $this->add_responsive_control(
            'st2uh',
            [
                'label' => esc_html__('Underline height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .two .tab-area:after' => 'height:{{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'st2ubp',
            [
                'label' => esc_html__('Underline bottom position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .two .tab-area:after' => 'bottom:-{{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'st2ubg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .two .tab-area:after' => 'background: {{VALUE}};',
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

    private function icon_image($icon)
    {
        $type = $icon['type'];
        if ($type == 'template') {
            return do_shortcode('[THEPACK_INSERT_TPL id="' . $icon['template'] . '"]');
            ;
        } else {
            return $icon['content'];
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_img_acrdn());
