<?php
$pre = '<span class="xld-sep-hldr"><span class="xld-sep-lne"></span></span>';
$post = '<span class="xld-sep-hldr"><span class="xld-sep-lne"></span></span>';
$icon = $settings['icn']['value'] ? '<i class="tbicon ' . $settings['icn']['value'] . '"></i>' : '';
$img = $settings['img']['id'] ? wp_get_attachment_image($settings['img']['id'], 'full') : '';
$heading = '<span class="heading">' . $settings['txt'] . $icon . $img . '</span>';

switch ($settings['tmpl']) {
    case 'one':
        $out = $pre . $heading . $post;
        break;

    case 'two':
        $out = $heading . $post;
        break;

    case 'three':
        $out = $pre . $heading;
        break;

    default:
}
?>

<div class="xld-separator">
	<?php echo $out; ?>
</div>

<style type="text/css">
    .xld-separator {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .xld-separator .xld-sep-hldr {
        position: relative;
        -webkit-box-flex: 1;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-width: 11%;
    }

    .xld-separator .xld-sep-hldr .xld-sep-lne {
        border-top: 1px solid #eeee;
        display: block;
        position: relative;
        width: 100%;
    }
</style>  
 
