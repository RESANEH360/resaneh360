<?php

$empha = thepack_build_html($settings['empha'], 'h1', 'sub');
$pre = thepack_build_html($settings['pre'], 'span', 'line');
$head = thepack_build_html($settings['head'], 'h2', 'heading');

?>
<div class="tb-heading-two <?php echo $settings['tmpl']; ?>">
    <div class="inner">
		<?php echo thepack_build_html($empha . $pre . $head); ?>
    </div>
</div>