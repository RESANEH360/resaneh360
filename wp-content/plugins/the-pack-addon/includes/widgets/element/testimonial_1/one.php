<?php
$previkn = $settings['previkn'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['previkn']['value'] . '"></i></div>' : '';
$nextikn = $settings['nextikn'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nextikn']['value'] . '"></i></div>' : '';

$quote_icon = $settings['quote_icon']['value'] ? '<i class="tpquote ' . $settings['quote_icon']['value'] . '"></i>' : '';

$slider_options = [
    'speed' => $settings['speed']['size'],
    'item' => $settings['item']['size'],
    'space' => $settings['space']['size'],
    'itemtab' => $settings['itemtab']['size'],
    'auto' => ('yes' === $settings['auto']),
];

$out1 = '';
foreach ($settings['items'] as $item) {
    $rating = $item['rating'] ? '<span class="tscore"><span style="width: ' . $item['rating']['size'] . '%"></span></span>' : '';
    $heading = $item['heading'] ? '<h3 class="heading">' . $item['heading'] . '</h3>' : '';
    $desc = $item['desc'] ? '<p class="desc">' . $item['desc'] . '</p>' : '';
    $img = wp_get_attachment_image($item['avatar']['id'], 'full');
    $name = $item['name'] ? '<p class="name">' . $item['name'] . '</p>' : '';
    $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';

    $out1 .= '
   <div class="flexs items swiper-slide">
      ' . $quote_icon . '
      <div class="items-wrap">
      ' . $heading . $rating . '
      ' . $desc . '
      <div class="inner">
      <div class="tp-flex-equal">
          <div class="thumb tp-col">
          ' . $img . '
          </div>
          <div class="info tp-col">
          ' . $name . $pos . '
          </div>
      </div></div>
      </div>
  </div>
  ';
}

?>

<?php echo '<div class="swiper-container testimonial-1 tpswiper" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
<div class="swiper-wrapper">
	<?php echo $out1; ?>
</div>
<div class="swiper-pagination"></div>
<div class="tp-arrow"><?php echo $previkn . $nextikn; ?></div>
</div>



