<?php
$heading = thepack_build_html($settings['heading'], 'h3', 'main-head');
$sub = thepack_build_html($settings['sub'], 'span', 'sub-head');
?>
<div class="tbheading4 style-one">
    <div class="headwrp">
		<?php echo $sub . $heading; ?>
    </div>
</div>