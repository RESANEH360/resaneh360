<?php

$animation = $settings['animation'];

?>

<div class="tb-process-1 tpoverflow <?php echo $settings['tmpl']; ?>">
	<?php echo $this->content($settings['items'], $settings['tmpl'], $animation); ?>
</div>

