<?php
namespace ThePackAddon\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class thepack_recent_post extends Widget_Base
{
    public function get_name()
    {
        return 'tprecentpost';
    }

    public function get_title()
    {
        return esc_html__('Recent Post', 'thepackpro');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-tagcloud';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_posts_carousel',
            [
                'label' => esc_html__('Query', 'thepackpro'),
            ]
        );

        $this->add_control(
            'query_type',
            [
                'label' => esc_html__('Query type', 'thepackpro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'category' => esc_html__('Category', 'thepackpro'),
                    'individual' => esc_html__('Individual', 'thepackpro'),
                ],
            ]
        );

        $this->add_control(
            'cat_query',
            [
                'label' => esc_html__('Category', 'thepackpro'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_cat('category'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'category',
                ],
            ]
        );

        $this->add_control(
            'id_query',
            [
                'label' => esc_html__('Posts', 'thepackpro'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_posts('post'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'individual',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'meta',
            [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__('Post meta', 'thepackpro'),
                'default' => '',
                'options' => thepack_metaa_fields(),
                'multiple' => false,
                'label_block' => true
            ]
        );

        $this->add_control(
            'metas',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ meta }}}',
            ]
        );

        $this->add_control(
            'posts',
            [
                'label' => esc_html__('Posts Per Page', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
            ]
        );

        $this->add_control(
            'show_img',
            [
                'label' => esc_html__('Featured image', 'thepackpro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__('Show', 'thepackpro'),
                'label_off' => esc_html__('Hide', 'thepackpro'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Image size', 'thepackpro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => thepack_image_size_choose(),
                'multiple' => false,
                'condition' => [
                    'show_img' => 'yes',
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

        $this->add_control(
            'botmargin',
            [
                'label' => esc_html__('Margin-top', 'thepackpro'),
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
                    '{{WRAPPER}} .tp-recent-post > .item + .item' => 'margin-top: {{SIZE}}{{UNIT}};padding-top: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'bor_col',
            [
                'label' => esc_html__('Border color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-recent-post > .item + .item' => 'border-top: 1px solid {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Title', 'thepackpro'),
            ]
        );

        $this->add_responsive_control(
            'tmrg',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typot',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->add_control(
            'tcol',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tcolh',
            [
                'label' => esc_html__('Hover color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Meta', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .leffect-1',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->add_control(
            'lkclrr',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leffect-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lkclr',
            [
                'label' => esc_html__('Link Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leffect-1 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mlkhclr',
            [
                'label' => esc_html__('Link hover color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leffect-1 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
            [
                'label' => esc_html__('Thumb', 'thepackpro'),
            ]
        );

        $this->add_responsive_control(
            'imgwd',
            [
                'label' => esc_html__('Width', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .entry-media' => 'width: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_responsive_control(
            'imgbrd',
            [
                'label' => esc_html__('Border radius', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .entry-media' => 'border-radius: {{SIZE}}{{UNIT}}',
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
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_recent_post());
