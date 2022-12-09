<?php
$id = substr($this->get_id_int(), 0, 3);
$options = [
    'id' => $id, 
    'collpased' => ('yes' === $settings['collpased']),
];
$icon = $settings['actikn'] ? '<i class="actikn ' . $settings['actikn']['value'] . '"></i>' : '';
$inacon = $settings['iactikn'] ? '<i class="inactikn ' . $settings['iactikn']['value'] . '"></i>' : '';
$indicator = '<span class="tbxicon">' . $icon . $inacon . '</span>';
$cls = $tabti = '';
switch ($settings['tmpl']) {
    case 'one':
        $cls = 'xld-acdn1 ';
        break;

    case 'two':
        $cls = 'xld-acdn2 ';
        break;

    case 'three':
        $cls = 'xld-acdn3 ';
        break;

    default:
}

foreach ($settings['tabs'] as $a) {
    $title = $a['title'] ? '<div class="accortitle">' . $a['title'] . $indicator . '</div>' : '';
    $content = '<p class="accorbody">' . $a['content'] . '</p>';
    $tabti .= '<li class="' . $settings['anim'] . '">' . $title . $content . '</li>';
}
?>

<?php echo '<div class="xldacdn ' . $cls . $settings['lfticn'] . '" data-xld =\'' . wp_json_encode($options) . '\'>'; ?>
<ul class="accordion <?php echo $id; ?>">
	<?php echo thepack_build_html($tabti); ?>
</ul>
</div>