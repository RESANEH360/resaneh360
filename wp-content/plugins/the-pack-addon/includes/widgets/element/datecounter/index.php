<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_date_count extends Widget_Base
{
    public function get_name()
    {
        return 'gng-timer';
    }

    public function get_title()
    {
        return esc_html__('Date timer', 'thepack');
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-customizer';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_pricing_table',
            [
                'label' => esc_html__('Date Timer', 'thepack'),
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

        $this->add_control(
            'date',
            [
                'type' => Controls_Manager::DATE_TIME,
                'label' => esc_html__('Date', 'thepack'),
                'default' => 'YYYY-mm-dd',
            ]
        );

        $this->add_control(
            'show-hour',
            [
                'label' => esc_html__('Hide hour', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'thepack'),
                'label_off' => esc_html__('Off', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'show-min',
            [
                'label' => esc_html__('Hide minute', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'thepack'),
                'label_off' => esc_html__('Off', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} .min' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'show-sec',
            [
                'label' => esc_html__('Hide second', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'thepack'),
                'label_off' => esc_html__('Off', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'display: none;'
                ],
            ]
        );

        $this->add_control(
            'dayl',
            [
                'label' => esc_html__('Day label', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('days', 'thepack'),
            ]
        );

        $this->add_control(
            'hourl',
            [
                'label' => esc_html__('Hour label', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('hours', 'thepack'),
            ]
        );

        $this->add_control(
            'minl',
            [
                'label' => esc_html__('Minute label', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('min', 'thepack'),
            ]
        );

        $this->add_control(
            'secl',
            [
                'label' => esc_html__('Second label', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('sec', 'thepack'),
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
            'width',
            [
                'label' => esc_html__('Column width', 'thepack'),
                'type' => Controls_Manager::NUMBER,
                'default' => '25',
                'selectors' => [
                    '{{WRAPPER}} .countdown.two>span' => 'width: {{VALUE}}%;',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_responsive_control(
            'itm_vp',
            [
                'label' => esc_html__('Vertical padding', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'condition' => [
                    'tmpl' => 'two',
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown.two>span' => 'padding-top:{{SIZE}}{{UNIT}};padding-bottom:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .countdown' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inpad',
            [
                'label' => esc_html__('Item spacing', 'thepack'),
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
                    '{{WRAPPER}} .countdown>span' => 'padding:0px {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Days', 'thepack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'numty',
                'selector' => '{{WRAPPER}} .countdown>span',
                'label' => esc_html__('Typographt', 'thepack'),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Label', 'thepack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'utyp',
                'selector' => '{{WRAPPER}} .countdown>span span',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'un_vp',
            [
                'label' => esc_html__('Spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown span span' => 'top:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .countdown.three span span' => 'padding-left:{{SIZE}}{{UNIT}};',

                ],

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
                    'tmpl!' => 'two',
                ],
            ]
        );

        $this->add_control(
            'seo_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sp_sie',
            [
                'label' => esc_html__('Size', 'thepack'),
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
                    '{{WRAPPER}} .countdown.one>span::before' => 'font-size:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_responsive_control(
            'sp_tp',
            [
                'label' => esc_html__('Vertical position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'top:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_responsive_control(
            'sp_lp',
            [
                'label' => esc_html__('Horizontal position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown.one>span::before' => 'left:{{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'unt_color',
            [
                'label' => esc_html__('Unit color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown>span span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'd_color',
            [
                'label' => esc_html__('Day number color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .days' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'd_bcolor',
            [
                'label' => esc_html__('Day background color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .days' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'hr_color',
            [
                'label' => esc_html__('Hour number color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_bcolor',
            [
                'label' => esc_html__('Hour background color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hour' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'mn_color',
            [
                'label' => esc_html__('Minute number color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .min' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mn_bcolor',
            [
                'label' => esc_html__('Minute background color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .min' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
                ],
            ]
        );

        $this->add_control(
            'se_color',
            [
                'label' => esc_html__('Second number color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'se_bcolor',
            [
                'label' => esc_html__('Second background color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'tmpl' => 'two',
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_date_count());
