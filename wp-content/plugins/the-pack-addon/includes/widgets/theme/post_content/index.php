<?php
namespace ThePackAddon\Widgets;

use Elementor;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use WP_Query;

class The_Pack_Pro_Post_Content extends Widget_Base
{
    public function get_name()
    {
        return 'tp-post-content';
    }

    public function get_title()
    {
        return esc_html__('Post Content', 'thepackpro');
    }

    public function get_icon()
    {
        return 'eicon-post-content';
    }

    public function get_categories()
    {
        return ['ashelement-addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_cont',
            [
                'label' => esc_html__('Content', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => esc_html__('Preview post', 'thepackpro'),
                'type' => Controls_Manager::SELECT2,
                'options' => thepack_drop_posts('post'),
                'multiple' => false,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_styling',
            [
                'label' => esc_html__('Paragraph', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pc',
            [
                'label' => esc_html__('Color', 'thepackpro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ptyp',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content p',
            ]
        );

        $this->add_responsive_control(
            'p-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hding',
            [
                'label' => esc_html__('Heading', 'thepackpro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('htb');

        $this->start_controls_tab(
            'ht1',
            [
                'label' => esc_html__('H1', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h1ty',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content h1',
            ]
        );

        $this->add_responsive_control(
            'h1-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ht2',
            [
                'label' => esc_html__('H2', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h2ty',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content h2',
            ]
        );

        $this->add_responsive_control(
            'h2-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ht3',
            [
                'label' => esc_html__('H3', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h3ty',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content h3',
            ]
        );

        $this->add_responsive_control(
            'h3-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ht4',
            [
                'label' => esc_html__('H4', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h4ty',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content h4',
            ]
        );

        $this->add_responsive_control(
            'h4-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ht5',
            [
                'label' => esc_html__('H5', 'thepackpro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h5ty',
                'label' => esc_html__('Typography', 'thepackpro'),
                'selector' => '{{WRAPPER}} .tp-post-content h5',
            ]
        );

        $this->add_responsive_control(
            'h5-m',
            [
                'label' => esc_html__('Margin', 'thepackpro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-post-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        if (Plugin::instance()->editor->is_edit_mode()) {
            $id = $settings['preview'];
        } else {
            global $post;
            $id = $post->ID;
        }

        echo '<div class="tp-post-content">';
        $args = [
            'p' => $id,
            'post_type' => 'post',
            'posts_per_page' => 1,
        ];
        $loop = new WP_Query($args);

        if ($loop->have_posts()) : ?>
			<?php while ($loop->have_posts()) : $loop->the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif;
        echo '</div>';
    }
}

$widgets_manager->register(new \ThePackAddon\Widgets\The_Pack_Pro_Post_Content());
