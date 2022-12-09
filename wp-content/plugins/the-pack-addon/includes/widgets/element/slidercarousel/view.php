<?php

$slider_options = [
    'item' => $settings['item']['size'],
    'item_tab' => $settings['item_tab']['size'],
    'speed' => $settings['speed']['size'],
    'space' => $settings['space']['size'],
    'center' => ('yes' === $settings['center']),
    'mouse' => ('yes' === $settings['mouse']),
    'auto' => ('yes' === $settings['auto']),
];

$pagi = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
$arrow = $settings['arrow'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';

$out1 = '';
require dirname(__FILE__) . '/' . $settings['tmpl'] . '.php';
?>

<div class="folio-carousel1">
	<?php echo '<div class="swiper-container tpswiper ' . $settings['tmpl'] . '" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <div class="swiper-wrapper">
		<?php echo $out1; ?>
    </div>
	<?php echo $pagi . $arrow; ?>
</div>
</div>
