<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_full_slider_post extends Widget_Base
{
    public function get_name()
    {
        return 'tpfullslide';
    }

    public function get_title()
    {
        return esc_html__('Full slider', 'thepackpro');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-schedule';
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

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
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
            'excerpt',
            [
                'label' => esc_html__('Excerpt length', 'thepackpro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],

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
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section( 
            'section_general',
            [
                'label' => esc_html__('General', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('xxf');

        $this->start_controls_tab(
            'ms1',
            [
                'label' => esc_html__( 'Wrapper', 'news-element' ),
            ]
        );

        $this->add_control(
            'bgpos',
            [
                'label' => esc_html__('Background position', 'thepackpro'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_background_position(),
                'multiple' => false,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide >div' => 'background-position: {{VALUE}};',
                ],
            ]
        );
        
        
        $this->add_control(
            'cs_align',
            [
                'label' => __('Alignment', 'news-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'news-element'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'news-element'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'news-element'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .excerpt-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ghty',
            [
                'label' => __('Height', 'news-element'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide >div' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'cntmwd',
            [
                'label' => __('Max wrapper width', 'news-element'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1500,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .excerpt-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'cntvp',
            [
                'label' => __('Content vertical position', 'news-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .excerpt-wrap' => 'top: {{SIZE}}%;',
                ]
            ]
        );

        $this->add_control(
            'hx1',
            [
                'label' => __( 'Overlay background', 'plugin-name' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'dgbg',
                'label' =>   esc_html__( 'Color', 'news-element' ),
                'types' => [ 'none', 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .inrwrapper:after',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ms2',
            [
                'label' => esc_html__( 'Content', 'news-element' ),
            ]
        );

        $this->add_responsive_control(
            'cntmwed',
            [
                'label' => __('Max content width', 'news-element'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .inrexcerpt' => 'max-width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'cvs_align',
            [
                'label' => __('Alignment', 'news-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'news-element'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'news-element'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'news-element'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .inrexcerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
          'cntpad',
          [
             'label' =>   esc_html__( 'Padding', 'news-element' ),
             'type' => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'em','px'],
             'selectors' => [
                    '{{WRAPPER}} .inrexcerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
             ],
          ]
        );

        $this->add_control(
            'gbg',
            [
                'label' =>   esc_html__('Background', 'news-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inrexcerpt' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_contents',
            [
                'label' => esc_html__('Content', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tctb');

        $this->start_controls_tab(
            'e1',
            [
                'label' => esc_html__('Title', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttypo',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->add_control(
            't_col',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            't_colh',
            [
                'label' => esc_html__('Hover Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
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

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e2',
            [
                'label' => esc_html__('Excerpt', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'extyp',
                'selector' => '{{WRAPPER}} .post-entry',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->add_control(
            'exclr',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-entry' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exmrg',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .post-entry' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'e3',
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
            'iknclr',
            [
                'label' => esc_html__('Icon color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leffect-1 i' => 'color: {{VALUE}};',
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
            'e4',
            [
                'label' => esc_html__('Button', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btyp',
                'selector' => '{{WRAPPER}} .btn-more',
                'label' => esc_html__('Typography', 'thepackpro'),
            ]
        );

        $this->add_control(
            'btclr',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bthclr',
            [
                'label' => esc_html__('Hover Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel',
            [
                'label' => __('Carousel', 'news-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow',
            [
                'label' => __('Arrow', 'news-element'),
                'type' => Controls_Manager::SWITCHER,
            ]
        ); 

        $this->add_control(
            'dot',
            [
                'label' => __('Dot', 'news-element'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => __('Autoplay', 'news-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'news-element'),
                'label_off' => __('No', 'news-element'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'transition',
            [
                'label' => __('Transition', 'news-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Fade', 'news-element'),
                'label_off' => __('Slide', 'news-element'),
                'return_value' => 'fade',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Autoplay Speed', 'news-element' ),
                'type' =>  Controls_Manager::SLIDER,
                'default' => [
                    'size' => 3500,
                ],
                'condition' => [
                    'auto' => 'yes',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_owl_dot',
            [
                'label' => __('Dots', 'news-element'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'dtvp',
            [
                'label' => __( 'Vertical position', 'news-element' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],

                ],
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'dotbg',
            [
                'label' =>   esc_html__( 'Background', 'news-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_owl_arw',
            [
                'label' => __('Arrow', 'news-element'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'picon', [
				'type'        => Controls_Manager::ICONS,
				'label'       => esc_html__( 'Prev icon', 'thepack' ),
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-chevron-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'nicon', [
				'type'        => Controls_Manager::ICONS,
				'label'       => esc_html__( 'Next icon', 'thepack' ),
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'solid',
				],
			]
		);

        $this->add_responsive_control(
            'arwh',
            [
                'label' =>   esc_html__( 'Width and height', 'news-element' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arbrad',
            [
                'label' =>   esc_html__( 'Border radius', 'news-element' ),
                'type' =>  Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'border-radius: {{SIZE}}px;',
                ],

            ]
        );

        $this->add_control(
            'arbg',
            [
                'label' =>   esc_html__( 'Background', 'news-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'background: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'arclr',
            [
                'label' =>   esc_html__( 'Color', 'news-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .khbprnx' => 'color: {{VALUE}};'
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

    protected function content_template()
    {
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_full_slider_post());
