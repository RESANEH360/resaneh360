<?php
$icon = $settings['icon']['value'] ? '<div class="icon"><i class="tbicon ' . $settings['icon']['value'] . '"></i></div>' : '';
?>

<div class="tp-cta-link-wrap tpoverflow">
    <div class="tp-cta-link">
		<?php echo thepack_build_html($icon); ?>
        <div class="content">
			<?php echo thepack_build_html($settings['pre'], 'p', 'pre'); ?>
			<?php echo thepack_build_html($settings['title'], 'h3', 'title'); ?>
        </div>
        <a class="fullink" <?php echo thepack_get_that_link($settings['url']); ?>></a>
    </div>
</div>
