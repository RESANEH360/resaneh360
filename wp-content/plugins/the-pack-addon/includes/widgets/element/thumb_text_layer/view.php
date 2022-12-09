<div class="tp-thumb-image-layer-wrap">
    <div class="tp-thumb-image-layer">
		<?php
        echo thepack_ft_images($settings['thumb']['id'], 'full');
        echo $this->content($settings['items'], $settings['anim']);
        ?>
    </div>
</div>