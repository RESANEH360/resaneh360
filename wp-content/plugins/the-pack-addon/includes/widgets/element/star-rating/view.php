<?php
$tabti = '';
foreach ($settings['tabs'] as $a) {
    $inct = $a['inct'] ? 'class="inactive"' : '';
    $icon = $a['icon'] ? '<i class="'.$a['icon']['value'].'"></i>' : '';
    $tabti .= '<li '.$inct.'>' . $icon . '</li>';
}
?>

<div class="tp-star-rating tpoverflow">
    <ul>
        <?php echo $tabti;?>
    </ul>
</div>