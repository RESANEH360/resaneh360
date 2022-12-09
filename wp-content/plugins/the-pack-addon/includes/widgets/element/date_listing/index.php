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
} // Exit if accessed directly

class thepack_tourmini extends Widget_Base
{
    public function get_name()
    {
        return 'tb_tourmini';
    }

    public function get_title()
    {
        return esc_html__('Date listing', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-universal-access';
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
            'title',
            [
                'label' => esc_html__('Title', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Rock in wonderland',
            ]
        );

        $repeater->add_control(
            'date',
            [
                'label' => esc_html__('Date', 'thepack'),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'place',
            [
                'label' => esc_html__('Place', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Sacramento, California',
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'thepack'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__('http://your-link.com', 'thepack'),
            ]
        );
        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'title' => esc_html__('Rock in wonderland', 'thepack'),
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

        $this->add_control(
            'btmsp',
            [
                'label' => esc_html__('Bottom spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .event-wrap:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_datem',
            [
                'label' => esc_html__('Time', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'd_pde',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .date-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'b_wid',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .date-wrap' => 'border-width: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'b_wrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .date-wrap' => 'border-radius: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'd_brc',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date-wrap' => 'border-color:{{VALUE}};border-style:solid;',
                ],
            ]
        );

        $this->add_control(
            'd_c',
            [
                'label' => esc_html__('Date color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'd_typo',
                'label' => esc_html__('Date typo', 'thepack'),
                'selector' => '{{WRAPPER}} .date',
            ]
        );

        $this->add_control(
            'm_c',
            [
                'label' => esc_html__('Month color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .month' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'm_typo',
                'label' => esc_html__('Month typo', 'thepack'),
                'selector' => '{{WRAPPER}} .month',
            ]
        );

        $this->add_control(
            'mtsp',
            [
                'label' => esc_html__('Month top spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .month' => 'margin-top: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Title', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color',
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
                'name' => 'desc_ty',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'desc_margin',
            [
                'label' => esc_html__('Margin', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_place',
            [
                'label' => esc_html__('Location', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'lx_m',
            [
                'label' => esc_html__('Margin', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],

                'selectors' => [
                    '{{WRAPPER}} .place' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lx_typo',
                'label' => esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .place',
            ]
        );

        $this->add_control(
            'l_lr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .place' => 'border-color: {{VALUE}};',
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

    private function content($content, $column)
    {
        $out = '';
        foreach ($content as $item) {
            $title = $item['title'] ? '<h3 class="title">' . esc_attr($item['title']) . '</h3>' : '';
            $place = $item['place'] ? '<p class="place">' . $item['place'] . '</p>' : '';
            $link = isset($item['url']) ? thepack_get_that_link($item['url']) : '';

            $day = date('D', strtotime($item['date']));
            $date = date('d', strtotime($item['date']));
            $month = date('M', strtotime($item['date']));

            $btn = isset($item['url']) ? '<a ' . $link . ' class="tour-btn">' . $title . '</a>' : $title;

            $out .= '
                <div class="event-wrap ' . $column . '">
                    <span class="date-wrap"><span class="date">' . $date . '</span><span class="month">' . $month . '</span></span>
                    <div class="event-body">
                        ' . $btn . '
                        ' . $place . '
                    </div>
                </div>
            ';
        }

        return $out;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_tourmini());
