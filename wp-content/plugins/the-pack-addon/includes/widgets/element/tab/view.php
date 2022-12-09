<?php
$content = $label = '';
foreach ($settings['tabs'] as $a) {
    $label .= '<li><span>' . $a['title'] . '</span></li>';
    $content .= '<div class="tab-content">' . $this->icon_image($a) . '</div>';
}
?>
<div class="tp-tab tp-tab-1 <?php echo $settings['style']; ?>">
    <ul class="tab-area">
		<?php echo thepack_build_html($label); ?>
    </ul>
    <div class="tab-wrap">
		<?php echo thepack_build_html($content); ?>
    </div>
</div>

