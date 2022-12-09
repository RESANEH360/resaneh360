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
    'space' => $space,
    'auto' => ('yes' === $settings['auto']),
];

$pagi = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
$navi = $settings['arrow'] ? '<div class="swiper-button-prev no-bg"><i class="tbicon ' . $settings['picon'] . '"></i></div><div class="swiper-button-next no-bg"><i class="tbicon ' . $settings['nicon'] . '"></i></div>' : '';

if ($settings['disp'] == 'slider') {
    echo '<div class="tbteam2 hascarou ' . $settings['styl'] . '" data-xld =\'' . wp_json_encode($slider_options) . '\'>
                <div class="swiper-wrapper">
                    ' . $this->content($settings['items'], $settings['animation'], $settings['disp'], $settings['img_size']) . '
                </div>
                ' . $pagi . $navi . '
        ';
} else {
    echo '<div class="tbteam2 ' . $settings['styl'] . '">' . $this->content($settings['items'], $settings['animation'], $settings['disp'], $settings['img_size']) . '</div>';
}
?>

<style type="text/css">
    .team2 {
        float: left;
    }

    .tbteam2 {
        overflow: hidden;
    }

    .tbteam2.styl_1 {
        text-align: center;
    }

    .tbteam2 .no-bg {
        background-image: none;
        text-align: center;
    }

    .tbteam2 .swiper-pagination-bullet {
        opacity: 1
    }

    .tbteam2.hascarou {
        overflow: hidden;
    }

    .tbteam2 .team-content {
        overflow: hidden;
    }

    .tbteam2 .teamthmb {
        position: relative;
        overflow: hidden;
    }

    .tbteam2 .team-link {
        position: absolute;
        width: 100%;
        left: 50%;
        transform: translateX(-50%);
        bottom: -50px;
        -webkit-transition: all 300ms ease;
        -moz-transition: all 300ms ease;
        -ms-transition: all 300ms ease;
        -o-transition: all 300ms ease;
        transition: all 300ms ease;
        display: table;
    }

    .tbteam2 .team-container:hover .team-link {
        bottom: 0;
    }

    .tbteam2 .team-link > a {
        display: table-cell;
        width: 2%;
        background: black;
        color: white;
    }

</style>