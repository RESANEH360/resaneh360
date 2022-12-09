<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class thepack_gmap extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        $options = get_option('_thepack');
        if ($options['gmap_key']) {
            //wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key='.$options['gmap_key'].'&sensor=false');
        }
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return 'ae-gmap';
    }

    public function get_title()
    {
        return esc_html__('Google Map', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-location-alt';
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
                'label' => esc_html__('Google map', 'thepack'),
            ]
        );

        $this->add_control(
            'style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'thepack'),
                'default' => 'style_one',
                'label_block' => true,
                'options' => [
                    'style_one' => esc_html__('Style 1', 'thepack'),
                    'style_two' => esc_html__('Style 2', 'thepack'),
                ],
            ]
        );

        $this->add_control(
            'bgmap',
            [
                'label' => esc_html__('Background image', 'thepack'),
                'description' => esc_html__('Use background instead of map', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'mapimg',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Map image', 'thepack'),
                'condition' => [
                    'bgmap' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'lat', // id
            [
                'label' => esc_html__('Lattitude', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'default' => '24.2529212',
                'label_block' => true,
                'condition' => [
                    'bgmap!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'long', // id
            [
                'label' => esc_html__('Lattitude', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'default' => '89.9056218',
                'label_block' => true,
                'condition' => [
                    'bgmap!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Content box', 'thepack'),
                'type' => Controls_Manager::REPEATER,
                'condition' => [
                    'style' => 'style_two',
                ],

                'fields' => [

                    [
                        'name' => 'type',
                        'label' => esc_html__('Content type', 'thepack'),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'heading' => [
                                'title' => esc_html__('Heading', 'thepack'),
                                'icon' => ' eicon-document-file',
                            ],
                            'iconbox' => [
                                'title' => esc_html__('Iconbox', 'thepack'),
                                'icon' => 'eicon-image-rollover',
                            ],
                            'openhrs' => [
                                'title' => esc_html__('Open hours', 'thepack'),
                                'icon' => 'eicon-image-rollover',
                            ]
                        ],
                        'default' => 'heading',
                        'label_block' => true,
                    ],

                    [
                        'name' => 'head',
                        'label' => esc_html__('Heading', 'thepack'),
                        'type' => Controls_Manager::TEXT,
                        'condition' => [
                            'type' => 'heading',
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'content',
                        'label' => esc_html__('Content', 'thepack'),
                        'type' => Controls_Manager::TEXT,
                        'condition' => [
                            'type' => 'iconbox',
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'icon',
                        'label' => esc_html__('Icon', 'thepack'),
                        'type' => Controls_Manager::ICON,
                        'condition' => [
                            'type' => 'iconbox',
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'range',
                        'label' => esc_html__('Day range', 'thepack'),
                        'type' => Controls_Manager::TEXT,
                        'condition' => [
                            'type' => 'openhrs',
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'open',
                        'label' => esc_html__('Time', 'thepack'),
                        'type' => Controls_Manager::TEXT,
                        'condition' => [
                            'type' => 'openhrs',
                        ],
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ type }}}',
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Info windo text', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Here we go. Find us here',
                'label_block' => true,
                'condition' => [
                    'bgmap!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'map_style',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Map style', 'thepack'),
                'description' => sprintf('Get customised  %s', '<a href="https://snazzymaps.com" target="_blank">map styles</a>'),
                'label_block' => true,
                'condition' => [
                    'bgmap!' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dimension',
            [
                'label' => esc_html__('General', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'max_widh',
            [
                'label' => esc_html__('Max wrapper width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .map-info' => 'max-width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'margin_left',
            [
                'label' => esc_html__('Left margin', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => -100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .map-info' => 'margin-left: {{SIZE}}%;',
                ]
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => esc_html__('Zoom level', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'max' => 20,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_zoom',
            [
                'label' => esc_html__('Hide zoom control', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} #wa-zoom-in,{{WRAPPER}} #wa-zoom-out' => 'display: none;',
                ]
            ]
        );

        $this->add_control(
            'fullscrn',
            [
                'label' => esc_html__('Fullscreen control', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__('Map height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-gmap' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .map-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'titletypo',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tmargin',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_contents',
            [
                'label' => esc_html__('Contents', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'contenttypo',
                'selector' => '{{WRAPPER}} .iconinfo,{{WRAPPER}} .openhrs',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .iconinfo,{{WRAPPER}} .openhrs' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'contentmargin',
            [
                'label' => esc_html__('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .iconinfo,{{WRAPPER}} .openhrs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $fullscreen = $settings['fullscrn'] ? 'true' : 'false';
        $map_style = $settings['map_style'] ? $settings['map_style'] : '""';

        $zoom = '<div id="wa-zoom-in">+</div><div id="wa-zoom-out">-</div>';

        $slider_options = [

            'id' => $this->get_id(),
            'desc' => $settings['desc'],
            'lat' => $settings['lat'],
            'long' => $settings['long'],
            'style' => $settings['map_style'] ? $settings['map_style'] : '""',
            'fullscrn' => ('yes' === $settings['fullscrn']),
            'zoom' => $settings['zoom']['size'],
        ];

        $bg = $settings['bgmap'] ? thepack_bg_images($settings['mapimg']['id'], 'full') : '';
        $cls = $settings['bgmap'] ? 'yes-tpmap' : 'no-tpmap'; ?>

		<?php echo '<div ' . $bg . ' class="ae-gmap lazyload ' . $cls . '" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
        <div id="google-container-<?php echo $this->get_id(); ?>"></div>
		<?php echo $zoom; ?>
		<?php if ($settings['style'] == 'style_two') { ?>
            <div class="map-info"><?php $this->show_info($settings['items']) ?></div>
		<?php } ?>

        </div>

		<?php
    }

    private function show_info($label)
    {
        if (!is_array($label)) {
            return;
        }
        foreach ($label as $a) {
            $type = $a['type'];

            switch ($type) {
                case 'heading':
                    echo '<h3 class="title">' . $a['head'] . '</h3>';
                    break;
                case 'iconbox':
                    echo '<div class="iconinfo"><i class="' . $a['icon'] . '"></i>' . $a['content'] . '</div>';
                    break;
                case 'openhrs':
                    echo '<div class="openhrs"><span class="range">' . $a['range'] . '</span><span class="open">' . $a['open'] . '</span></div>';
                    break;
            }
        }
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\thepack_gmap());
