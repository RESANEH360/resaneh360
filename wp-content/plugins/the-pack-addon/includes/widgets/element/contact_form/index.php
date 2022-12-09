<?php
namespace ThePackAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class The_Pack_Contact_Form extends Widget_Base
{
    public function get_name()
    {
        return 'tp-contact';
    }

    public function get_title()
    {
        return esc_html__('Contact Form', 'thepack');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-admin-users';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Controlls', 'thepack'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $field_types = [
            'text' => esc_html__('Text', 'thepack'),
            'textarea' => esc_html__('Textarea', 'thepack'),
            'url' => esc_html__('URL', 'thepack'),
            'tel' => esc_html__('Tel', 'thepack'),
            'email' => esc_html__('Email', 'thepack'),
            'select' => esc_html__('Select', 'thepack'),
        ];

        $repeater->add_control(
            'field_type',
            [
                'label' => esc_html__('Type of Field', 'thepack'),
                'type' => Controls_Manager::SELECT2,
                'options' => $field_types,
                'label_block' => true,
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__('Placeholder', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'field_type' => ['tel', 'text', 'email', 'textarea', 'number', 'url']
                ],
            ]
        );

        $repeater->add_control(
            'required',
            [
                'label' => esc_html__('Is Required', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => '!in',
                            'value' => [
                                'radio',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'field_options',
            [
                'label' => esc_html__('Options', 'thepack'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'description' => esc_html__('Enter each option in a separate line. To differentiate between label and value, separate them with a pipe char ("|"). For example: First Name|f_name', 'thepack'),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => 'in',
                            'value' => [
                                'select',
                                'radio',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'field_label_h',
            [
                'label' => esc_html__('Label', 'thepack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'field_label',
            [
                'label' => esc_html__('Field Name(label)', 'thepack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'show_label',
            [
                'label' => esc_html__('Label', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'thepack'),
                'label_off' => esc_html__('Hide', 'thepack'),
                'return_value' => 'true',
                'default' => 'true',
                'dynamic' => [
                    'active' => true,
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'field_type',
                            'operator' => '!in',
                            'value' => [
                                'radio',
                                'checkbox',
                            ],
                        ],
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'label_position',
            [
                'label' => esc_html__('Label Position', 'thepack'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'above' => esc_html__('Above', 'thepack'),
                    'inline' => esc_html__('Inline', 'thepack'),
                ],
                'default' => 'above',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'show_label',
                            'value' => 'true',
                        ],
                        [
                            'name' => 'field_type',
                            'operator' => '!in',
                            'value' => [
                                'radio',
                                'recaptcha',
                                'checkbox',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_responsive_control(
            'wid',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Width', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'flex: 0 0 {{SIZE}}%;-webkit-flex: 0 0 {{SIZE}}%;width:{{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'form_fields',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ field_type }}}',
            ]
        );

        $this->add_control(
            'btn',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button label', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('Submit', 'thepack'),
            ]
        );

        $this->add_control(
            'btnik',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Button icon', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_msg',
            [
                'label' => esc_html__('Message', 'thepack'),
            ]
        );

        $this->add_control(
            'emailto',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Mail recipient', 'thepack'),
                'description' => esc_html__('For multiple recipient use comma eg a@mail.com,b@mail.com', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('admin@mail.com', 'thepack'),
            ]
        );

        $this->add_control(
            'emailsub',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Mail subject', 'thepack'),
                'description' => esc_html__('Email subject header', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('Contact from my site', 'thepack'),
            ]
        );

        $this->add_control(
            'success',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Success message', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('Thank you for contacting us, we will get back to you shortly.', 'thepack'),
            ]
        );

        $this->add_control(
            'fail',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Fail message', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('Something went wrong.Please try again', 'thepack'),
            ]
        );

        $this->add_control(
            'error',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Error message', 'thepack'),
                'label_block' => true,
                'default' => esc_html__('Please enter correct information.', 'thepack'),
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
            'lfticn',
            [
                'label' => esc_html__('Left icon', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'inlineform',
            [
                'label' => esc_html__('Inline form', 'thepack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'lrspc',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Left-right spacing', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} .item,{{WRAPPER}} .tp-form-btn' => 'padding-left:{{SIZE}}{{UNIT}};padding-right:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-contact-wrap' => 'margin-left:-{{SIZE}}{{UNIT}};margin-right:-{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btspc',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__('Bottom spacing', 'thepack'),
                'selectors' => [
                    '{{WRAPPER}} .item' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input',
            [
                'label' => esc_html__('Input', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'inpbdr',
            [
                'label' => esc_html__('Border', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style:solid;',
                ],
            ]
        );

        $this->add_control(
            'inrbdr',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'inpkrl',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item ::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inpad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'intxht',
            [
                'label' => esc_html__('Textarea height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .item textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'inpty',
                'selector' => '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea,{{WRAPPER}} .item select',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->start_controls_tabs('intb');

        $this->start_controls_tab(
            'intb1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            'inbdckr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select,{{WRAPPER}} .item input,{{WRAPPER}} .item textarea' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item input,{{WRAPPER}} .item textarea,{{WRAPPER}} .item select' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'intb2',
            [
                'label' => esc_html__('Error', 'thepack'),
            ]
        );

        $this->add_control(
            'einbdckr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item select.error,{{WRAPPER}} .item input.error,{{WRAPPER}} .item textarea.error' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'einbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item input.error,{{WRAPPER}} .item textarea.error,{{WRAPPER}} .item select.error' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slect',
            [
                'label' => esc_html__('Select', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'selpad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .item select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Icon', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ikvsp',
            [
                'label' => esc_html__('Vertical spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikhsp',
            [
                'label' => esc_html__('Horizontal spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .left-icon .item i' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .right-icon .item i' => 'right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikfs',
            [
                'label' => esc_html__('Font size', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ikclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_emsg',
            [
                'label' => esc_html__('Message', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mtsp',
            [
                'label' => esc_html__('Top spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .response' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'mrsp',
            [
                'label' => esc_html__('Right spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .response' => 'right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'msclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'msbdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response p' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mspad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .response p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'msty',
                'selector' => '{{WRAPPER}} .response p',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_control(
            'mserbg',
            [
                'label' => esc_html__('Error background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .error' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mssukbg',
            [
                'label' => esc_html__('Success background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .success' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'msflbg',
            [
                'label' => esc_html__('Fail background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .response .fail' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'msbxd',
                'selector' => '{{WRAPPER}} .response p',
                'label' => esc_html__('Box shadow', 'thepack'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btal',
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
                    '{{WRAPPER}} .tp-form-btn' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btwid',
            [
                'label' => esc_html__('Width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-inline-form + .tp-form-btn' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btbrd',
            [
                'label' => esc_html__('Border radius', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btbwd',
            [
                'label' => esc_html__('Border width', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'btpad',
            [
                'label' => esc_html__('Padding', 'thepack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bttyp',
                'selector' => '{{WRAPPER}} .tp-form-btn button',
                'label' => esc_html__('Typography', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'btispe',
            [
                'label' => esc_html__('Icon spacing', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn span i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('btnl');

        $this->start_controls_tab(
            'btn1',
            [
                'label' => esc_html__('Normal', 'thepack'),
            ]
        );

        $this->add_control(
            'btnnbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btnnclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btnnbdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button' => 'border-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn2',
            [
                'label' => esc_html__('Hover', 'thepack'),
            ]
        );

        $this->add_control(
            'hbtnnbg',
            [
                'label' => esc_html__('Background', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'background:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hbtnnclr',
            [
                'label' => esc_html__('Color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'color:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hbtnnbdclr',
            [
                'label' => esc_html__('Border color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-form-btn button:hover' => 'border-color:{{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn3',
            [
                'label' => esc_html__('Loader', 'thepack'),
            ]
        );

        $this->add_responsive_control(
            'ldwd',
            [
                'label' => esc_html__('Width & height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldtsp',
            [
                'label' => esc_html__('Top position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldlp',
            [
                'label' => esc_html__('Left position', 'thepack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ldthmcl',
            [
                'label' => esc_html__('Theme color', 'thepack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .loader' => 'border-right-color:{{VALUE}};border-top-color:{{VALUE}};border-bottom-color:{{VALUE}};',
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

    protected function generate_textarea_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/textarea.php';

        return $output;
    }

    protected function generate_icon($element)
    {
        if (empty($element)) {
            return '';
        }

        return thepack_icon_svg($element);
    }

    protected function generate_select_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/select.php';

        return $output;
    }

    protected function generate_input_field($element)
    {
        if (empty($element)) {
            return '';
        }
        $output = include 'fields/input.php';

        return $output;
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Contact_Form());
