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
];

switch ($settings['disp']) {
    case 'slider':
        $cls = 'swiper-slide';
        break;

    case 'grid':
        $cls = 'items' . ' ' . $settings['anim'];
        break;

    default:
}

$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';

if ($settings['disp'] == 'slider') {
    $dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
    $arrow = $settings['arrow'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';

    echo '<div class="swiper-container tpswiper clientslide" data-xld =\'' . wp_json_encode($slider_options) . '\'>
                <div class="swiper-wrapper tb-clientwrap1">
                    ' . $this->content($settings['items'], $cls) . '
                </div>
                ' . $arrow . $dot . '
            </div>';
} else {
    echo '<div class="tb-clientwrap1"><div class="tb-clientgrid">' . $this->content($settings['items'], $cls) . '</div></div>';
}
