<div class="menubarwrp <?php echo $settings['nbarbox']; ?>">
    <div class="tp-header-flex-wrap">
        <div class="khbnavleft">
            <div class="leftwrpr">
				<?php echo thepack_get_builder_logo($settings['logo']['id'], 'logomain', $settings['logo_link']); ?>
				<?php echo thepack_get_builder_logo($settings['stlogo']['id'], 'logosticky', $settings['logo_link']); ?>
            </div>
        </div>
        <div class="khbnavcenter">
            <div class="listinr">

            </div>
        </div>
        <div class="khbnavright">
            <div class="inrwrpr">
				<?php if ($settings['native']) {
                    echo render_nav_menu($settings['menu']);
                } else {
                    rendor_custom_nav_menu($settings['menus']);
                } ?>                
				<?php echo $this->out_subs_btn($settings['sub-btn'], $settings['sub-link']); ?>
				<?php echo $this->out_icon($settings['tapicon'], $settings['taphide']); ?>
            </div>
        </div>
    </div>
</div>