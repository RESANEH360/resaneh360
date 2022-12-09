<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_social_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tb_social_1';
    }

    public function get_title()
    {
        return esc_html__('Social 1', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-privacy';
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

                    'three' => [
                        'title' => esc_html__('Three', 'thepack'),
                        'icon' => 'fa fa-folder-open',
                    ],

                ],
                'default' => 'one',
            ]
        );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater1->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Facebook',
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Social link url', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
            ]
        );

        $repeater1->add_control(
            'color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
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
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tb-social' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => esc_html__('Animation', 'thepack'),
                'type' => Controls_Manager::SELECT,
                'options' => thepack_animations(),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'itmspac',
            [
                'label' => esc_html__('Item left-right spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'condition' => [
                    'tmpl!' => 'one',
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tb-social li' => 'margin:0px {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hght',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],

                ],
                'condition' => [
                    'tmpl' => 'one',
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tb-social-1 a' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lbl',
            [
                'label' => esc_html__('Label', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'num_ty',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .social-text,{{WRAPPER}} .ulink',
            ]
        );

        $this->add_control(
            'lbl_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ulink' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ulink:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tmpl!' => 'two',
                ],
            ]
        );

        $this->add_responsive_control(
            'icosze',
            [
                'label' => esc_html__('Font size', 'thepack'),
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
                    '{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icowdh',
            [
                'label' => esc_html__('Font wrapper width and height', 'thepack'),
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
                    '{{WRAPPER}} .tb-social-3 a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ilnehgh',
            [
                'label' => esc_html__('Font line height', 'thepack'),
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
                    '{{WRAPPER}} .tb-social-3 a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ibwid',
            [
                'label' => esc_html__('Border width', 'thepack'),
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
                    '{{WRAPPER}} .tb-social-3 a' => 'border-width: {{SIZE}}{{UNIT}};border-style: solid;',
                ],
            ]
        );

        $this->add_control(
            'ibrad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
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
                    '{{WRAPPER}} .tb-social-3 a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'f_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'f_bclr',
            [
                'label' => esc_html__('Border Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'f_bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'f_colorh',
            [
                'label' => esc_html__('Color Hover', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'f_bclrh',
            [
                'label' => esc_html__('Border Color Hover', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'f_bgh',
            [
                'label' => esc_html__('Background Hover', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tb-social-3 a:hover' => 'background: {{VALUE}};',
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

    private function content($content, $template, $column)
    {
        $col = 100 / count($content) . '%';
        $out1 = $out2 = $out3 = '';
        foreach ($content as $item) {
            
            $style = $item['color'] ? ' style="background:' . $item['color'] . ';width:' . $col . '" ' : '';

            $url = thepack_get_that_link($item['url']);
            $out1 .= '
                <a ' . $url . ' class="' . $column . '" ' . $style . '>
                    <span class="icon ' . $item['icon']['value'] . '"></span>
                    <span class="social-text">' . $item['title'] . '</span>
                </a>
            ';

            $out2 .= '
                <li><a class="ulink ' . $column . '" ' . $url . '>' . $item['title'] . '</a></li>
            ';

            $out3 .= '
                <li><a class="' . $column . '" ' . $url . '><span class="icon ' . $item['icon']['value'] . '"></span></a></li>
            ';
        }
        if ($template == 'one') {
            return $out1;
        } elseif ($template == 'two') {
            return '<ul>' . $out2 . '</ul>';
        } elseif ($template == 'three') {
            return '<ul>' . $out3 . '</ul>';
        } else {
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_social_1());
