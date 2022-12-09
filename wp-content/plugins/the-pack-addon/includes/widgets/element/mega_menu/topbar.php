<?php

use XLMega\XLMega_Helper;

?>
<div class="xlm-topbar">
    <div class="tp-header-flex-wrap">
        <div class="khbnavleft">
            <div class="leftwrpr">
				<?php echo $this->out_iconbox($settings['iconbox']); ?>
            </div>
        </div>
        <div class="khbnavright">
            <div class="inrwrpr">
				<?php echo $this->out_social_link($settings['socials']); ?>
            </div>
        </div>

    </div>
</div>