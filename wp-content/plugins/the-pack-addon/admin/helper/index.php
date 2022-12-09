<?php
if (!defined('ABSPATH')) {
    exit;
}

function thepack_footer_select($type = '', $num = '', $tax = '')
{
    $type = $type ? $type : 'elementor_library';
    global $post;
    $num = $num ? $num : '-1';
    $args = [
        'numberposts' => $num,
        'post_type' => $type,
    ];
    if ($tax) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_category',
                'field' => 'slug',
                'terms' => [$tax],
            ],
        ];
    }

    $posts = get_posts($args);
    $categories = [
        '' => esc_html__('Select', 'thepack'),
    ];
    foreach ($posts as $pn_cat) {
        $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
    }

    return $categories;
}

add_action('init', 'thepack_add_image_sizes');
function thepack_add_image_sizes()
{
    $options = get_option('_thepack');
    $imgsizes = $options['image_size'];

    if (!empty($imgsizes) && sizeof($imgsizes) > 0) {
        foreach ($imgsizes as $imgsize) {
            $crop = $imgsize['crop'] == 'on' ? 'true' : 'false';
            add_image_size($imgsize['name'], $imgsize['width'], $imgsize['height'], $crop);
        }
    }
}
