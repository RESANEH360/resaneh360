<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
}

class thepack_fsrnslk extends Widget_Base
{
    public function get_name()
    {
        return 'tp-fsslider';
    }

    public function get_title()
    {
        return esc_html__('Parallax Slide', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-welcome-widgets-menus';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'pre',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Pre title', 'thepack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'thepack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'thepack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'btn1',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('First button', 'thepack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'url1',
            [
                'label' => esc_html__('First link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
            ]
        );

        $repeater->add_control(
            'btn2',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Second button', 'thepack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'url2',
            [
                'label' => esc_html__('Second link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
            ]
        );

        $repeater->add_control(
            'bg',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Background', 'thepack'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_responsive_control(
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
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .content-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lists',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'title' => esc_html__('Football', 'thepack'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gnrl',
            [
                'label' => esc_html__('General', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ht',
            [
                'label' => esc_html__('Height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1800,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .tp-main-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cpos',
            [
                'label' => esc_html__('Vertical content position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-main-slider .content-wrap' => 'transform: translateY({{SIZE}}{{UNIT}});-webkit-transform:translateY({{SIZE}}%);',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ovrly',
                'label' => esc_html__('Overlay background', 'elementor'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slide-bg-image:before',
            ]
        );

        $this->add_control(
            'trnsl',
            [
                'label' => esc_html__('Translate', 'thepack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'htrans' => [
                        'title' => esc_html__('Horizontal translate', 'thepack'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'vtrans' => [
                        'title' => esc_html__('Vertical translate', 'thepack'),
                        'icon' => 'eicon-slider-album',
                    ]
                ],
                'default' => 'htrans',
            ]
        );

        $this->add_control(
            'prlx',
            [
                'label' => esc_html__('Parallax', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepack'),
                'label_off' => esc_html__('No', 'thepack'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mxwd',
            [
                'label' => esc_html__('Max wrapper width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 2000,
                        'min' => 0,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'cnt_pad',
            [
                'label' => esc_html__('Wrapper padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bgpos',
            [
                'label' => esc_html__('Background image position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slide-bg-image' => 'background-position:0% {{SIZE}}%;',
                ],

            ]
        );

        $this->start_controls_tabs('cnt');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Pre', 'thepack'),
            ]
        );

        $this->add_control(
            'pr_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pr_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .pre',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Title', 'thepack'),
            ]
        );

        $this->add_control(
            'tt_clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tt_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'ttmrd',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Desc', 'thepack'),
            ]
        );

        $this->add_control(
            'ds_clr',
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
                'name' => 'ds_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->add_control(
            'dsmrd',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bt_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .slide-btns a',
            ]
        );

        $this->start_controls_tabs('btn');

        $this->start_controls_tab(
            'bt1',
            [
                'label' => esc_html__('First', 'thepack'),
            ]
        );

        $this->add_control(
            'bt1clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt1bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt1bdc',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt1hclr',
            [
                'label' => esc_html__('Hover color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt1hbg',
            [
                'label' => esc_html__('Hover background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt1bhdc',
            [
                'label' => esc_html__('Hover border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bt1bw',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'border-width: {{SIZE}}{{UNIT}};border-style:solid;',
                ],

            ]
        );

        $this->add_responsive_control(
            'bt1brd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'bt1pad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'bt2',
            [
                'label' => esc_html__('Second', 'thepack'),
            ]
        );

        $this->add_control(
            'bt2clr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt2bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bt2bdc',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bt2bw',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'border-width: {{SIZE}}{{UNIT}};border-style:solid;',
                ],

            ]
        );

        $this->add_responsive_control(
            'bt2brd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'bt2pad',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slide-btns a:nth-child(2)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel',
            [
                'label' => esc_html__('Carousel', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => esc_html__('Autoplay', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepack'),
                'label_off' => esc_html__('No', 'thepack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'arrow',
            [
                'label' => esc_html__('Arrow', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepack'),
                'label_off' => esc_html__('No', 'thepack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Dot', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'thepack'),
                'label_off' => esc_html__('No', 'thepack'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide speed', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3000,
                ],
                'condition' => [
                    'auto' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arrow',
            [
                'label' => esc_html__('Arrows', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'picon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Prev icon', 'thepack'),
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'nicon',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Next icon', 'thepack'),
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'pgi_bg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pgi_c',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pgbkr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pgwd',
            [
                'label' => esc_html__('Width and height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};margin-top: calc(-{{SIZE}}{{UNIT}}/2);',
                ],

            ]
        );

        $this->add_responsive_control(
            'fsize',
            [
                'label' => esc_html__('Font size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'pgbrad',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .prnx' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_nav',
            [
                'label' => esc_html__('Slider Dot', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'navpos',
            [
                'label' => esc_html__('Postion', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 300,
                        'min' => -300,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'navcol',
            [
                'label' => esc_html__('Dot color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-slider .swiper-pagination-bullet' => 'background: {{VALUE}};background-clip: content-box;',
                    '{{WRAPPER}} .tp-main-slider .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
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

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_fsrnslk());
