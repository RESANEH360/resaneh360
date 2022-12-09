<?php

$speed = $settings['speed']['size'];
$space = $settings['space']['size'];
$item = $settings['item']['size'];
$item_tab = $settings['item_tab']['size'];

$slider_options = [
    'item' => $item,
    'item_tab' => $item_tab,
    'speed' => $speed,
    'space' => $space,
    'mouse' => ('yes' === $settings['mouse']),
    'auto' => ('yes' === $settings['auto']),
];

$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
$out = '';
require dirname(__FILE__) . '/' . $settings['tmpl'] . '.php';
?>

<div class="tb-shopslide">
<!-- slides-->
<?php echo '<div class="swiper-container main-slider ' . $settings['tmpl'] . ' tpswiper" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <div class="swiper-wrapper">
		<?php echo thepack_build_html($out); ?>
    </div>
	<?php echo thepack_build_html($pagination . $arraow); ?>
</div>
<!-- thumbnails-->
</div>
