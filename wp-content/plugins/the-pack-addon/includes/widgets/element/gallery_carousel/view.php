<?php
$slider_options = [
    'item' => $settings['item']['size'],
    'item_tab' => $settings['item_tab']['size'],
    'speed' => $settings['speed']['size'],
    'space' => $settings['space']['size'],
    'center' => ('yes' === $settings['centermode']),
    'mouse' => ('yes' === $settings['mouse']),
    'auto' => ('yes' === $settings['auto']),
    'cover' => ('yes' === $settings['cover']),
];

$previkn = $settings['previkn'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['previkn']['value'] . '"></i></div>' : '';
$nextikn = $settings['nextikn'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nextikn']['value'] . '"></i></div>' : '';
$center = $settings['centermode'] ? 'center_mode' : '';

?>
<?php echo '<div class="swiper-container tp-gallery-slider tpswiper ' . $center . '" data-thop =\'' . wp_json_encode($slider_options) . '\'>'; ?>
<div class="swiper-wrapper">
	<?php echo $this->content($settings['galleries'], $settings['img_size']); ?>
</div>
<!-- Add Pagination -->
<div class="swiper-pagination"></div>
<div class="tp-arrow"><?php echo thepack_build_html($previkn . $nextikn); ?></div>
</div>

