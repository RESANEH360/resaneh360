<?php
$lbl1 = $settings['lbl1'] ? 'data-beer-label="' . $settings['lbl1'] . '"' : '';
$lbl2 = $settings['lbl2'] ? 'data-beer-label="' . $settings['lbl2'] . '"' : '';
?>

<div class="beer-slider" <?php echo thepack_build_html($lbl1); ?>>
	<?php echo thepack_ft_images($settings['img1']['id'], $settings['img_size']); ?>
    <div class="beer-reveal" <?php echo thepack_build_html($lbl2); ?>>
		<?php echo thepack_ft_images($settings['img2']['id'], $settings['img_size']); ?>
    </div>
</div>

