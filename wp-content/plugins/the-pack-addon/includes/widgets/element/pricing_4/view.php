<?php
$list = '';
$enicon = $settings['enicon']['value'] ? '<i class="tbicon ' . $settings['enicon']['value'] . '"></i>' : '';
$dicon = $settings['dicon']['value'] ? '<i class="tbicon ' . $settings['dicon']['value'] . '"></i>' : '';
foreach ($settings['list'] as $a) {
    $on = $a['on'] ? 'on' : 'off';
    $icon = $a['on'] ? $enicon : $dicon;
    $list .= '<li class="' . $on . '">' . $a['txt'] . $icon . '</li>';
}
$url = thepack_get_that_link($settings['link']);
$link = $settings['btn'] ? '<a class="price-btn" ' . $url . '>' . $settings['btn'] . '</a>' : '';

?>

<div class="tp-pricing-4 tpoverflow <?php echo $settings['anim']; ?>">
    <div class="tbinr">
		<?php echo thepack_build_html($settings['lbl'], 'span', 'pre'); ?>
        <h3 class="price-wrap"><?php echo thepack_build_html($settings['prc'], 'span', 'price'); ?><?php echo thepack_build_html($settings['dur'], 'span', 'duration'); ?></h3>
		<?php echo thepack_build_html($settings['desc'], 'p', 'desc'); ?>
        <ul><?php echo $list; ?></ul>
		<?php echo $link; ?>
    </div>
</div>

