<?php
$abscls = $settings['abspos'] ? 'abspos' : 'realtivepos';
?>

<div class="xlmega-header <?php echo esc_attr($abscls); ?>">
    <div class="xlmega-desktop">
		<?php if (is_array($settings['parts'])) {
    $widgets = array_filter($settings['parts']);
    foreach ($widgets as $key => $value) {
        if (!empty($value['lbl'])) {
            if ($value['sticky']) {
                echo '<div class="xlmega-sticky-wrapper">';
            }
            include_once plugin_dir_path(__FILE__) . $value['lbl'] . '.php';
            if ($value['sticky']) {
                echo '</div>';
            }
        }
    }
} ?>
    </div>

    <div class="offsidebar right">
        <div class="offmenuwraps">
			<?php
            if ($settings['mobile']) {
                wp_nav_menu([
                    'menu' => $settings['mobile'],
                    'container' => false,
                    'menu_class' => 'mainmenu',
                    'items_wrap' => '<ul class="momenu-list">%3$s</ul>',
                ]);
            }
            ?>
			<?php echo $this->out_social_link($settings['socials']); ?>
        </div>
    </div>
    <div class="click-capture"></div>
</div>