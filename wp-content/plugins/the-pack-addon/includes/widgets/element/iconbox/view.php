<?php
$animation = $settings['animation'];
$class = $animation . ' ' . $settings['ico_position'];

?>
<div class="equalHMVWrap eqWrap ikonbox">

	<?php foreach ($settings['services'] as $index => $a):

        $url = thepack_get_that_link($a['link']);
        $link_title = $a['link-title'];

        $link = $a['link']['url'] ? '<a class="ash-btn" ' . $url . '>' . $link_title . '</a>' : '';

        $title = $a['link'] ? '<h3 class="title">' . $a['title'] . '</h3>' : '';
        $sub = $a['sub'] ? '<p class="sub">' . $a['sub'] . '</p>' : '';

        $description = $a['description'] ? '<p class="description">' . $a['description'] . '</p>' : '';

        $img = wp_get_attachment_image($a['img']['id'], 'full');
        $icon = $a['ico']['value'] ? '<i class="' . $a['ico']['value'] . '"></i>' : '';
        $type = $a['type'] == 'image' ? '<span class="image figure tbtr">' . $img . '</span>' : '<span class="icon figure tbtr">' . $icon . '</span>';
        ?>
        <div class="equalHMV <?php echo $class; ?>">
            <div class="service-wrap tbtr">
                <span class="figwrap"><?php echo $type; ?></span>
                <div class="service-content">
					<?php echo $title . $sub . $description; ?>
					<?php echo $link; ?>
                </div>
            </div>
        </div>
	<?php endforeach; ?>
</div>