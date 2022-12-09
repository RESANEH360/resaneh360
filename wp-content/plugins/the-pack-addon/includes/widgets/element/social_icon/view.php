<?php

switch ($settings['tmpl']) {
    case 'one':
        $cls = 'tb-social-1 tb-social';
        break;

    case 'two':
        $cls = 'tb-social-2 tb-social';
        break;

    case 'three':
        $cls = 'tb-social-3 tb-social';
        break;

    default:
}

?>

<div class="<?php echo esc_attr($cls); ?>">
	<?php echo $this->content($settings['items'], $settings['tmpl'], $settings['animation']); ?>
</div>
